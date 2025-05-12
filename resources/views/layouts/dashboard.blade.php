<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Designer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">

</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="/logo.png" alt="CV Designer.ai" class="img-fluid" width="60px" height="60px">
            <span class="logo-span">CAREERDOC</span>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark"></i> My Documents
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">
                    <i class="bi bi-file-earmark-text"></i> New Resume
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-search"></i>  New Cover Letter
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-list-check"></i> New Job Application
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-envelope"></i> Email Generator
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content-area">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="tab-header">
                </div>
                <div class="d-flex align-items-center">
                    <div class="notification-badge me-2 me-lg-3 mx-1" id="notificationBell" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                        <i class="bi bi-bell fs-4"></i>
                    </div>
                    <div class="dropdown">
                        <div class="profile-icon mx-2" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><p class="dropdown-item" href="#">Hello {{Auth::user()->name}}</i> </p></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout')}}"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row container">
                <div class="col-lg-6">
                    <div class="template-card text-center" data-bs-toggle="modal" data-bs-target="#newResumeModal">
                        <div class="template-preview d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            Create new resume
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="template-card text-center" data-bs-toggle="modal" data-bs-target="#newLetterModal">
                        <div class="template-preview d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            Create new letter
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Modal -->
    <div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationsModalLabel">Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="notification-list">
                        <div class="notification-item">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bell-fill text-primary me-2"></i>
                                <div>
                                    <p class="mb-0 fw-bold">Votre CV a été optimisé</p>
                                    <p class="mb-0 text-muted small">Il y a 2 heures</p>
                                </div>
                            </div>
                        </div>
                        <div class="notification-item">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bell-fill text-primary me-2"></i>
                                <div>
                                    <p class="mb-0 fw-bold">Nouvelle offre d'emploi correspondant à votre profil</p>
                                    <p class="mb-0 text-muted small">Il y a 3 heures</p>
                                </div>
                            </div>
                        </div>
                        <div class="notification-item">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bell-fill text-primary me-2"></i>
                                <div>
                                    <p class="mb-0 fw-bold">Rappel: Entretien prévu demain</p>
                                    <p class="mb-0 text-muted small">Il y a 1 jour</p>
                                </div>
                            </div>
                        </div>
                        <div class="notification-item">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bell-fill text-primary me-2"></i>
                                <div>
                                    <p class="mb-0 fw-bold">Votre lettre de motivation a été téléchargée</p>
                                    <p class="mb-0 text-muted small">Il y a 2 jours</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary">Marquer comme lu</button>
                </div>
            </div>
        </div>
    </div>

    <!-- New Resume Modal -->
    <div class="modal fade " id="newResumeModal" tabindex="-1" aria-labelledby="newResumeModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title text-center mb-5 " id="newResumeModalLabel">Comment souhaitez-vous créer votre CV ?</h5>

                    <div class="row container mb-5">
                        <div class="col-md-6">
                            <div class="card modal-card text-center p-3">
                                <a class="mb-3" href="{{ route('generateCV') }}">
                                    <i class="bi bi-file-earmark-plus fs-1  bleu"></i>
                                    <h5 class="text-dark">Commencer avec un modèle</h5>
                                </a>



                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card modal-card text-center p-3">
                                <a class="mb-3" type="button" class="btn btn-primary btn-open-modal" data-bs-toggle="modal" data-bs-target="#CVLetterModal">
                                    <i class="bi bi-robot fs-1  bleu"></i>
                                    <h5 class="text-dark">Générer avec l'IA</h5>
                                </a>



                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- New Letter Modal -->
    <div class="modal fade" id="newLetterModal" tabindex="-1" aria-labelledby="newLetterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title mb-5 text-center" id="newLetterModalLabel">Comment souhaitez-vous créer votre lettre de motivation ?</h5>


                    <div class="row conatiner mb-5">
                        <div class="col-md-6">
                            <div class="card modal-card text-center p-3">
                                <a class="mb-3" href="{{ route('coverWithModel') }}">
                                    <i class="bi bi-briefcase fs-1 bleu"></i>
                                    <h5 class="text-dark">Commencer avec un modèle</h5>
                                </a>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card modal-card text-center p-3">
                                <a class="mb-3" type="button" class="btn btn-primary btn-open-modal" data-bs-toggle="modal" data-bs-target="#coverLetterModal">
                                    <i class="bi bi-robot fs-1 bleu"></i>
                                    <h5 class="text-dark">Générer avec l'IA</h5>
                                </a>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


        <!-- Modal pour le générateur des lettres de motivations  -->
        <div class="modal fade " id="coverLetterModal" tabindex="-1" aria-labelledby="coverLetterModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-lg">
                <div class="modal-content">

                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>

                        <form id="coverLetterForm" action="{{ route('coverGenerate') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="description" class="form-label">Décrivez votre profil et le poste visé:</label>
                                <textarea class="form-control" id="description" name="description" rows="6" required>{{ $description ?? '' }}</textarea>
                                <div class="form-text">
                                    Incluez vos compétences, expériences, le poste et l'entreprise visés.
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-btn">Générer la lettre</button>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>




                <!-- Modal pour le générateur des cvs  -->
                <div class="modal fade " id="CVLetterModal" tabindex="-1" aria-labelledby="CVModalLabel" aria-hidden="true">
                    <div class="modal-dialog   modal-lg">
                        <div class="modal-content">

                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>

                                <form id="coverLetterForm" action="{{ route('autoCV') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Décrivez votre profil et le poste visé:</label>
                                        <textarea class="form-control" id="description" name="description" rows="6" required>{{ $description ?? '' }}</textarea>
                                        <div class="form-text">
                                            Incluez vos compétences, expériences, le poste et l'entreprise visés.
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-btn">Générer Votre CV</button>
                                    </div>
                                </form>


                            </div>

                        </div>
                    </div>
                </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialisation des tooltips et popovers Bootstrap si nécessaire
        document.addEventListener('DOMContentLoaded', function() {
            // Vous pouvez ajouter ici d'autres initialisations si besoin
        });
    </script>
</body>
</html>
