@extends('layouts.adminDashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Gestion des Templates de CV</h1>

    <div class="mb-4">
        <a href="" class="btn btn-primary">Ajouter un nouveau template</a>
    </div>

    <h2>Templates Gratuits</h2>
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="card">
                <img src="https://designshack.net/wp-content/uploads/Free-Business-Resume-Template.jpg" alt="Template Classique" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Template Classique</h5>
                    <span class="badge bg-success mb-2">Gratuit</span>
                    <p class="card-text">Design simple et épuré.</p>
                    <form action="" method="POST" onsubmit="return confirm('Supprimer ce template ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img src="https://techguruplus.com/wp-content/uploads/2022/01/Resume_CV_Format_Download-21-1-min.jpg" alt="Template Moderne" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Template Moderne</h5>
                    <span class="badge bg-success mb-2">Gratuit</span>
                    <p class="card-text">Design professionnel et épuré.</p>
                    <form action="" method="POST" onsubmit="return confirm('Supprimer ce template ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img src="https://cdn4.geckoandfly.com/wp-content/uploads/2019/05/microsoft-cv-resume-template-24.jpg" alt="Template Microsoft" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Template Microsoft</h5>
                    <span class="badge bg-success mb-2">Gratuit</span>
                    <p class="card-text">Design classique Microsoft Word.</p>
                    <form action="" method="POST" onsubmit="return confirm('Supprimer ce template ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Remplacement image problématique par la nouvelle gratuite -->
        <div class="col-md-3">
            <div class="card">
                <img src="https://d25zcttzf44i59.cloudfront.net/academic-word-resume-template.png" alt="Template Gratuit Remplacement" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Template Académique</h5>
                    <span class="badge bg-success mb-2">Gratuit</span>
                    <p class="card-text">Design académique propre et moderne.</p>
                    <form action="" method="POST" onsubmit="return confirm('Supprimer ce template ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h2>Templates Premium</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <img src="https://i.pinimg.com/originals/c8/3e/c6/c83ec6bec44a7367188d42a1fa67b2b1.jpg" alt="Template Élégant" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Template Élégant</h5>
                    <span class="badge bg-warning text-dark mb-2">Premium</span>
                    <p class="card-text">Design premium avancé.</p>
                    <form action="" method="POST" onsubmit="return confirm('Supprimer ce template ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img src="https://cms-assets.tutsplus.com/uploads/users/988/posts/93140/image-upload/canva_modern_grey_resume.jpg" alt="Template Moderne Gris" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Template Moderne Gris</h5>
                    <span class="badge bg-warning text-dark mb-2">Premium</span>
                    <p class="card-text">Design moderne gris élégant.</p>
                    <form action="" method="POST" onsubmit="return confirm('Supprimer ce template ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img src="https://cms-assets.tutsplus.com/uploads/users/988/posts/93140/image-upload/canva_black_white_minimalist_cv_resume.jpg" alt="Template Minimaliste" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Template Minimaliste</h5>
                    <span class="badge bg-warning text-dark mb-2">Premium</span>
                    <p class="card-text">Design noir et blanc minimaliste.</p>
                    <form action="" method="POST" onsubmit="return confirm('Supprimer ce template ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img src="https://cv-creator.co.uk/wp-content/uploads/doc-builder/cv/miniatures/cvuk-22-blue.png" alt="Template Bleu" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Template Bleu</h5>
                    <span class="badge bg-warning text-dark mb-2">Premium</span>
                    <p class="card-text">Design bleu professionnel.</p>
                    <form action="" method="POST" onsubmit="return confirm('Supprimer ce template ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
