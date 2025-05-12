<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        /* CV Preview */
        .cv-preview {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            height: 100%;
            position: sticky;
            top: 20px;
        }
        .cv-header {
            background-color: #7D3C31;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .cv-content {
            padding: 20px;
        }
        .cv-section {
            margin-bottom: 25px;
        }
        .cv-section-title {
            color: #7D3C31;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 8px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .education-item, .experience-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #eee;
        }
        .education-item h5, .experience-item h5 {
            margin-bottom: 5px;
            font-weight: 600;
        }
        .date-location {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        /* Custom icons */
        .section-icon {
            margin-right: 10px;
            color: #555;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .cv-preview {
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Colonne de gauche avec formulaires -->
            <div class="col-lg-6">
                <!-- Section Profil -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#profileForm" aria-expanded="true">
                        <h5 class="mb-0">
                            <i class="bi bi-person-circle section-icon"></i> Profil
                        </h5>
                        <div>
                            <button class="btn btn-sm" type="button">
                                <i class="bi bi-chevron-up"></i>
                            </button>
                            <button class="btn btn-sm" type="button">
                                <i class="bi bi-gear"></i>
                            </button>
                        </div>
                    </div>
                    <div id="profileForm" class="collapse show">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="fullName" placeholder="Nom complet">
                                <label for="fullName">Nom complet</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="jobTitle" placeholder="Titre du poste">
                                <label for="jobTitle">Titre du poste</label>
                            </div>
                            <div class="mb-3">
                                <label for="profileDescription" class="form-label">Description</label>
                                <div class="btn-toolbar mb-2" role="toolbar">
                                    <div class="btn-group me-2" role="group">
                                        <button type="button" class="btn btn-outline-secondary">B</button>
                                        <button type="button" class="btn btn-outline-secondary">I</button>
                                        <button type="button" class="btn btn-outline-secondary">U</button>
                                    </div>
                                    <div class="btn-group me-2" role="group">
                                        <button type="button" class="btn btn-outline-secondary">
                                            <i class="bi bi-list-ul"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary">
                                            <i class="bi bi-list-ol"></i>
                                        </button>
                                    </div>
                                </div>
                                <textarea class="form-control" id="profileDescription" rows="5"></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-tips">
                                    <i class="bi bi-lightbulb"></i> Conseils
                                </button>
                                <button class="btn btn-save">
                                    <i class="bi bi-save"></i> Sauvegarder
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Formation scolaire -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#educationForm" aria-expanded="false">
                        <h5 class="mb-0">
                            <i class="bi bi-mortarboard-fill section-icon"></i> Formation scolaire
                        </h5>
                        <div>
                            <button class="btn btn-sm" type="button">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <button class="btn btn-sm" type="button">
                                <i class="bi bi-gear"></i>
                            </button>
                        </div>
                    </div>
                    <div id="educationForm" class="collapse">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="schoolName" placeholder="Nom de l'école">
                                <label for="schoolName">Nom de l'école</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="degree" placeholder="Diplôme">
                                <label for="degree">Diplôme</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="eduStartDate" placeholder="Date de début">
                                        <label for="eduStartDate">Date de début</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="eduEndDate" placeholder="Date de fin">
                                        <label for="eduEndDate">Date de fin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="eduLocation" placeholder="Lieu">
                                <label for="eduLocation">Lieu</label>
                            </div>
                            <div class="mb-3">
                                <label for="eduDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="eduDescription" rows="3"></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-tips">
                                    <i class="bi bi-lightbulb"></i> Conseils
                                </button>
                                <button class="btn btn-save">
                                    <i class="bi bi-save"></i> Sauvegarder
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Expérience professionnelle -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#experienceForm" aria-expanded="false">
                        <h5 class="mb-0">
                            <i class="bi bi-briefcase-fill section-icon"></i> Expérience professionnelle
                        </h5>
                        <div>
                            <button class="btn btn-sm" type="button">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <button class="btn btn-sm" type="button">
                                <i class="bi bi-gear"></i>
                            </button>
                        </div>
                    </div>
                    <div id="experienceForm" class="collapse">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="companyName" placeholder="Nom de l'entreprise">
                                <label for="companyName">Nom de l'entreprise</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="position" placeholder="Poste">
                                <label for="position">Poste</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="expStartDate" placeholder="Date de début">
                                        <label for="expStartDate">Date de début</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="expEndDate" placeholder="Date de fin">
                                        <label for="expEndDate">Date de fin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="expLocation" placeholder="Lieu">
                                <label for="expLocation">Lieu</label>
                            </div>
                            <div class="mb-3">
                                <label for="expDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="expDescription" rows="3"></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-tips">
                                    <i class="bi bi-lightbulb"></i> Conseils
                                </button>
                                <button class="btn btn-save">
                                    <i class="bi bi-save"></i> Sauvegarder
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite avec aperçu du CV -->
            <div class="col-lg-6">
                <div class="cv-preview">
                    <div class="cv-header">
                        <h2 id="previewName">Abdellah Erraguibi</h2>
                        <p id="previewJobTitle">Développeur Web</p>
                    </div>
                    <div class="cv-content">
                        <div class="cv-section">
                            <h3 class="cv-section-title">Informations personnelles</h3>
                            <p id="previewDescription">
                                @if (isset($cvJsonText))
                                    {{$cvJsonText->profile}}
                                @endif

                                @else
                                Professionnel dynamique avec une solide expérience dans divers secteurs, désireux de relever de nouveaux défis. Capable de travailler en équipe et de s'adapter rapidement aux environnements en constante évolution pour atteindre les objectifs fixés.

                                @endforelse
                            </p>
                        </div>

                        <div class="cv-section">
                            <h3 class="cv-section-title">Formation</h3>
                            <div class="education-item">


                                <h5 id="previewSchool">Université de Paris</h5>
                                <div class="date-location">
                                    <span id="previewEduDates">2018 - 2020</span> | <span id="previewEduLocation">Paris, France</span>
                                </div>
                                <p id="previewDegree">Master en Informatique</p>
                                <p id="previewEduDescription">Spécialisation en développement web et applications mobiles avec un projet de fin d'études sur les technologies de l'information.</p>
                            </div>
                        </div>

                        <div class="cv-section">
                            <h3 class="cv-section-title">Expérience professionnelle</h3>
                            <div class="experience-item">
                                <h5 id="previewCompany">TechSolutions</h5>
                                <p id="previewPosition">Développeur Full-Stack</p>
                                <div class="date-location">
                                    <span id="previewExpDates">2020 - Présent</span> | <span id="previewExpLocation">Lyon, France</span>
                                </div>
                                <p id="previewExpDescription">Développement et maintenance d'applications web pour divers clients. Mise en place de solutions techniques adaptées aux besoins spécifiques.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap et JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script pour faire fonctionner l'accordéon
        document.addEventListener('DOMContentLoaded', function() {
            // Sélection de tous les headers de carte
            const cardHeaders = document.querySelectorAll('.card-header');

            // Ajouter l'événement click à chaque header
            cardHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    // Identifier la cible de l'accordéon
                    const target = this.getAttribute('data-bs-target');
                    const targetElement = document.querySelector(target);

                    // Fermer tous les autres accordéons
                    document.querySelectorAll('.collapse').forEach(collapse => {
                        if (collapse.id !== targetElement.id) {
                            collapse.classList.remove('show');
                        }
                    });

                    // Basculer l'état de l'accordéon actuel
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

            // Mise à jour en temps réel des champs du formulaire vers l'aperçu du CV

            // Profil
            document.getElementById('fullName').addEventListener('input', function() {
                document.getElementById('previewName').textContent = this.value || 'Abdellah Erraguibi';
            });

            document.getElementById('jobTitle').addEventListener('input', function() {
                document.getElementById('previewJobTitle').textContent = this.value || 'Développeur Web';
            });

            document.getElementById('profileDescription').addEventListener('input', function() {
                document.getElementById('previewDescription').textContent = this.value || 'Professionnel dynamique avec une solide expérience dans divers secteurs...';
            });

            // Formation
            document.getElementById('schoolName').addEventListener('input', function() {
                document.getElementById('previewSchool').textContent = this.value || 'Université de Paris';
            });

            document.getElementById('degree').addEventListener('input', function() {
                document.getElementById('previewDegree').textContent = this.value || 'Master en Informatique';
            });

            document.getElementById('eduStartDate').addEventListener('input', updateEducationDates);
            document.getElementById('eduEndDate').addEventListener('input', updateEducationDates);

            function updateEducationDates() {
                const startDate = document.getElementById('eduStartDate').value;
                const endDate = document.getElementById('eduEndDate').value;

                if (startDate || endDate) {
                    document.getElementById('previewEduDates').textContent = `${startDate || ''} - ${endDate || ''}`;
                } else {
                    document.getElementById('previewEduDates').textContent = '2018 - 2020';
                }
            }

            document.getElementById('eduLocation').addEventListener('input', function() {
                document.getElementById('previewEduLocation').textContent = this.value || 'Paris, France';
            });

            document.getElementById('eduDescription').addEventListener('input', function() {
                document.getElementById('previewEduDescription').textContent = this.value || 'Spécialisation en développement web et applications mobiles...';
            });

            // Expérience professionnelle
            document.getElementById('companyName').addEventListener('input', function() {
                document.getElementById('previewCompany').textContent = this.value || 'TechSolutions';
            });

            document.getElementById('position').addEventListener('input', function() {
                document.getElementById('previewPosition').textContent = this.value || 'Développeur Full-Stack';
            });

            document.getElementById('expStartDate').addEventListener('input', updateExperienceDates);
            document.getElementById('expEndDate').addEventListener('input', updateExperienceDates);

            function updateExperienceDates() {
                const startDate = document.getElementById('expStartDate').value;
                const endDate = document.getElementById('expEndDate').value;

                if (startDate || endDate) {
                    document.getElementById('previewExpDates').textContent = `${startDate || ''} - ${endDate || 'Présent'}`;
                } else {
                    document.getElementById('previewExpDates').textContent = '2020 - Présent';
                }
            }

            document.getElementById('expLocation').addEventListener('input', function() {
                document.getElementById('previewExpLocation').textContent = this.value || 'Lyon, France';
            });

            document.getElementById('expDescription').addEventListener('input', function() {
                document.getElementById('previewExpDescription').textContent = this.value || 'Développement et maintenance d\'applications web pour divers clients...';
            });
        });
    </script>
</body>
</html>
