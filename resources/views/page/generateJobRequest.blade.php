
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de Lettre de Motivation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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

        /* Lettre de motivation Preview */
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
    </style>
</head>
<body>

    <div class="container-fluid py-4">
        <a class="goback mx-3 p-2" href="{{ route('dashboard') }}"> <i class="bi bi-arrow-left-circle"></i> Go Back</a>
        <div class="row">
            <!-- Colonne de gauche avec formulaires -->
            <div class="col-lg-6 col-form">
                    <!-- Section Expéditeur -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#expediteurForm" aria-expanded="true">
                            <h5 class="mb-0">
                                <i class="bi bi-person-circle"></i> Informations de l'expéditeur
                            </h5>
                            <div>
                                <button type="button" class="btn btn-sm">
                                    <i class="bi bi-chevron-up"></i>
                                </button>
                            </div>
                        </div>
                        <div id="expediteurForm" class="collapse show">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nomPrenom" placeholder="Nom et Prénom" value="Ana MUÑOZ MUT">
                                    <label for="nomPrenom">Nom et Prénom</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="adresse" placeholder="Adresse" value="20 Rue Rodier Apt 8">
                                    <label for="adresse">Adresse</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="telephone" placeholder="Téléphone" value="06.95.78.40.15">
                                    <label for="telephone">Téléphone</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email" value="anamagda_93@hotmail.com">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Destinataire -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#destinataireForm" aria-expanded="true">
                            <h5 class="mb-0">
                                <i class="bi bi-building"></i> Informations du destinataire
                            </h5>
                            <div>
                                <button type="button" class="btn btn-sm">
                                    <i class="bi bi-chevron-up"></i>
                                </button>
                            </div>
                        </div>
                        <div id="destinataireForm" class="collapse show">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nomEntreprise" placeholder="Nom de l'entreprise" value="BNP PARIBAS">
                                    <label for="nomEntreprise">Nom de l'entreprise</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="adresseEntreprise" placeholder="Adresse de l'entreprise" value="81 Boulevard de Sébastopol">
                                    <label for="adresseEntreprise">Adresse de l'entreprise</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Date et Lieu -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#dateForm" aria-expanded="true">
                            <h5 class="mb-0">
                                <i class="bi bi-calendar"></i> Date et Lieu
                            </h5>
                            <div>
                                <button type="button" class="btn btn-sm">
                                    <i class="bi bi-chevron-up"></i>
                                </button>
                            </div>
                        </div>
                        <div id="dateForm" class="collapse show">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lieuDate" placeholder="Lieu et Date" value="Paris, le Mardi 1 Avril 2014">
                                    <label for="lieuDate">Lieu et Date</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Contenu de la lettre -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#contenuForm" aria-expanded="true">
                            <h5 class="mb-0">
                                <i class="bi bi-file-text"></i> Contenu de la lettre
                            </h5>
                            <div>
                                <button type="button" class="btn btn-sm">
                                    <i class="bi bi-chevron-up"></i>
                                </button>
                            </div>
                        </div>
                        <div id="contenuForm" class="collapse show">
                            <div class="card-body">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="objet" placeholder="Objet" value="demande de stage">
                                    <label for="objet">objet</label>

                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="formule" placeholder="Formule de politesse" value="Madame, Monsieur,">
                                    <label for="formule">Formule de politesse</label>
                                </div>

                                    <div class="mb-3">
                                        <label for="contenuLettre" class="form-label">Contenu de la lettre</label>
                                        <textarea class="form-control" id="contenuLettre" name="contenuLettre" rows="10">
                                        @if(isset($coverLetterText))
                                                        {{ $coverLetterText }}
                                        @endif
                                        </textarea>

                                    </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="signature" placeholder="Signature" value="Ana Muñoz Mut">
                                    <label for="signature">Signature</label>
                                </div>



                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <button class="btn btn-success btn-save me-2" type="button">
                                <i class="bi bi-save"></i> Enregistrer
                            </button>
                            <button class="btn btn-primary btn-print" type="button">
                                <i class="bi bi-printer"></i> Imprimer
                            </button>
                        </div>
                    </div>
            </div>

            <!-- Colonne de droite avec aperçu de la lettre -->
            <div class="result  col-lg-6">
                <div class="lettre-preview">
                    <div class="expediteur-info">
                        <div id="previewNomPrenom">Ana MUÑOZ MUT</div>
                        <div id="previewAdresse">20 Rue Rodier Apt 8</div>
                        <div id="previewTelephone">06.95.78.40.15</div>
                        <div id="previewEmail">anamagda_93@hotmail.com</div>
                    </div>

                    <div class="destinataire-info">
                        <div id="previewNomEntreprise" style="font-weight: bold;">BNP PARIBAS</div>
                        <div id="previewAdresseEntreprise">81 Boulevard de Sébastopol</div>
                    </div>
                    Objet :<span id="previewObjet">demande de stage </span>


                    <div class="date" id="previewLieuDate">Paris, le Mardi 1 Avril 2014</div>

                    <div id="previewFormule">Madame, Monsieur,</div>

                    <div class="contenu-lettre" id="previewContenuLettre">
                        @if(isset($coverLetterText))
                                                        {{ $coverLetterText }}

                         @endif
                    </div>

                    <div class="signature" id="previewSignature">Ana Muñoz Mut</div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap et JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sélection de tous les headers de carte
            const cardHeaders = document.querySelectorAll('.card-header');

            // Ajouter l'événement click à chaque header
            cardHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    // Identifier la cible de l'accordéon
                    const target = this.getAttribute('data-bs-target');
                    const targetElement = document.querySelector(target);

                    // Basculer l'état de l'accordéon
                    targetElement.classList.toggle('show');

                    // Mettre à jour les icônes (flèches)
                    const icon = this.querySelector('.bi-chevron-up, .bi-chevron-down');
                    if (targetElement.classList.contains('show')) {
                        icon.className = 'bi bi-chevron-up';
                    } else {
                        icon.className = 'bi bi-chevron-down';
                    }
                });
            });

            // Mise à jour en temps réel des champs du formulaire vers l'aperçu de la lettre

            // Informations de l'expéditeur
            document.getElementById('nomPrenom').addEventListener('input', function() {
                document.getElementById('previewNomPrenom').textContent = this.value;
            });

            document.getElementById('adresse').addEventListener('input', function() {
                document.getElementById('previewAdresse').textContent = this.value;
            });

            document.getElementById('telephone').addEventListener('input', function() {
                document.getElementById('previewTelephone').textContent = this.value;
            });

            document.getElementById('email').addEventListener('input', function() {
                document.getElementById('previewEmail').textContent = this.value;
            });

            // Informations du destinataire
            document.getElementById('nomEntreprise').addEventListener('input', function() {
                document.getElementById('previewNomEntreprise').textContent = this.value;
            });

            document.getElementById('adresseEntreprise').addEventListener('input', function() {
                document.getElementById('previewAdresseEntreprise').textContent = this.value;
            });

            // Date et lieu
            document.getElementById('lieuDate').addEventListener('input', function() {
                document.getElementById('previewLieuDate').textContent = this.value;
            });

            // Contenu de la lettre
            document.getElementById('formule').addEventListener('input', function() {
                document.getElementById('previewFormule').textContent = this.value;
            });

            document.getElementById('contenuLettre').addEventListener('input', function() {
                // Remplacer les sauts de ligne par des <br>
                const contenuFormate = this.value.replace(/\n\n/g, '<br><br>');
                document.getElementById('previewContenuLettre').innerHTML = contenuFormate;
            });

            document.getElementById('signature').addEventListener('input', function() {
                document.getElementById('previewSignature').textContent = this.value;
            });

            // Fonctionnalité d'impression
            document.querySelector('.btn-print').addEventListener('click', function(e) {
                e.preventDefault();
                window.print();
            });

            // Fonctionnalité d'enregistrement
            document.querySelector('.btn-save').addEventListener('click', function(e) {
                e.preventDefault();
                // Afficher la modal d'enregistrement
                const saveModal = new bootstrap.Modal(document.getElementById('saveModal'));
                saveModal.show();
            });

            // Afficher le spinner pour le bouton AI lors de la soumission
            document.getElementById('btnAI').addEventListener('click', function() {
                const spinner = document.getElementById('aiSpinner');
                spinner.classList.remove('d-none');
            });
        });
    </script>
</body>
</html>
