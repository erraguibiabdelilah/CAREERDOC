<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de Lettre de Motivation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 2rem;
        }
        .cover-letter-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 1.5rem;
            white-space: pre-line;
        }
        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn-generate {
            background-color: #4a6fdc;
            border-color: #4a6fdc;
        }
        .btn-generate:hover {
            background-color: #3a5fc9;
            border-color: #3a5fc9;
        }
        .loading {
            display: none;
            text-align: center;
            margin-top: 1rem;
        }
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="text-center mb-4">Générateur de Lettre de Motivation</h1>

                @if(isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                    @if(isset($details))
                        <pre>{{ json_encode($details, JSON_PRETTY_PRINT) }}</pre>
                    @endif
                </div>
                @endif

                <div class="form-container">
                    <form id="coverLetterForm" method="POST" action="{{ route('CoverGenerate') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="user_text" class="form-label">Décrivez votre profil, le poste visé et l'entreprise</label>
                            <textarea
                                class="form-control"
                                id="user_text"
                                name="user_text"
                                rows="8"
                                placeholder="Exemple: Je suis un développeur web avec 5 ans d'expérience en PHP et JavaScript. Je postule pour le poste de Lead Developer chez Acme Inc, une entreprise spécialisée dans les solutions e-commerce. J'ai une expérience en gestion d'équipe et en méthodologies agiles..."
                                required
                            >{{ $user_text ?? '' }}</textarea>
                            <div class="form-text">Fournissez suffisamment d'informations sur votre expérience, vos compétences, le poste et l'entreprise pour générer une lettre pertinente.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-generate btn-primary">Générer ma lettre de motivation</button>
                        </div>
                    </form>

                    <div class="loading">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Génération en cours...</span>
                        </div>
                        <p class="mt-2">Génération de votre lettre de motivation en cours...</p>
                    </div>
                </div>

                @if(isset($coverLetter))
                <div class="mt-4 mb-2">
                    <h2>Votre lettre de motivation</h2>
                    <div class="d-flex justify-content-end">
                        <button id="copyButton" class="btn btn-sm btn-outline-secondary me-2">Copier</button>
                        <button id="downloadButton" class="btn btn-sm btn-outline-primary">Télécharger</button>
                    </div>
                </div>
                <div class="cover-letter-container" id="coverLetterText">
                    {{ $coverLetter }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Afficher l'animation de chargement lors de la soumission du formulaire
        document.getElementById('coverLetterForm').addEventListener('submit', function() {
            document.querySelector('.loading').style.display = 'block';
        });

        // Fonction pour copier la lettre de motivation
        @if(isset($coverLetter))
        document.getElementById('copyButton').addEventListener('click', function() {
            const text = document.getElementById('coverLetterText').innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Lettre de motivation copiée dans le presse-papier !');
            });
        });

        // Fonction pour télécharger la lettre de motivation
        document.getElementById('downloadButton').addEventListener('click', function() {
            const text = document.getElementById('coverLetterText').innerText;
            const blob = new Blob([text], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);

            const a = document.createElement('a');
            a.href = url;
            a.download = 'lettre_de_motivation.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        });
        @endif
    </script>
</body>
</html>
