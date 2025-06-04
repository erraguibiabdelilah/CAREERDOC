@extends('page.cv')
@section('content')
<style>
    /* Styles spécifiques au template moderne */
    .cv-container {
        display: flex;
        min-height: 100%;
        background: white;
        box-shadow: 0 5px 30px rgba(0,0,0,0.1);
    }

    .sidebar {
        width: 280px;
        background: #2c3e50;
        color: white;
        padding: 40px 30px;
    }

    .main-content {
        flex: 1;
        padding: 40px;
    }

    .name {
        font-size: 1.8rem;
        margin-bottom: 20px;
        font-weight: 700;
        color: white;
        border-bottom: 2px solid rgba(255,255,255,0.2);
        padding-bottom: 15px;
    }

    .contact-info {
        margin-bottom: 30px;
    }

    .contact-item {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .contact-icon {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .section-title {
        color: white;
        font-size: 1.2rem;
        margin: 25px 0 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .skills-list {
        list-style: none;
    }

    .skills-list li {
        margin-bottom: 8px;
        position: relative;
        padding-left: 20px;
    }

    .skills-list li::before {
        content: "•";
        color: #3498db;
        position: absolute;
        left: 0;
    }

    /* Main content styles */
    .content-section {
        margin-bottom: 35px;
    }

    .content-title {
        font-size: 1.5rem;
        color: #2c3e50;
        margin-bottom: 15px;
        padding-bottom: 5px;
        border-bottom: 2px solid #f0f0f0;
    }

    .timeline-item {
        margin-bottom: 25px;
    }

    .timeline-header {
        margin-bottom: 8px;
    }

    .timeline-date {
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .timeline-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .timeline-subtitle {
        font-weight: 500;
        color: #3498db;
        margin: 3px 0;
    }

    .profile-text {
        line-height: 1.7;
        color: #555;
    }

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
        <!-- Sidebar -->
        <div class="sidebar">
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

            <!-- Section Compétences -->
            <h3 class="section-title">Compétences</h3>
            @if(isset($cvData['skills']) && is_array($cvData['skills']) && count($cvData['skills']) > 0)
                <ul class="skills-list">
                    @foreach($cvData['skills'] as $skillCategory)
                        @if(isset($skillCategory['list']) && is_array($skillCategory['list']))
                            @foreach($skillCategory['list'] as $skill)
                                <li>{{ $skill }}</li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            @else
                <p>Aucune compétence renseignée</p>
            @endif

            <!-- Section Langues -->
            <h3 class="section-title">Langues</h3>
            @if(isset($cvData['languages']) && is_array($cvData['languages']) && count($cvData['languages']) > 0)
                <ul class="skills-list">
                    @foreach($cvData['languages'] as $lang)
                        <li>{{ $lang['language'] ?? '' }} ({{ $lang['level'] ?? '' }})</li>
                    @endforeach
                </ul>
            @else
                <p>Aucune langue renseignée</p>
            @endif
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Section Profil -->
            <div class="content-section">
                <h2 class="content-title">Profil Professionnel</h2>
                @if(isset($cvData['profile']) && !empty($cvData['profile']))
                    <div class="profile-text">{{ $cvData['profile'] }}</div>
                @else
                    <p>Aucune information de profil disponible</p>
                @endif
            </div>

            <!-- Section Expériences -->
            <div class="content-section">
                <h2 class="content-title">Expériences Professionnelles</h2>
                @if(isset($cvData['experiences']) && is_array($cvData['experiences']) && count($cvData['experiences']) > 0)
                    @foreach($cvData['experiences'] as $exp)
                        <div class="timeline-item">
                            <div class="timeline-header">
                                <div class="timeline-date">{{ $exp['period'] ?? '' }}</div>
                                <h3 class="timeline-title">{{ $exp['position'] ?? '' }}</h3>
                                <p class="timeline-subtitle">{{ $exp['company'] ?? '' }}</p>
                                <p class="timeline-description">{{ $exp['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Aucune expérience professionnelle renseignée</p>
                @endif
            </div>

            <!-- Section Formation -->
            <div class="content-section">
                <h2 class="content-title">Formation</h2>
                @if(isset($cvData['education']) && is_array($cvData['education']) && count($cvData['education']) > 0)
                    @foreach($cvData['education'] as $edu)
                        <div class="timeline-item">
                            <div class="timeline-header">
                                <div class="timeline-date">{{ $edu['date'] ?? '' }}</div>
                                <h3 class="timeline-title">{{ $edu['degree'] ?? '' }}</h3>
                                <p class="timeline-subtitle">{{ $edu['institution'] ?? '' }}</p>
                                <p class="timeline-field">Filière: {{ $edu['field'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Aucune formation renseignée</p>
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
