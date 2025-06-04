@extends('page.cv')
@section('content')
<style>
.btn-pdf{
    background-color: rgb(4, 4, 66);
    color:white;
    border: white;
    position: absolute;
    right: 20px;
    top:5rem;

}
.btn-pdf:hover{
background-color:white;
    color:rgb(4, 4, 66);
    border:rgb(4, 4, 66) 2px ;
}
</style>
<!-- Bouton d'export PDF -->
<div class="export-actions   " style="width: 14rem">
    <button id="exportPdfBtn" class="btn btn-pdf">
        <i class="fas fa-file-pdf"></i> Télécharger le CV (PDF)
    </button>
</div>
            <!-- Contenu CV avec scroll -->
            <div id="cv-content-to-export" class="cv-content-wrapper">
                <div class="cv-container">
                    <div class="header" id="cvHeader">
                        <h1 class="name" id="cvName">Nom Prénom</h1>
                        <div class="contact-info">
                            <div class="contact-item">
                                <span class="contact-icon">📧</span>
                                <span>email@exemple.com</span>
                            </div>
                            <div class="contact-item">
                                <span class="contact-icon">📱</span>
                                <span>+33 6 12 34 56 78</span>
                            </div>
                            <div class="contact-item">
                                <span class="contact-icon">📍</span>
                                <span>Ville, Pays</span>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <!-- Section Profil -->
                        <div class="section">
                            <h3 class="section-title">Profil Professionnel</h3>
                            @if(isset($cvData['profile']) && !empty($cvData['profile']))
                                <div class="profile-text">{{ $cvData['profile'] }}</div>
                            @else
                                <div class="empty-section">Aucune information de profil disponible</div>
                            @endif
                        </div>

                        <!-- Section Formation -->
                        <div class="section">
                            <h3 class="section-title">Formation</h3>
                            @if(isset($cvData['education']) && is_array($cvData['education']) && count($cvData['education']) > 0)
                                @foreach($cvData['education'] as $edu)
                                    <div class="timeline-item">
                                        <div class="timeline-header">
                                            <div class="timeline-date">{{ $edu['date'] ?? '' }}</div>
                                            <h4 class="timeline-title">{{ $edu['degree'] ?? '' }}</h4>
                                            <p class="timeline-subtitle">{{ $edu['institution'] ?? '' }}</p>
                                            <p class="timeline-field">Filière: {{ $edu['field'] ?? '' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-section">Aucune formation renseignée</div>
                            @endif
                        </div>

                        <!-- Section Expériences -->
                        <div class="section">
                            <h3 class="section-title">Expériences Professionnelles</h3>
                            @if(isset($cvData['experiences']) && is_array($cvData['experiences']) && count($cvData['experiences']) > 0)
                                @foreach($cvData['experiences'] as $exp)
                                    <div class="timeline-item">
                                        <div class="timeline-header">
                                            <div class="timeline-date">{{ $exp['period'] ?? '' }}</div>
                                            <h4 class="timeline-title">{{ $exp['position'] ?? '' }}</h4>
                                            <p class="timeline-subtitle">{{ $exp['company'] ?? '' }}</p>
                                            <p class="timeline-description">{{ $exp['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-section">Aucune expérience professionnelle renseignée</div>
                            @endif
                        </div>

                        <!-- Section Compétences -->
                        <div class="section">
                            <h3 class="section-title">Compétences</h3>
                            @if(isset($cvData['skills']) && is_array($cvData['skills']) && count($cvData['skills']) > 0)
                                <div class="skills-container">
                                    @foreach($cvData['skills'] as $skillCategory)
                                        <div class="skills-category">
                                            <h4>{{ $skillCategory['category'] ?? 'Compétences' }}</h4>
                                            @if(isset($skillCategory['list']) && is_array($skillCategory['list']) && count($skillCategory['list']) > 0)
                                                <ul class="skills-list">
                                                    @foreach($skillCategory['list'] as $skill)
                                                        <li>{{ $skill }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-section">Aucune compétence renseignée</div>
                            @endif
                        </div>

                        <!-- Section Langues -->
                        <div class="section">
                            <h3 class="section-title">Langues</h3>
                            @if(isset($cvData['languages']) && is_array($cvData['languages']) && count($cvData['languages']) > 0)
                                <div class="languages-list">
                                    @foreach($cvData['languages'] as $lang)
                                        <div class="language-item">
                                            <div class="language-name">{{ $lang['language'] ?? '' }}</div>
                                            <div class="language-level">{{ $lang['level'] ?? '' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-section">Aucune langue renseignée</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <script>
document.getElementById('exportPdfBtn').addEventListener('click', function() {
    // Configuration de html2pdf
    const element = document.getElementById('cv-content-to-export');
    const opt = {
        margin:       0,
        filename:     'mon_cv.pdf',
        image:        { type: 'jpeg', quality: 1 },
        html2canvas:  { scale: 2, logging: true },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    // Générer le PDF
    html2pdf().set(opt).from(element).save();
});
</script>
@endsection
