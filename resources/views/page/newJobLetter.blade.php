@extends('layouts.app')

@section('content')
 <div class="row container">

                <div class="col-lg-6">
                    <div class="template-card text-center" data-bs-toggle="modal" data-bs-target="#newJobLetterModal">
                        <div class="template-preview d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            Create job letter
                        </div>
                    </div>
                </div>
            </div>

    <!-- Job Letter Modal -->
    <div class="modal fade" id="newJobLetterModal" tabindex="-1" aria-labelledby="newJobLetterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title mb-5 text-center" id="newJobLetterModalLabel">Comment souhaitez-vous créer votre lettre de demande d'emploi ?</h5>


                    <div class="row conatiner mb-5">
                        <div class="col-md-6">
                            <div class="card modal-card text-center p-3">
                                <a class="mb-3" href="{{ route('jobLetterWithModel') }}">
                                    <i class="bi bi-briefcase fs-1 bleu"></i>
                                    <h5 class="text-dark">Commencer avec un modèle</h5>
                                </a>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card modal-card text-center p-3">
                                <a class="mb-3" type="button" class="btn btn-primary btn-open-modal" data-bs-toggle="modal" data-bs-target="#jobLetterAIModal">
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

        <!-- Modal pour le générateur des lettres de demande d'emploi -->
        <div class="modal fade " id="jobLetterAIModal" tabindex="-1" aria-labelledby="jobLetterAIModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-lg">
                <div class="modal-content">

                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>

                        <form id="jobLetterForm" action="{{ route('jobLetterGenerate') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="description" class="form-label">Décrivez votre profil et l'entreprise visée:</label>
                                <textarea class="form-control" id="description" name="description" rows="6" required>{{ $description ?? '' }}</textarea>
                                <div class="form-text">
                                    Incluez vos compétences, expériences et informations sur l'entreprise que vous ciblez.
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-btn">Générer la demande d'emploi</button>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>


@endsection
