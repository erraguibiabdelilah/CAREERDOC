<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CV Designer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}" />
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="/logo.png" alt="CV Designer.ai" class="img-fluid" width="60px" height="60px" />
            <span class="logo-span">CAREERDOC</span>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard')}}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminManagement') }}">
                    <i class="bi bi-people"></i> Gestion Admins
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.gestiontemplates') }}">
                    <i class="bi bi-layout-text-sidebar-reverse"></i> Gestion Templates
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content-area">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="tab-header"></div>
                <div class="d-flex align-items-center">
                    <div class="notification-badge me-2 me-lg-3 mx-1" id="notificationBell" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                        <i class="bi bi-bell fs-4"></i>
                    </div>
                    <div class="dropdown">
                        <div class="profile-icon mx-2" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                           A
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><p class="dropdown-item">Hello</p></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </ul>
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

            <section class="main 1">
                @yield('content')
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialisation des tooltips et popovers Bootstrap si nécessaire
        document.addEventListener('DOMContentLoaded', function () {
            // Ajoutez ici d'autres initialisations si besoin
        });
    </script>
</body>
</html>
