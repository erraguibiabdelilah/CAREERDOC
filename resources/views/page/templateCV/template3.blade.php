@extends('page.cv')
@section('content')
<style>
    /* Styles spécifiques au template minimaliste */
    .cv-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 50px;
        box-shadow: none;
        border: 1px solid #e0e0e0;
    }

    .header {
        text-align: center;
        margin-bottom: 40px;
    }

    .name {
        font-size: 2rem;
        font-weight: 400;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .title {
        font-size: 1rem;
        color: #7f8c8d;
        margin-bottom: 20px;
        font-weight: 300;
    }

    .contact-info {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
    }

    .contact-icon {
        margin-right: 5px;
    }

    .section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 400;
        margin-bottom: 15px;
        padding-bottom: 5px;
        border-bottom: 1px solid #e0e0e0;
    }

    .profile-text {
        line-height: 1.7;
        color: #555;
        font-size: 0.95rem;
    }

    .timeline-item {
        margin-bottom: 20px;
    }

    .timeline-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .timeline-date {
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .timeline-title {
        font-weight: 500;
    }

    .timeline-subtitle {
        color: #7f8c8d;
        font-style: italic;
        margin-bottom: 5px;
    }

    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .skill-tag {
        background: #f5f5f5;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 0.9rem;
    }

    .languages-list {
        display: flex;
        gap: 15px;
    }

    .language-item {
        display: flex;
        flex-direction: column;
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
        <div class="header">
            <h1 class="name" id="cvName">Nom Prénom</h1>
            <div class="title">Poste recherché</div>
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

        <!-- Section Profil -->
        <div class="section">
            <h3 class="section-title">Profil</h3>
            @if(isset($cvData['profile']) && !empty($cvData['profile']))
                <div class="profile-text">{{ $cvData['profile'] }}</div>
            @else
                <p>Aucune information de profil disponible</p>
            @endif
        </div>

        <!-- Section Expériences -->
        <div class="section">
            <h3 class="section-title">Expérience Professionnelle</h3>
            @if(isset($cvData['experiences']) && is_array($cvData['experiences']) && count($cvData['experiences']) > 0)
                @foreach($cvData['experiences'] as $exp)
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <h4 class="timeline-title">{{ $exp['position'] ?? '' }}</h4>
                            <div class="timeline-date">{{ $exp['period'] ?? '' }}</div>
                        </div>
                        <p class="timeline-subtitle">{{ $exp['company'] ?? '' }}</p>
                        <p class="timeline-description">{{ $exp['description'] ?? '' }}</p>
                    </div>
                @endforeach
            @else
                <p>Aucune expérience professionnelle renseignée</p>
            @endif
        </div>

        <!-- Section Formation -->
        <div class="section">
            <h3 class="section-title">Formation</h3>
            @if(isset($cvData['education']) && is_array($cvData['education']) && count($cvData['education']) > 0)
                @foreach($cvData['education'] as $edu)
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <h4 class="timeline-title">{{ $edu['degree'] ?? '' }}</h4>
                            <div class="timeline-date">{{ $edu['date'] ?? '' }}</div>
                        </div>
                        <p class="timeline-subtitle">{{ $edu['institution'] ?? '' }}</p>
                        <p class="timeline-field">{{ $edu['field'] ?? '' }}</p>
                    </div>
                @endforeach
            @else
                <p>Aucune formation renseignée</p>
            @endif
        </div>

        <!-- Section Compétences -->
        <div class="section">
            <h3 class="section-title">Compétences</h3>
            @if(isset($cvData['skills']) && is_array($cvData['skills']) && count($cvData['skills']) > 0)
                <div class="skills-list">
                    @foreach($cvData['skills'] as $skillCategory)
                        @if(isset($skillCategory['list']) && is_array($skillCategory['list']))
                            @foreach($skillCategory['list'] as $skill)
                                <div class="skill-tag">{{ $skill }}</div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            @else
                <p>Aucune compétence renseignée</p>
            @endif
        </div>

        <!-- Section Langues -->
        <div class="section">
            <h3 class="section-title">Langues</h3>
            @if(isset($cvData['languages']) && is_array($cvData['languages']) && count($cvData['languages']) > 0)
                <div class="languages-list">
                    @foreach($cvData['languages'] as $lang)
                        <div class="language-item">
                            <span>{{ $lang['language'] ?? '' }}</span>
                            <small>{{ $lang['level'] ?? '' }}</small>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Aucune langue renseignée</p>
            @endif
        </div>
    </div>
</div>
@endsection



@extends('page.cv')
@section('content')
<style>
    /* Styles spécifiques au template créatif */
    .cv-container {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: grid;
        grid-template-columns: 1fr 2fr;
        grid-gap: 0;
        min-height: 100%;
    }

    .left-panel {
        background: #3498db;
        color: white;
        padding: 40px 30px;
        position: relative;
        overflow: hidden;
    }

    .left-panel::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .right-panel {
        padding: 40px;
    }

    .name {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
        position: relative;
        z-index: 1;
    }

    .title {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 30px;
        position: relative;
        z-index: 1;
    }

    .contact-info {
        margin-bottom: 40px;
        position: relative;
        z-index: 1;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .contact-icon {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin: 30px 0 20px;
        position: relative;
        padding-bottom: 8px;
    }

    .section-title::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: white;
    }

    .right-panel .section-title::after {
        background: #3498db;
    }

    .skills-list {
        list-style: none;
    }

    .skills-list li {
        margin-bottom: 10px;
        position: relative;
        padding-left: 20px;
    }

    .skills-list li::before {
        content: "▹";
        position: absolute;
        left: 0;
        color: white;
    }

    .profile-text {
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .timeline-item {
        margin-bottom: 25px;
        position: relative;
        padding-left: 30px;
    }

    .timeline-item::before {
        content: "";
        position: absolute;
        left: 0;
        top: 5px;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #3498db;
    }

    .timeline-header {
        margin-bottom: 5px;
    }

    .timeline-date {
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .timeline-title {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1.1rem;
    }

    .timeline-subtitle {
        color: #3498db;
        font-weight: 500;
        margin: 3px 0;
    }

    .languages-list {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .language-item {
        background: rgba(255,255,255,0.1);
        padding: 8px 15px;
        border-radius: 20px;
    }
</style>

<div class="cv-content-wrapper">
    <div class="cv-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <h1 class="name" id="cvName">Nom Prénom</h1>
            <div class="title">Poste recherché</div>

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
                <div class="languages-list">
                    @foreach($cvData['languages'] as $lang)
                        <div class="language-item">
                            {{ $lang['language'] ?? '' }} ({{ $lang['level'] ?? '' }})
                        </div>
                    @endforeach
                </div>
            @else
                <p>Aucune langue renseignée</p>
            @endif
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <!-- Section Profil -->
            <h3 class="section-title">Profil Professionnel</h3>
            @if(isset($cvData['profile']) && !empty($cvData['profile']))
                <div class="profile-text">{{ $cvData['profile'] }}</div>
            @else
                <p>Aucune information de profil disponible</p>
            @endif

            <!-- Section Expériences -->
            <h3 class="section-title">Expériences</h3>
            @if(isset($cvData['experiences']) && is_array($cvData['experiences']) && count($cvData['experiences']) > 0)
                @foreach($cvData['experiences'] as $exp)
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <div class="timeline-date">{{ $exp['period'] ?? '' }}</div>
                            <h4 class="timeline-title">{{ $exp['position'] ?? '' }}</h4>
                            <p class="timeline-subtitle">{{ $exp['company'] ?? '' }}</p>
                        </div>
                        <p class="timeline-description">{{ $exp['description'] ?? '' }}</p>
                    </div>
                @endforeach
            @else
                <p>Aucune expérience professionnelle renseignée</p>
            @endif

            <!-- Section Formation -->
            <h3 class="section-title">Formation</h3>
            @if(isset($cvData['education']) && is_array($cvData['education']) && count($cvData['education']) > 0)
                @foreach($cvData['education'] as $edu)
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <div class="timeline-date">{{ $edu['date'] ?? '' }}</div>
                            <h4 class="timeline-title">{{ $edu['degree'] ?? '' }}</h4>
                            <p class="timeline-subtitle">{{ $edu['institution'] ?? '' }}</p>
                        </div>
                        <p class="timeline-field">{{ $edu['field'] ?? '' }}</p>
                    </div>
                @endforeach
            @else
                <p>Aucune formation renseignée</p>
            @endif
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
