@extends('layouts.adminDashboard')

@section('content')
<div class="container-fluid">
    <!-- En-tête de la page -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Gestion des Administrateurs</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal" aria-label="Ajouter un nouvel administrateur">
                    <i class="bi bi-plus-circle"></i> Ajouter Admin
                </button>
            </div>
        </div>
    </div>

    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <!-- Tableau des administrateurs -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-people-fill me-2"></i>
                        Liste des Administrateurs ({{ $admins->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    @if($admins->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="adminsTable" aria-describedby="adminsCount">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" width="5%">ID</th>
                                        <th scope="col" width="25%">Nom</th>
                                        <th scope="col" width="30%">Email</th>
                                        <th scope="col" width="20%">Date de création</th>
                                        <th scope="col" width="20%" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{ $admin->name }}
                                                @if($admin->email === 'admin@admin.com')
                                                    <span class="badge bg-success ms-2" aria-label="Super administrateur">Super Admin</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <small class="text-muted" title="{{ $admin->created_at }}">
                                                {{ $admin->created_at->format('d/m/Y à H:i') }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            @if($admin->email !== 'admin@admin.com')
                                                <div class="btn-group" role="group" aria-label="Actions administrateur {{ $admin->name }}">
                                                    <!-- Bouton Modifier -->
                            <button type="button" 
    class="btn btn-sm btn-outline-warning me-1" 
    onclick="editAdmin({{ $admin->id }}, {!! json_encode($admin->name) !!}, {!! json_encode($admin->email) !!})"
    title="Modifier {{ $admin->name }}" 
    aria-label="Modifier administrateur {{ $admin->name }}">
    <i class="bi bi-pencil-square"></i>
</button>


                                                    <!-- Formulaire Suppression -->
                                                    <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer l\\'administrateur {{ addslashes($admin->name) }} ? Cette action est irréversible.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer {{ $admin->name }}" aria-label="Supprimer administrateur {{ $admin->name }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="badge bg-secondary" aria-label="Administrateur protégé">Protégé</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5" role="alert" aria-live="polite">
                            <i class="bi bi-people display-1 text-muted"></i>
                            <h5 class="mt-3">Aucun administrateur trouvé</h5>
                            <p class="text-muted">Commencez par ajouter votre premier administrateur.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajouter Admin -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addAdminModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    Ajouter un Administrateur
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <form action="{{ route('admin.admins.store') }}" method="POST" id="addAdminForm" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="bi bi-person me-1"></i>Nom complet
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required 
                               placeholder="Entrez le nom complet"
                               aria-describedby="nameHelp">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope me-1"></i>Adresse email
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               required 
                               placeholder="admin@exemple.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock me-1"></i>Mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="passwordAdd" 
                                   name="password" 
                                   required 
                                   minlength="6"
                                   placeholder="Minimum 6 caractères" 
                                   aria-describedby="passwordHelpAdd">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('passwordAdd', 'togglePasswordIconAdd')" aria-label="Afficher ou cacher le mot de passe">
                                <i class="bi bi-eye" id="togglePasswordIconAdd"></i>
                            </button>
                        </div>
                        <div id="passwordHelpAdd" class="form-text">Le mot de passe doit contenir au moins 6 caractères</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="bi bi-lock-fill me-1"></i>Confirmer le mot de passe
                        </label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               placeholder="Répétez le mot de passe">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Annuler">
                        <i class="bi bi-x-circle me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary" aria-label="Ajouter un administrateur">
                        <i class="bi bi-check-circle me-1"></i>Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Admin -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editAdminModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>
                    Modifier un Administrateur
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <form action="" method="POST" id="editAdminForm" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editAdminId" name="id">

                    <div class="mb-3">
                        <label for="editName" class="form-label">
                            <i class="bi bi-person me-1"></i>Nom complet
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="editName" 
                               name="name" 
                               required
                               placeholder="Entrez le nom complet">
                    </div>
                    
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">
                            <i class="bi bi-envelope me-1"></i>Adresse email
                        </label>
                        <input type="email" 
                               class="form-control" 
                               id="editEmail" 
                               name="email" 
                               required
                               placeholder="admin@exemple.com">
                    </div>

                    <div class="mb-3">
                        <label for="editPassword" class="form-label">
                            <i class="bi bi-lock me-1"></i>Mot de passe (laisser vide pour ne pas changer)
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control" 
                                   id="editPassword" 
                                   name="password" 
                                   minlength="6"
                                   placeholder="Minimum 6 caractères">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('editPassword', 'togglePasswordIconEdit')" aria-label="Afficher ou cacher le mot de passe">
                                <i class="bi bi-eye" id="togglePasswordIconEdit"></i>
                            </button>
                        </div>
                        <div class="form-text">Laissez vide pour conserver l'actuel mot de passe.</div>
                    </div>

                    <div class="mb-3">
                        <label for="editPasswordConfirmation" class="form-label">
                            <i class="bi bi-lock-fill me-1"></i>Confirmer le mot de passe
                        </label>
                        <input type="password" 
                               class="form-control" 
                               id="editPasswordConfirmation" 
                               name="password_confirmation" 
                               placeholder="Répétez le mot de passe">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Annuler">
                        <i class="bi bi-x-circle me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-warning" aria-label="Modifier l'administrateur">
                        <i class="bi bi-check-circle me-1"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts spécifiques -->
@push('scripts')
<script>
    // Fonction pour afficher/masquer le mot de passe
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if(input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    // Préparer la modale d'édition avec les données de l'admin sélectionné
    function editAdmin(id, name, email) {
    const form = document.getElementById('editAdminForm');
    form.action = `/admin/admins/${id}`;  // adapte selon ta route

    document.getElementById('editAdminId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;

    // Réinitialiser les champs mot de passe
    document.getElementById('editPassword').value = '';
    document.getElementById('editPasswordConfirmation').value = '';

    // Ouvre la modale via Bootstrap 5 JS
    const editModalElement = document.getElementById('editAdminModal');
    const editModal = new bootstrap.Modal(editModalElement);
    editModal.show();
}


    // Validation simple des formulaires (exemple, tu peux améliorer)
    (() => {
        'use strict'
        // Fetch all the forms we want to apply custom validation styles to
        const forms = document.querySelectorAll('form[novalidate]')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })();
</script>
@endpush

@endsection
