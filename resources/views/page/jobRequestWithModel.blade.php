<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Générateur de Demande d'Emploi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card-header {
            cursor: pointer;
            background-color: #fff;
            border-bottom: none;
            padding: 15px;
        }
        .card-body {
            padding: 20px;
        }
        .form-floating {
            margin-bottom: 15px;
        }
        .btn-save {
            background-color: #4a6da7;
            color: white;
        }
        .btn-tips {
            background-color: transparent;
            border: 1px solid #ddd;
        }
        .btn-ai {
            background-color: #6c5ce7;
            color: white;
        }
        .btn-ai:hover {
            background-color: #5849c2;
            color: white;
        }
        .spinner-border {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
        }
        /* Preview */
        .lettre-preview {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            height: 100%;
            position: sticky;
            top: 20px;
            padding: 40px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }
        .expediteur-info {
            margin-bottom: 30px;
        }
        .destinataire-info {
            text-align: right;
            margin-bottom: 30px;
        }
        .date {
            text-align: right;
            margin-bottom: 30px;
        }
        .contenu-lettre {
            margin-bottom: 50px;
            text-align: justify;
            white-space: pre-wrap;
        }
        .signature {
            text-align: right;
            margin-top: 40px;
        }
        @media print {
            .col-form {
                display: none;
            }
            .lettre-preview {
                box-shadow: none;
                height: auto;
            }
            body {
                background-color: #fff;
            }
            .container-fluid {
                padding: 0;
            }
            .btn-print, .btn-ai, .btn-save, .btn-tips {
                display: none;
            }
        }
        .goback{
            text-decoration: none;
            color:#01096F;
        }
        .goback:hover{
            text-decoration: none;
            color:#01096F;
            text-decoration: underline #01096F;
        }
        @media print {
            .goback {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <a class="goback mx-3 my-3" href="{{ route('dashboard') }}">
        <i class="bi bi-arrow-left-circle"></i> Retour
    </a>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Colonne gauche : formulaire -->
            <div class="col-lg-6 col-form">
                <form action="{{ route('JobRequest.store') }}" method="POST">
                    @csrf

                    <!-- Expéditeur -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#expediteurForm" aria-expanded="true">
                            <h5 class="mb-0"><i class="bi bi-person-circle"></i> Informations du candidat</h5>
                            <div><button type="button" class="btn btn-sm"><i class="bi bi-chevron-up"></i></button></div>
                        </div>
                        <div id="expediteurForm" class="collapse show">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nomPrenom" name="nomEmetteur" placeholder="Nom et Prénom" value="Imane Irafan">
                                    <label for="nomPrenom">Nom et Prénom</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="adresse" name="adresseEmetteur" placeholder="Adresse" value="123 Rue des Fleurs, Marrakech">
                                    <label for="adresse">Adresse</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="telephone" name="tel" placeholder="Téléphone" value="06 12 34 56 78">
                                    <label for="telephone">Téléphone</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="imane.irafan@example.com">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Destinataire -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#destinataireForm" aria-expanded="true">
                            <h5 class="mb-0"><i class="bi bi-building"></i> Informations de l'entreprise</h5>
                            <div><button type="button" class="btn btn-sm"><i class="bi bi-chevron-up"></i></button></div>
                        </div>
                        <div id="destinataireForm" class="collapse show">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nomEntreprise" name="entrepriseName" placeholder="Nom de l'entreprise" value="Société XYZ">
                                    <label for="nomEntreprise">Nom de l'entreprise</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="adresseEntreprise" name="adresseEntreprise" placeholder="Adresse de l'entreprise" value="45 Avenue des Champs">
                                    <label for="adresseEntreprise">Adresse de l'entreprise</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date et lieu -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#dateForm" aria-expanded="true">
                            <h5 class="mb-0"><i class="bi bi-calendar"></i> Date et lieu</h5>
                            <div><button type="button" class="btn btn-sm"><i class="bi bi-chevron-up"></i></button></div>
                        </div>
                        <div id="dateForm" class="collapse show">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lieuDate" name="lieuEtDate" placeholder="Lieu et Date" value="Marrakech, le 16 mai 2025">
                                    <label for="lieuDate">Lieu et Date</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenu de la demande -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#contenuForm" aria-expanded="true">
                            <h5 class="mb-0"><i class="bi bi-file-text"></i> Contenu de la demande</h5>
                            <div><button type="button" class="btn btn-sm"><i class="bi bi-chevron-up"></i></button></div>
                        </div>
                        <div id="contenuForm" class="collapse show">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="objet" name="objet" placeholder="Objet" value="Demande d'emploi - Ingénieure informatique">
                                    <label for="objet">Objet</label>
                                </div>
                                <div class="mb-3">
                                    <label for="contenuLettre" class="form-label">Contenu de la demande</label>
                                    <textarea class="form-control" id="contenuLettre" name="contenu" rows="10">Madame, Monsieur,

Actuellement diplômée en ingénierie informatique et systèmes embarqués, je souhaite vous soumettre ma candidature pour un poste au sein de votre entreprise. Mon parcours académique et mes expériences pratiques m'ont permis de développer des compétences solides en développement logiciel et gestion des systèmes embarqués.

Je suis motivée, rigoureuse et désireuse d'intégrer une équipe dynamique où je pourrai mettre à profit mes connaissances tout en continuant à apprendre et évoluer professionnellement.

Je reste à votre disposition pour un entretien afin de vous exposer plus en détail mes motivations et compétences.

Dans l'attente de votre réponse, veuillez recevoir, Madame, Monsieur, mes salutations distinguées.
                                    </textarea>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="signature" name="signature" placeholder="Signature" value="Imane Irafan">
                                    <label for="signature">Signature</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                           <button class="btn btn-success btn-save me-2" type="submit">
                <i class="bi bi-save"></i> Enregistrer
            </button>
            <button class="btn btn-primary btn-print" type="button">
                <i class="bi bi-printer"></i> Imprimer
            </button>
                        </div>
                       <!-- <div>
                            <button type="button" class="btn btn-ai" id="generateAI">
                                <i class="bi bi-robot"></i> Générer avec IA
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-tips" id="showTips">
                                <i class="bi bi-lightbulb"></i> Astuces
                            </button>
                        </div>-->
                    </div>
                </form>
            </div>
            <!-- Colonne droite : aperçu de la lettre -->
            <div class="col-lg-6">
                <div class="lettre-preview" id="lettrePreview">
                    <div class="expediteur-info">
                        <strong>Imane Irafan</strong><br>
                        123 Rue des Fleurs, Marrakech<br>
                        Tel : 06 12 34 56 78<br>
                        Email : imane.irafan@example.com
                    </div>
                    <div class="destinataire-info">
                        <strong>Société XYZ</strong><br>
                        45 Avenue des Champs
                    </div>
                    <div class="date" id="datePreview">
                        Marrakech, le 16 mai 2025
                    </div>
                    <h4>Objet : Demande d'emploi - Ingénieure informatique</h4>
                    <div class="contenu-lettre" id="contenuPreview" style="white-space: pre-wrap;">
Madame, Monsieur,

Actuellement diplômée en ingénierie informatique et systèmes embarqués, je souhaite vous soumettre ma candidature pour un poste au sein de votre entreprise. Mon parcours académique et mes expériences pratiques m'ont permis de développer des compétences solides en développement logiciel et gestion des systèmes embarqués.

Je suis motivée, rigoureuse et désireuse d'intégrer une équipe dynamique où je pourrai mettre à profit mes connaissances tout en continuant à apprendre et évoluer professionnellement.

Je reste à votre disposition pour un entretien afin de vous exposer plus en détail mes motivations et compétences.

Dans l'attente de votre réponse, veuillez recevoir, Madame, Monsieur, mes salutations distinguées.
                    </div>
                    <div class="signature">
                        Imane Irafan
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mise à jour du preview en temps réel
    const inputs = document.querySelectorAll('input, textarea');
    const preview = document.getElementById('lettrePreview');
    const contenuPreview = document.getElementById('contenuPreview');

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            // Expéditeur
            preview.querySelector('.expediteur-info').innerHTML = `
                <strong>${document.getElementById('nomPrenom').value}</strong><br>
                ${document.getElementById('adresse').value.replace(/\n/g, '<br>')}<br>
                Tel : ${document.getElementById('telephone').value}<br>
                Email : ${document.getElementById('email').value}
            `;

            // Destinataire
            preview.querySelector('.destinataire-info').innerHTML = `
                <strong>${document.getElementById('nomEntreprise').value}</strong><br>
                ${document.getElementById('adresseEntreprise').value.replace(/\n/g, '<br>')}
            `;

            // Date
            preview.querySelector('.date').textContent = document.getElementById('lieuDate').value;

            // Objet
            preview.querySelector('h4').textContent = "Objet : " + document.getElementById('objet').value;

            // Contenu
            contenuPreview.textContent = document.getElementById('contenuLettre').value;

            // Signature
            preview.querySelector('.signature').textContent = document.getElementById('signature').value;
        });
    });
    // Fonctionnalité d'impression
            document.querySelector('.btn-print').addEventListener('click', function(e) {
                e.preventDefault();
                window.print();
            });

            // Fonctionnalité d'enregistrement
            document.querySelector('.btn-save').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('form').submit();
            });

    // Exemple simple pour boutons IA et Astuces (tu peux personnaliser)
   // document.getElementById('generateAI').addEventListener('click', () => {
    //    alert("Fonction IA à implémenter !");
    //});

  //  document.getElementById('showTips').addEventListener('click', () => {
   //     alert("Astuces : \n- Soignez votre présentation.\n- Adaptez votre demande au poste.\n- Soyez clair et concis.");
   // });
</script>
</body>
</html>