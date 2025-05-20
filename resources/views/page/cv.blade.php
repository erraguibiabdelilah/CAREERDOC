<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Professionnel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .cv-container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            margin: 0 auto 20px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
        }

        .name {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .contact-item {
            margin: 5px 15px;
            display: flex;
            align-items: center;
        }

        .contact-icon {
            margin-right: 8px;
            font-size: 18px;
        }

        .social-links {
            margin-top: 15px;
        }

        .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            display: inline-flex;
            align-items: center;
        }

        .social-links a:hover {
            text-decoration: underline;
        }

        .content {
            padding: 30px 40px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            position: relative;
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: #3498db;
        }

        .profile-text {
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 25px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #3498db;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .timeline-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2c3e50;
        }

        .timeline-date {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .timeline-subtitle {
            font-style: italic;
            margin-bottom: 8px;
            color: #34495e;
        }

        .timeline-description {
            color: #555;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .skills-category {
            flex: 1;
            min-width: 250px;
        }

        .skills-category h4 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .skills-list {
            list-style: none;
        }

        .skills-list li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 8px;
        }

        .skills-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #3498db;
            font-size: 1.2rem;
        }

        .languages-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .language-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px 20px;
            flex: 1;
            min-width: 150px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .language-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .language-level {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .header {
                padding: 30px 20px;
            }

            .content {
                padding: 20px;
            }

            .skills-container {
                flex-direction: column;
                gap: 20px;
            }

            .timeline-header {
                flex-direction: column;
            }

            .contact-info {
                flex-direction: column;
                align-items: center;
            }

            .contact-item {
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div class="cv-container">
        <div class="header">
            <div class="profile-img">
                <img src=" 'https://via.placeholder.com/120' }}" alt="Photo de profil" width="100" height="100" style="border-radius: 50%;">
            </div>
            <h1 class="name">abdelilah erraguibi</h1>
            <div class="contact-info">
                <div class="contact-item">
                    <span class="contact-icon">📧</span>
                    <span>email</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">📱</span>
                    <span>phone</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">📍</span>
                    <span>ADRESSE </span>
                </div>
            </div>
            <div class="social-links">

                    <a href="" target="_blank">
                        link 1
                    </a>

                    <a href="" target="_blank">
                        link 2
                    </a>

            </div>
        </div>

        <div class="content">
            <div class="section">
                <h3 class="section-title">Profil</h3>

            </div>

            <div class="section">
                <h3 class="section-title">Formation</h3>
                @foreach ($cvJsonText ['education'] as $edu)
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <h4 class="timeline-title">{{ $edu['degree'] }}</h4>
                            <span class="timeline-date">{{ $edu['date'] }}</span>
                        </div>
                        <p class="timeline-subtitle">{{ $edu['institution'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="section">
                <h3 class="section-title">Expériences Professionnelles</h3>
                @foreach ($cvJsonText ['experiences'] as $exp)
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <h4 class="timeline-title">{{ $exp['position'] }}</h4>
                            <span class="timeline-date">{{ $exp['period'] }}</span>
                        </div>
                        <p class="timeline-subtitle">{{ $exp['company'] }}</p>
                        <p class="timeline-description">{{ $exp['description'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="section">
                <h3 class="section-title">Compétences</h3>
                <div class="skills-container">
                    <div class="skills-category">
                        <h4>Techniques</h4>
                        <ul class="skills-list">
                            @foreach ($cvJsonText ['skills']['Techniques'] as $skill)
                                <li>{{ $skill }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="skills-category">
                        <h4>Personnelles</h4>
                        <ul class="skills-list">
                            @foreach ($cvJsonText ['skills']['Personnelles'] as $skill)
                                <li>{{ $skill }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3 class="section-title">Langues</h3>
                <div class="languages-list">
                    @foreach ($cvJsonText ['languages'] as $lang)
                        <div class="language-item">
                            <div class="language-name">{{ $lang['language'] }}</div>
                            <div class="language-level">{{ $lang['level'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
