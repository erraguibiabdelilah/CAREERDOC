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
     * Traite la requête vers l'API Azure OpenAI pour générer un CV à partir d'un texte.
     */
    public function processChat(Request $request)
    {
        // Valider la requête, on attend un champ "user_text"
        $data = $request->validate([
            'user_text' => 'required|string',
        ]);

        // Créer le tableau de messages pour l'API
        $messages = [
            [
                'role' => 'system',
                'content' => $this->buildSystemPrompt()
            ],
            [
                'role' => 'user',
                'content' => $data['user_text']
            ]
        ];

        // Récupérer la clé API depuis la config (.env)
        $apiKey = config('services.openai.key');

        // Configuration Azure OpenAI
        $azureEndpoint = 'https://models.inference.ai.azure.com/chat/completions';
        $model = 'DeepSeek-V3-0324';
        $temperature = 0.3; // Température basse pour des réponses plus cohérentes
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
            'response_format' => ['type' => 'json_object'] // Assure une réponse en JSON
        ];

        try {
            // Appel à l'API Azure OpenAI
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$apiKey,
            ])->post($azureEndpoint, $payload);

            // Déboguer la réponse brute de l'API
            $apiResult = $response->json();

            // Si la requête a échoué, retourner l'erreur
            if ($response->failed()) {
                return view('chat', [
                    'error' => 'La requête à l\'API Azure OpenAI a échoué.',
                    'details' => $apiResult,
                    'user_text' => $data['user_text'] // Renvoyer le texte saisi pour éviter de le perdre
                ]);
            }

            // Débogage - vérifier la structure de la réponse API
            $debug = [];
            $debug['api_result_structure'] = array_keys($apiResult);

            // Extraire le contenu de la réponse
            $content = null;
            if (isset($apiResult['choices'][0]['message']['content'])) {
                $content = $apiResult['choices'][0]['message']['content'];
                $debug['content_extracted'] = true;
            } else {
                $debug['content_extracted'] = false;
                $debug['api_result'] = $apiResult;
            }

            // Essayer de décoder le JSON retourné par l'API
            $parsedContent = null;
            if ($content) {
                try {
                    // Parfois, le contenu peut déjà être un tableau (selon l'API)
                    if (is_array($content)) {
                        $parsedContent = $content;
                        $debug['content_already_array'] = true;
                    } else {
                        $parsedContent = json_decode($content, true);
                        $debug['json_decode_attempted'] = true;

                        // Vérifier si le décodage a réussi
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            $debug['json_decode_error'] = json_last_error_msg();
                            // Essayer d'échapper les caractères spéciaux
                            $cleanContent = preg_replace('/[\x00-\x1F\x7F]/u', '', $content);
                            $parsedContent = json_decode($cleanContent, true);
                            $debug['fallback_json_decode_attempted'] = true;
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                $debug['fallback_json_decode_error'] = json_last_error_msg();
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // En cas d'erreur de décodage JSON
                    return view('chat', [
                        'error' => 'Impossible de décoder la réponse JSON: ' . $e->getMessage(),
                        'debug' => $debug,
                        'raw_content' => $content,
                        'user_text' => $data['user_text']
                    ]);
                }
            }

            // Si on attend une réponse JSON (requête AJAX)
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $parsedContent,
                    'debug' => $debug
                ]);
            }

            // Sinon, on retourne la vue avec les données
            return view('chat', [
                'result' => $parsedContent,
                'debug' => $debug,  // Ajouter les informations de débogage
                'raw_content' => $content, // Ajouter le contenu brut pour vérification
                'raw_response' => $apiResult,
                'user_text' => $data['user_text']
            ]);
        } catch (\Exception $e) {
            // Gérer les exceptions
            return view('chat', [
                'error' => 'Une erreur est survenue: ' . $e->getMessage(),
                'user_text' => $data['user_text']
            ]);
        }
    }

    /**
     * Construction du prompt système pour guider l'IA
     */
    private function buildSystemPrompt()
    {
        return <<<EOT
    Tu es un expert en ressources humaines et en extraction d'informations pertinentes pour les CV.
    Ta tâche est d'analyser le texte fourni par l'utilisateur et d'en extraire les informations essentielles pour générer un CV structuré au format JSON.

    L'utilisateur va te fournir une description textuelle de son parcours professionnel. Ton rôle est d'analyser ce texte pour en extraire:
    1. Une description personnelle concise dans la section "profile"
    2. Les formations académiques ("education") avec diplôme, date d'obtention, filière, et établissement
    3. Les expériences professionnelles
    4. Les langues maîtrisées et leurs niveaux

    RÈGLES IMPORTANTES:
    - Ne te contente pas de reformater le texte, ANALYSE-LE pour en extraire les informations pertinentes
    - Ne demande pas d'informations supplémentaires, travaille uniquement avec ce qui est fourni
    - Si une information est absente, laisse le champ vide ou avec une valeur par défaut appropriée
    - Pour les formations, détecte les diplômes obtenus, la date, la filière et l'établissement
    - Pour les expériences, extrais les dates/périodes, noms d'entreprises et postes occupés
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
    EOT;
    }
}
