@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header with back button and actions -->
    <div class="row bg-dark text-white py-3 mb-4">
        <div class="col-md-4">
            <a href="" class="btn btn-outline-light">
                <i class="bi bi-arrow-left"></i> Curriculum vitae
            </a>
        </div>
        <div class="col-md-4 text-center">
            <h5>CV de {{ $name ?? 'abdelilah erraguibi' }}</h5>
        </div>
        <div class="col-md-4 text-end">
            <div class="btn-group me-2">
                <button class="btn btn-outline-light">
                    <i class="bi bi-file-earmark-text"></i>
                </button>
                <button class="btn btn-outline-light">
                    <i class="bi bi-translate"></i> FR
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Option 1</a></li>
                    <li><a class="dropdown-item" href="#">Option 2</a></li>
                </ul>
            </div>
            <a href="#" id="downloadBtn" class="btn btn-primary ms-2">
                <i class="bi bi-download"></i> Télécharger
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main CV Editor -->
        <div class="col-md-8">
            <!-- Import options -->
            <div class="row mb-4">
                <div class="col-6">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-text display-4"></i>
                            <p class="mt-2">Télécharger un CV existant</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="bi bi-linkedin display-4"></i>
                            <p class="mt-2">Importer votre profil LinkedIn</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job search field -->
            <div class="mb-4">
                <label class="form-label">Emploi recherché</label>
                <input type="text" class="form-control" placeholder="Votre poste souhaité">
            </div>

            <!-- Personal Information Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informations personnelles</h5>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary toggle-section" data-target="personal-info">
                            <i class="bi bi-chevron-up"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" id="personal-info">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Photo</label>
                            <div class="border rounded p-3 text-center">
                                <i class="bi bi-camera display-4"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Prénom</label>
                            <input type="text" class="form-control" value="abdelilah">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nom de famille</label>
                            <input type="text" class="form-control" value="erraguibi">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Titre</label>
                            <input type="text" class="form-control" placeholder="Ex: Développeur Web">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Adresse e-mail</label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Numéro de téléphone</label>
                            <input type="tel" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Adresse</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Code postal</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ville</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> Date de naissance
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> Lieu de naissance
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> Permis de conduire
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> Sexe
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> Nationalité
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> État civil
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> Site internet
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> LinkedIn
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-plus"></i> Champ personnalisé
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Profil</h5>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Education Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Formation</h5>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Professional Experience -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Expérience professionnelle</h5>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Skills -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Compétences</h5>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Languages -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Langues</h5>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Interests -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Centres d'intérêt</h5>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>

            <!-- Additional sections -->
            <div class="d-flex flex-wrap gap-2 mb-4">
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Cours
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Stages
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Activités extra-scolaires
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Références
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Qualités
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Certificats
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Réalisations
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Signature
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus"></i> Bas de page
                </button>
                <div class="dropdown d-inline-block">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-plus"></i> Rubrique personnalisée
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </div>
            </div>

            <!-- Download button at bottom -->
            <div class="text-center mb-4">
                <a href="#" class="btn btn-primary">
                    <i class="bi bi-download"></i> Télécharger
                </a>
            </div>
        </div>

        <!-- CV Preview -->
        <div class="col-md-4">
            <div class="bg-light p-4 h-100 position-relative">
                <div class="bg-danger rounded-top text-white p-4 text-center">
                    <h3>abdelilah erraguibi</h3>
                </div>

                <div class="bg-light p-4">
                    <h5>Informations personnelles</h5>
                    <div class="d-flex align-items-center mt-3">
                        <i class="bi bi-person-circle me-2"></i>
                        <span>abdelilah erraguibi</span>
                    </div>
                </div>

                <!-- Preview toolbar at bottom -->
                <div class="position-absolute bottom-0 start-0 w-100 bg-white p-2 d-flex justify-content-between">
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-layout-split"></i>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle">
                            <i class="bi bi-fonts"></i>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-type"></i>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-list"></i>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-palette"></i>
                        </button>
                    </div>

                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrows-fullscreen"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sections
    const toggleButtons = document.querySelectorAll('.toggle-section');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);

            if (targetElement.style.display === 'none') {
                targetElement.style.display = 'block';
                this.querySelector('i').classList.remove('bi-chevron-down');
                this.querySelector('i').classList.add('bi-chevron-up');
            } else {
                targetElement.style.display = 'none';
                this.querySelector('i').classList.remove('bi-chevron-up');
                this.querySelector('i').classList.add('bi-chevron-down');
            }
        });
    });

    // Download CV functionality
    document.querySelectorAll('#downloadBtn, .btn-primary').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            alert('Téléchargement du CV en cours...');
            // Add actual download logic here
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.card {
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header {
    background-color: rgba(0, 0, 0, 0.03);
    padding: 0.75rem 1.25rem;
}

.bi {
    font-size: 1.1rem;
}

.bi.display-4 {
    font-size: 3.5rem;
}
</style>
@endpush
