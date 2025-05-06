<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Générateur de CV</title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }

        /* Formulaire */
        textarea {
            width: 100%;
            height: 200px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Conteneurs */
        .response {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            overflow: auto;
        }

        .error {
            color: red;
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ffcccc;
            border-radius: 5px;
            background-color: #fff0f0;
        }

        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        /* Styles spécifiques au CV */
        .cv-container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-family: 'Calibri', 'Helvetica', sans-serif;
        }

        .cv-container h2 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .cv-section {
            margin-bottom: 25px;
        }

        .cv-section h3 {
            color: #3498db;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        /* Formation */
        .education-list {
            list-style-type: none;
            padding: 0;
        }

        .education-item {
            margin-bottom: 15px;
        }

        .education-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .education-details {
            padding-left: 10px;
            color: #555;
        }

        .education-institution {
            font-weight: 500;
            margin-bottom: 3px;
        }

        .education-date {
            color: #777;
            font-style: italic;
        }

        /* Expériences */
        .experience-list {
            list-style-type: none;
            padding: 0;
        }

        .experience-item {
            margin-bottom: 20px;
        }

        .experience-header {
            margin-bottom: 8px;
        }

        .experience-title {
            font-size: 1.05em;
            margin-bottom: 3px;
        }

        .experience-company {
            display: flex;
            justify-content: space-between;
            color: #555;
        }

        .experience-period {
            font-style: italic;
            color: #777;
        }

        .experience-description {
            padding-left: 10px;
            text-align: justify;
        }

        /* Langues */
        .language-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }

        .language-item {
            margin-right: 30px;
            margin-bottom: 10px;
        }

        .language-level {
            color: #555;
        }

        /* Boutons d'action */
        .cv-actions {
            text-align: center;
            margin-top: 30px;
        }

        .print-button {
            background-color: #3498db;
        }

        .print-button:hover {
            background-color: #2980b9;
        }

        /* Styles d'impression */
        @media print {
            body, html {
                margin: 0;
                padding: 0;
                background-color: white;
            }

            h1, form, .error, .debug-info, .raw-content {
                display: none !important;
            }

            .cv-container {
                box-shadow: none;
                padding: 0;
                margin: 0;
            }

            .cv-actions {
                display: none;
            }
        }
    </style>
</head>
<body>
    <h1>Générateur de CV</h1>

    <form action="{{ route('openai.autoCV') }}" method="POST">
        @csrf
        <p>Décrivez votre parcours professionnel, vos formations et vos compétences linguistiques :</p>
        <textarea name="user_text" placeholder="Exemple: J'ai obtenu mon Master en informatique à l'Université de Paris en 2020. J'ai travaillé comme développeur web chez ABC Tech de 2020 à 2023...">{{ $user_text ?? '' }}</textarea>
        <button type="submit">Générer mon CV</button>
    </form>

    @if(isset($error))
    <div class="error">
        <h3>Erreur :</h3>
        <p>{{ $error }}</p>
        @if(isset($details))
            <pre>{{ json_encode($details, JSON_PRETTY_PRINT) }}</pre>
        @endif
    </div>
    @endif

    @if(isset($result))
    <div class="response cv-container">
        <h2>Curriculum Vitae</h2>

        @if(isset($$raw_content['profile']))
        <div class="cv-section">
            <h3>Profil</h3>
            <p>{{ $result['profile'] }}</p>
        </div>
        @endif

        @if(isset($$raw_content['education']) && count($$raw_content['education']) > 0)
        <div class="cv-section">
            <h3>Formation</h3>
            <ul class="education-list">
                @foreach($result['education'] as $education)
                <li class="education-item">
                    <div class="education-title">
                        <strong>{{ $education['degree'] ?? 'Non spécifié' }}</strong>
                        @if(isset($education['date']) && !empty($education['date']))
                        <span class="education-date">{{ $education['date'] }}</span>
                        @endif
                    </div>
                    <div class="education-details">
                        @if(isset($education['institution']) && !empty($education['institution']))
                        <div class="education-institution">{{ $education['institution'] }}</div>
                        @endif
                        @if(isset($education['field']) && !empty($education['field']))
                        <div class="education-field">Filière : {{ $education['field'] }}</div>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(isset($result['experiences']) && count($result['experiences']) > 0)
        <div class="cv-section">
            <h3>Expériences professionnelles</h3>
            <ul class="experience-list">
                @foreach($result['experiences'] as $experience)
                <li class="experience-item">
                    <div class="experience-header">
                        <div class="experience-title">
                            <strong>{{ $experience['position'] ?? 'Poste non spécifié' }}</strong>
                        </div>
                        <div class="experience-company">
                            {{ $experience['company'] ?? 'Entreprise non spécifiée' }}
                            @if(isset($experience['period']) && !empty($experience['period']))
                            <span class="experience-period">{{ $experience['period'] }}</span>
                            @endif
                        </div>
                    </div>
                    @if(isset($experience['description']) && !empty($experience['description']))
                    <div class="experience-description">
                        {{ $experience['description'] }}
                    </div>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(isset($result['languages']) && count($result['languages']) > 0)
        <div class="cv-section">
            <h3>Langues</h3>
            <ul class="language-list">
                @foreach($result['languages'] as $language)
                <li class="language-item">
                    <strong>{{ $language['language'] ?? 'Non spécifié' }}</strong>:
                    <span class="language-level">{{ $language['level'] ?? 'Niveau non spécifié' }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="cv-actions">
            <button onclick="window.print()" class="print-button">Imprimer ce CV</button>
        </div>
    </div>
    @endif

    {{-- Affichage du contenu brut pour débogage --}}
    @if(isset($raw_content))
    <div class="response">
        <h3>Contenu brut reçu de l'API :</h3>
        <pre>{{ $raw_content }}</pre>
    </div>
    @endif

    {{-- Informations de débogage --}}
    @if(isset($debug))
    <div class="response">
        <h3>Informations de débogage :</h3>
        <pre>{{ json_encode($debug, JSON_PRETTY_PRINT) }}</pre>
    </div>
    @endif
</body>
</html>
