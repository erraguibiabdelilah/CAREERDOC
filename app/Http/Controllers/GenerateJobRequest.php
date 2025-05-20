<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GenerateJobRequest extends Controller
{
    /**
     * Affiche le formulaire de génération de lettre de motivation
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
        $temperature = 0.7;
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

                return view('page.generateJobRequest', [
                    'error' => 'La requête à l\'API Azure OpenAI a échoué.',
                    'details' => $response->json(),
                    'description' => $data['description']
                ]);
            }

            // Extraire le contenu de la réponse
            $apiResult = $response->json();
            $coverLetterText = null;

            if (isset($apiResult['choices'][0]['message']['content'])) {
                $coverLetterText = $apiResult['choices'][0]['message']['content'];
            } else {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Format de réponse inattendu de l\'API.',
                        'details' => $apiResult
                    ], 500);
                }

                return view('page.generateJobRequest', [
                    'error' => 'Format de réponse inattendu de l\'API.',
                    'details' => $apiResult,
                    'description' => $data['description']
                ]);
            }

            // Si c'est une requête AJAX, retourner uniquement le texte de la lettre
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'text' => $coverLetterText
                ]);
            }

            // Sinon, retourner la vue avec le texte de la lettre
            return view('page.generateJobRequest', [
                'coverLetterText' => $coverLetterText,
                'description' => $data['description']
            ]);
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Une erreur est survenue: ' . $e->getMessage()
                ], 500);
            }

            return view('page.generateJobRequest', [
                'error' => 'Une erreur est survenue: ' . $e->getMessage(),
                'description' => $data['description']
            ]);
        }
    }

    /**
     * Construction du prompt système pour guider l'IA à générer une lettre de motivation
     */
    private function buildSystemPrompt()
    {
        return <<<EOT


Tu es un expert en

Analyse les informations fournies par l'utilisateur (profil, compétences, poste, entreprise, etc.) et génère une demande d'emploi claire, convaincante et personnalisée en français.

RÈGLES :

Tu es un expert en rédaction professionnelle spécialisé dans rédaction de demandes d'emploi professionnelles.

Ta tâche est d'analyser les informations fournies par l'utilisateur et de générer génère une demande d'emploi claire complète,
persuasive et personnalisée en français.

L'utilisateur va te fournir des informations sur son profil professionnel, ses compétences, l'entreprise visée
et/ou le poste convoité. À partir de ces éléments, tu dois rédiger une demandes d'emploi professionnelles complète.

RÈGLES IMPORTANTES:

- Élabore une demandes d'emploi  structurée avec introduction, développement et conclusion
- Mets en avant les compétences et expériences pertinentes pour le poste visé
- Explique la motivation du candidat et sa valeur ajoutée pour l'entreprise
- Adopte un ton professionnel mais engageant
- Personnalise la lettre en fonction des informations spécifiques fournies
- Limite la longueur à environ 350-450 mots
- N'invente pas d'informations qui ne sont pas présentes dans le texte fourni
- Retourne uniquement le texte de la lettre, sans formatage particulier
- N'inclus pas d'en-tête ni signature, seulement le corps de la
-- Ne génère pas de ligne d'objet (ex. "Objet : ...") ni de titre

Réponds UNIQUEMENT avec le texte de la demandes d'emploi , sans aucun commentaire ou explication.
EOT;
    }
}
