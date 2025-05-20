<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créateur de CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #1a56db;
            --secondary-color: #f8b84e;
            --dark-blue: #1e3a8a;
            --light-gray: #f9fafb;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 70px;
            background-color: var(--dark-blue);
            color: white;
            padding: 20px 0;
        }

        .content-area {
            flex: 1;
            background-color: white;
        }

        .step-indicator {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px auto;
            color: #333;
            position: relative;
        }

        .step-indicator.active {
            background-color: var(--primary-color);
            color: white;
        }

        .step-indicator.complete {
            background-color: #28a745;
            color: white;
        }

        .step-line {
            width: 2px;
            height: 40px;
            background-color: #e0e0e0;
            margin: 0 auto;
        }

        .form-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            display: none;
        }

        .form-page.active {
            display: block;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(26, 86, 219, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #0f46b5;
            border-color: #0f46b5;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #e0a33a;
            border-color: #e0a33a;
            color: #333;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .valid-feedback {
            display: none;
        }

        .valid-icon {
            color: #28a745;
            display: none;
        }

        .input-validated .valid-icon {
            display: inline;
        }

        .cv-preview {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: white;
            height: 500px;
        }

        .cv-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
        }

        .cv-content {
            padding: 20px;
        }

        .cv-section {
            margin-bottom: 20px;
        }

        .cv-section-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .cv-preview {
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Sidebar avec timeline -->
        <div class="sidebar">
            <div class="d-flex flex-column align-items-center mt-4">
                <div class="mb-4">
                    <i class="bi bi-file-earmark-text fs-4"></i>
                </div>
                <div class="step-indicator active" id="step1">
                    <span>1</span>
                </div>
                <div class="step-line"></div>
                <div class="step-indicator" id="step2">
                    <span>2</span>
                </div>
                <div class="step-line"></div>
                <div class="step-indicator" id="step3">
                    <span>3</span>
                </div>
                <div class="step-line"></div>
                <div class="step-indicator" id="step4">
                    <span>4</span>
                </div>
                <div class="step-line"></div>
                <div class="step-indicator" id="step5">
                    <span>5</span>
                </div>
                <div class="step-line"></div>
                <div class="step-indicator" id="step6">
                    <span>6</span>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="content-area">
            <!-- Page 1: Informations personnelles -->
            <div class="form-page active" id="page1">
                <h2 class="mb-4">Let's start with your header</h2>
                <p class="text-muted">Include your full name and multiple ways for employers to reach you.</p>

                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">FIRST NAME</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="firstName" value="Abdelilah">
                                    <span class="input-group-text valid-icon"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">LAST NAME</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="lastName" value="Erraguibi">
                                    <span class="input-group-text valid-icon"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="city" class="form-label">CITY</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="city" value="Salé">
                                    <span class="input-group-text valid-icon"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="state" class="form-label">STATE</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="state" value="SAL">
                                    <span class="input-group-text valid-icon"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="zipCode" class="form-label">ZIP CODE</label>
                                <input type="text" class="form-control" id="zipCode" value="94102">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">PHONE</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="phone" value="0779239780">
                                    <span class="input-group-text valid-icon"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">EMAIL ADDRESS*</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" value="abdelilaherraguibi8@gmail.com">
                                    <span class="input-group-text valid-icon"><i class="bi bi-check-circle-fill"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="cv-preview">
                            <div class="cv-header py-4 px-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h4 id="previewName">Abdelilah Erraguibi</h4>
                                        <div class="small" id="previewContact">
                                            abdelilaherraguibi8@gmail.com<br>
                                            0779239780<br>
                                            Salé, SAL
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cv-content">
                                <div class="cv-section">
                                    <h6 class="cv-section-title">Skills</h6>
                                    <ul class="small">
                                        <li>Communication and leadership</li>
                                        <li>Problem solving</li>
                                        <li>Team collaboration</li>
                                        <li>Project management</li>
                                        <li>Detail oriented</li>
                                    </ul>
                                </div>

                                <div class="cv-section">
                                    <h6 class="cv-section-title">Experience</h6>
                                    <p class="small">No experience added yet</p>
                                </div>

                                <div class="cv-section">
                                    <h6 class="cv-section-title">Education And Training</h6>
                                    <p class="small text-muted">Expected Graduate</p>
                                    <p class="small">High School Diploma</p>
                                    <p class="small text-muted">Zzzzzzzzzzzzzzz</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 d-flex justify-content-between">
                    <button class="btn btn-outline-secondary px-4" disabled>Back</button>
                    <button class="btn btn-primary px-4" id="nextBtn1">Continue</button>
                </div>
            </div>

            <!-- Page 2: Éducation -->
            <div class="form-page" id="page2">
                <h2 class="mb-4">Education summary</h2>

                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5>High School Diploma</h5>
                                        <p class="text-muted mb-0">Dddddddd</p>
                                        <p class="text-muted mb-0">Zzzzzzzzzzzzzzz</p>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-link text-primary"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-link text-danger"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                <div class="border-top mt-3 pt-2">
                                    <p class="small text-muted mb-0">Expected in Jan 2033</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="cv-preview">
                            <div class="cv-header py-4 px-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h4>Abdelilah Erraguibi</h4>
                                        <div class="small">
                                            abdelilaherraguibi8@gmail.com<br>
                                            0779239780<br>
                                            Salé, SAL
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cv-content">
                                <div class="cv-section">
                                    <h6 class="cv-section-title">Summary</h6>
                                    <p class="small">Recent high school graduate with 10+ years experience in high-level food service and manual labor positions. Dedicated and conscientious team member with excellent communication skills. Remarkable capability to make customers feel comfortable and welcome. Dependable and trustworthy.</p>
                                </div>

                                <div class="cv-section">
                                    <h6 class="cv-section-title">Experience</h6>
                                    <p class="small">No experience added yet</p>
                                </div>

                                <div class="cv-section">
                                    <h6 class="cv-section-title">Education And Training</h6>
                                    <p class="small text-muted">Expected Graduate</p>
                                    <p class="small">High School Diploma</p>
                                    <p class="small text-muted">Zzzzzzzzzzzzzzz</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 d-flex justify-content-between">
                    <button class="btn btn-outline-secondary px-4" id="backBtn2">Back</button>
                    <div>
                        <button class="btn btn-secondary me-2" id="addEducationBtn">+ Add education</button>
                        <button class="btn btn-primary px-4" id="nextBtn2">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validation des champs de formulaire
        const inputFields = document.querySelectorAll('.form-control');
        inputFields.forEach(field => {
            field.addEventListener('input', function() {
                // Simulation de la validation - dans un cas réel, vous auriez besoin d'une logique de validation plus robuste
                if (this.value.trim() !== '') {
                    this.parentElement.classList.add('input-validated');
                } else {
                    this.parentElement.classList.remove('input-validated');
                }

                // Mettre à jour la prévisualisation du CV
                updateCVPreview();
            });

            // Déclencher l'événement input pour initialiser l'état de validation
            const event = new Event('input');
            field.dispatchEvent(event);
        });

        // Fonction pour mettre à jour la prévisualisation du CV
        function updateCVPreview() {
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const city = document.getElementById('city').value;
            const state = document.getElementById('state').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;

            // Mettre à jour le nom
            const previewName = document.getElementById('previewName');
            if (previewName) {
                previewName.textContent = `${firstName} ${lastName}`;
            }

            // Mettre à jour les coordonnées
            const previewContact = document.getElementById('previewContact');
            if (previewContact) {
                previewContact.innerHTML = `${email}<br>${phone}<br>${city}, ${state}`;
            }
        }

        // Navigation entre les pages
        const pages = document.querySelectorAll('.form-page');
        const steps = document.querySelectorAll('.step-indicator');
        let currentPage = 0;

        function showPage(pageIndex) {
            pages.forEach((page, index) => {
                if (index === pageIndex) {
                    page.classList.add('active');
                } else {
                    page.classList.remove('active');
                }
            });

            steps.forEach((step, index) => {
                if (index === pageIndex) {
                    step.classList.add('active');
                } else if (index < pageIndex) {
                    step.classList.add('complete');
                    step.classList.remove('active');
                } else {
                    step.classList.remove('active', 'complete');
                }
            });

            currentPage = pageIndex;
        }

        // Boutons de navigation
        document.getElementById('nextBtn1').addEventListener('click', function() {
            showPage(1);
        });

        document.getElementById('backBtn2').addEventListener('click', function() {
            showPage(0);
        });

        document.getElementById('nextBtn2').addEventListener('click', function() {
            // Ici, vous passeriez à la page 3 - pour cet exemple, nous revenons à la page 1
            showPage(0);
        });

        document.getElementById('addEducationBtn').addEventListener('click', function() {
            // Ici, vous pourriez ouvrir un modal ou ajouter dynamiquement un formulaire pour ajouter une éducation
            alert('Cette fonctionnalité serait implémentée pour ajouter une nouvelle entrée d\'éducation');
        });

        // Initialiser la prévisualisation du CV
        updateCVPreview();
    </script>
</body>
</html>
