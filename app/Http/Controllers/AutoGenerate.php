<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AutoGenerate extends Controller
{
    /**
     * Affiche le formulaire de génération de CV
     */
    public function showForm()
    {
        return view('chat');
    }

    /**
     * Traite la requête vers l'API Azure OpenAI pour générer un CV au format JSON à partir d'une description.
     */
    public function generate(Request $request)
    {
        // Valider la requête, on attend un champ "description"
        $data = $request->validate([
            'description' => 'required|string',
        ]);

        // Créer le tableau de messages pour l'API
        $messages = [
            [
                'role' => 'system',
                'content' => $this->buildSystemPrompt()
            ],
            [
                'role' => 'user',
                'content' => $data['description']
            ]
        ];

        // Récupérer la clé API depuis la config (.env)
        $apiKey = config('services.openai.key');

        // Configuration Azure OpenAI
        $azureEndpoint = 'https://models.inference.ai.azure.com/chat/completions';
        $model = 'DeepSeek-V3-0324';
        $temperature = 0.5; // Réduit pour obtenir des résultats plus déterministes
        $top_p = 0.9;
        $max_tokens = 4000;

        // Préparer la charge utile pour l'API
        $payload = [
            'model' => $model,
            'messages' => $messages,
            'temperature' => $temperature,
            'top_p' => $top_p,
            'max_tokens' => $max_tokens,
            'presence_penalty' => 0.3,
        ];

        try {
            // Appel à l'API Azure OpenAI
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$apiKey,
            ])->post($azureEndpoint, $payload);

            // Si la requête a échoué, retourner l'erreur
            if ($response->failed()) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'La requête à l\'API Azure OpenAI a échoué.',
                        'details' => $response->json()
                    ], 500);
                }

                return view('page.cv', [
                    'error' => 'La requête à l\'API Azure OpenAI a échoué.',
                    'details' => $response->json(),
                    'description' => $data['description']
                ]);
            }

            // Extraire le contenu de la réponse
            $apiResult = $response->json();
            $cvJsonText = null;

            if (isset($apiResult['choices'][0]['message']['content'])) {
                $cvJsonText = $apiResult['choices'][0]['message']['content'];

                // Vérifier que la réponse est bien un JSON valide
                json_decode($cvJsonText);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // Si ce n'est pas un JSON valide, nettoyer le texte pour extraire uniquement la partie JSON
                    preg_match('/\{.*\}/s', $cvJsonText, $matches);
                    if (!empty($matches)) {
                        $cvJsonText = $matches[0];
                        // Vérifier à nouveau
                        json_decode($cvJsonText);
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            throw new \Exception('La réponse ne contient pas de JSON valide.');
                        }
                    } else {
                        throw new \Exception('Impossible d\'extraire un JSON valide de la réponse.');
                    }
                }
            } else {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Format de réponse inattendu de l\'API.',
                        'details' => $apiResult
                    ], 500);
                }

                return view('page.cv', [
                    'error' => 'Format de réponse inattendu de l\'API.',
                    'details' => $apiResult,
                    'description' => $data['description']
                ]);
            }

            // Si c'est une requête AJAX, retourner le JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => json_decode($cvJsonText, true) // Convertir en tableau PHP
                ]);
            }

            // Sinon, retourner la vue avec le JSON du CV
            return view('page.cv', [
                'cvData' => json_decode($cvJsonText, true), // Pour l'affichage structuré dans la vue
                'cvJson' => $cvJsonText, // Pour l'export brut
                'description' => $data['description']
            ]);
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Une erreur est survenue: ' . $e->getMessage()
                ], 500);
            }

            return view('page.cv', [
                'error' => 'Une erreur est survenue: ' . $e->getMessage(),
                'description' => $data['description']
            ]);
        }
    }

    /**
     * Construction du prompt système pour guider l'IA à générer un CV au format JSON
     */
    private function buildSystemPrompt()
    {
        return <<<EOT
Tu es un expert en ressources humaines et en extraction d'informations pertinentes pour les CV.
Ta tâche est d'analyser le texte fourni par l'utilisateur et d'en extraire les informations essentielles pour générer un CV structuré au format JSON.

L'utilisateur va te fournir une description textuelle de son parcours professionnel. Ton rôle est d'analyser ce texte pour en extraire:
1. Une description personnelle concise dans la section "profile"
2. Les formations académiques ("education") avec diplôme, date d'obtention, filière, et établissement
3. Les expériences professionnelles ("experiences") avec poste, entreprise, période et description
4. Les compétences techniques et personnelles ("skills")
5. Les langues maîtrisées et leurs niveaux ("languages")

RÈGLES IMPORTANTES:
- Ne te contente pas de reformater le texte, ANALYSE-LE pour en extraire les informations pertinentes
- Ne demande pas d'informations supplémentaires, travaille uniquement avec ce qui est fourni
- Si une information est absente, laisse le champ vide ou avec une valeur par défaut appropriée
- Pour les formations, détecte les diplômes obtenus, la date, la filière et l'établissement
- Pour les expériences, extrais les dates/périodes, noms d'entreprises et postes occupés
- Pour les compétences, distingue les compétences techniques des compétences personnelles si possible
- Pour les langues, détecte les niveaux (natif, courant, intermédiaire, débutant, etc.)
- Organise l'information de manière professionnelle et cohérente
- Réponds UNIQUEMENT avec du JSON valide, sans aucun texte autour

Voici EXACTEMENT la structure JSON que tu dois utiliser:
{
  "profile": "Une brève description de la personne, ses objectifs ou sa présentation professionnelle.",
  "education": [
    {
      "degree": "Nom du diplôme",
      "date": "Date d'obtention",
      "field": "Filière",
      "institution": "Nom de l'établissement"
    }
  ],
  "experiences": [
    {
      "position": "Titre du poste",
      "company": "Nom de l'entreprise",
      "period": "Période (ex: 2020-2023)",
      "description": "Description des responsabilités et réalisations"
    }
  ],
  "skills": [
    {
      "category": "Techniques",
      "list": ["Compétence 1", "Compétence 2", "Compétence 3"]
    },
    {
      "category": "Personnelles",
      "list": ["Compétence 1", "Compétence 2", "Compétence 3"]
    }
  ],
  "languages": [
    {
      "language": "Français",
      "level": "Natif"
    },
    {
      "language": "Anglais",
      "level": "Courant"
    }
  ]
}

Réponds UNIQUEMENT avec du JSON valide, sans aucun texte autour.
EOT;
    }
}
