<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GenrateCoverLetter extends Controller
{
    /**
     * Affiche le formulaire de génération de lettre de motivation
     */
    public function showForm()
    {
        return view('generateCover');
    }

    /**
     * Traite la requête vers l'API Azure OpenAI pour générer une lettre de motivation à partir d'un texte.
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
        $temperature = 0.7; // Température légèrement plus élevée pour la créativité
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
            // Suppression du format JSON pour retourner du texte brut
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
                return view('generateCover', [
                    'error' => 'La requête à l\'API Azure OpenAI a échoué.',
                    'details' => $apiResult,
                    'user_text' => $data['user_text'] // Renvoyer le texte saisi pour éviter de le perdre
                ]);
            }

            // Extraire le contenu de la réponse (texte de la lettre de motivation)
            $coverLetterText = null;
            if (isset($apiResult['choices'][0]['message']['content'])) {
                $coverLetterText = $apiResult['choices'][0]['message']['content'];
            } else {
                return view('generateCover', [
                    'error' => 'Format de réponse inattendu de l\'API.',
                    'api_result' => $apiResult,
                    'user_text' => $data['user_text']
                ]);
            }

            // Si on attend une réponse JSON (requête AJAX)
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'coverLetter' => $coverLetterText
                ]);
            }

            // Sinon, on retourne la vue avec le texte de la lettre de motivation
            return view('generateCover', [
                'coverLetter' => $coverLetterText,
                'user_text' => $data['user_text']
            ]);
        } catch (\Exception $e) {
            // Gérer les exceptions
            return view('generateCover', [
                'error' => 'Une erreur est survenue: ' . $e->getMessage(),
                'user_text' => $data['user_text']
            ]);
        }
    }

    /**
     * Construction du prompt système pour guider l'IA à générer une lettre de motivation
     */
    private function buildSystemPrompt()
    {
        return <<<EOT
    Tu es un expert en rédaction professionnelle spécialisé dans les lettres de motivation.

    Ta tâche est d'analyser les informations fournies par l'utilisateur et de générer une lettre de motivation complète,
    persuasive et personnalisée en français.

    L'utilisateur va te fournir des informations sur son profil professionnel, ses compétences, l'entreprise visée
    et/ou le poste convoité. À partir de ces éléments, tu dois rédiger une lettre de motivation complète.

    RÈGLES IMPORTANTES:
    - Élabore une lettre de motivation structurée avec introduction, développement et conclusion
    - Mets en avant les compétences et expériences pertinentes pour le poste visé
    - Explique la motivation du candidat et sa valeur ajoutée pour l'entreprise
    - Adopte un ton professionnel mais engageant
    - Personnalise la lettre en fonction des informations spécifiques fournies
    - Limite la longueur à environ 350-450 mots
    - N'invente pas d'informations qui ne sont pas présentes dans le texte fourni
    - Ne demande pas d'informations supplémentaires
    - Retourne uniquement le texte de la lettre, sans formatage particulier
    - N'inclus pas d'en-tête ni signature, seulement le corps de la lettre

    Réponds UNIQUEMENT avec le texte de la lettre de motivation, sans aucun commentaire ou explication.
    EOT;
    }
}
