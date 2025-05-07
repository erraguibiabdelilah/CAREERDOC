@extends('layouts.dashboard')

@section('content')


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
                                <a class="mb-3">
                                    <i class="bi bi-file-earmark-plus fs-1  bleu"></i>
                                    <h5 class="text-dark">Commencer avec un modèle</h5>
                                </a>



                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card modal-card text-center p-3">
                                <a class="mb-3">
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
                                <a class="mb-3">
                                    <i class="bi bi-briefcase fs-1 bleu"></i>
                                    <h5 class="text-dark">Commencer avec un modèle</h5>
                                </a>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card modal-card text-center p-3">
                                <a class="mb-3">
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



@endsection
