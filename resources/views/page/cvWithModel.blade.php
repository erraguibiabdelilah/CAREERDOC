<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créateur de CV</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        body {
            font-family: 'Arial', sans-serif;
            background: white;
            min-height: 100vh;
            padding: 10px ;
            margin-top: 10px;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            height: calc(100vh - 40px);
        }

        .form-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(15, 4, 114, 0.555);
            overflow-y: auto;
        }

        .preview-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(15, 4, 114, 0.555);
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin: 25px 0 15px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .section-header h3 {
            color: #667eea;
            font-size: 18px;
        }

        .add-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            margin-left: auto;
        }

        .add-btn:hover {
            background: #5a6fd8;
        }

        .dynamic-item {
            background: #f8f9fa;
            border: 1px solid #e1e5e9;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
        }

        .remove-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #dc3545;
            color: white;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 12px;
        }

        .remove-btn:hover {
            background: #c82333;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* CV Preview Styles */
        .cv-preview {
            background: white;
            min-height: 800px;
            display: grid;
            grid-template-columns: 1fr 2fr;
            font-family: Arial, sans-serif;
        }

        .cv-sidebar {
            background: #4a90e2;
            color: white;
            padding: 30px 25px;
        }

        .cv-main {
            padding: 30px 25px;
            background: white;
        }

        .cv-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            margin: 0 auto 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: rgba(255,255,255,0.7);
        }

        .cv-name {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
        }

        .cv-title {
            text-align: center;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .cv-contact {
            margin-bottom: 30px;
        }

        .cv-contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .cv-contact-item i {
            width: 20px;
            margin-right: 10px;
        }

        .cv-section {
            margin-bottom: 25px;
        }

        .cv-section-title {
            font-size: 16px;
            font-weight: bold;
            color: #4a90e2;
            margin-bottom: 15px;
            text-transform: uppercase;
            border-bottom: 2px solid #4a90e2;
            padding-bottom: 5px;
        }

        .cv-item {
            margin-bottom: 15px;
        }

        .cv-item-title {
            font-weight: bold;
            color: #333;
        }

        .cv-item-subtitle {
            color: #666;
            font-size: 14px;
        }

        .cv-item-date {
            color: #4a90e2;
            font-size: 12px;
            float: right;
        }

        .skill-bar {
            background: rgba(255,255,255,0.2);
            height: 8px;
            border-radius: 4px;
            margin-top: 5px;
            overflow: hidden;
        }

        .skill-fill {
            background: white;
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .language-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .two-column {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Formulaire -->
        <div class="form-section">
            <h2 style="color: #667eea; margin-bottom: 25px; text-align: center;">
                <i class="fas fa-file-alt"></i> Créateur de CV
            </h2>

            <form id="cvForm">
                <!-- Informations personnelles -->
                <div class="section-header">
                    <h3><i class="fas fa-user"></i> Informations Personnelles</h3>
                </div>

                <div class="two-column">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                </div>

                <div class="two-column">
                    <div class="form-group">
                        <label for="age">Âge</label>
                        <input type="number" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="tel">Téléphone</label>
                        <input type="tel" id="tel" name="tel" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gmail">Email</label>
                    <input type="email" id="gmail" name="gmail" required>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" required>
                </div>

                <div class="form-group">
                    <label for="profile">Profil</label>
                    <textarea id="profile" name="profile" rows="3"></textarea>
                </div>

                <div class="two-column">
                    <div class="form-group">
                        <label for="lienGithub">GitHub</label>
                        <input type="url" id="lienGithub" name="lienGithub">
                    </div>
                    <div class="form-group">
                        <label for="lienLinkedin">LinkedIn</label>
                        <input type="url" id="lienLinkedin" name="lienLinkedin">
                    </div>
                </div>

                <!-- Expériences -->
                <div class="section-header">
                    <h3><i class="fas fa-briefcase"></i> Expériences</h3>
                    <button type="button" class="add-btn" onclick="addExperience()">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
                <div id="experiences-container"></div>

                <!-- Formations -->
                <div class="section-header">
                    <h3><i class="fas fa-graduation-cap"></i> Formations</h3>
                    <button type="button" class="add-btn" onclick="addFormation()">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
                <div id="formations-container"></div>

                <!-- Compétences -->
                <div class="section-header">
                    <h3><i class="fas fa-cogs"></i> Compétences</h3>
                    <button type="button" class="add-btn" onclick="addCompetence()">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
                <div id="competences-container"></div>

                <!-- Langues -->
                <div class="section-header">
                    <h3><i class="fas fa-language"></i> Langues</h3>
                    <button type="button" class="add-btn" onclick="addLangue()">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
                <div id="langues-container"></div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> Créer le CV
                </button>
            </form>
        </div>

        <!-- Prévisualisation -->
        <div class="preview-section">
            <h2 style="color: #667eea; margin-bottom: 25px; text-align: center;">
                <i class="fas fa-eye"></i> Prévisualisation
            </h2>

            <div class="cv-preview" id="cvPreview">
                <div class="cv-sidebar">
                    <div class="cv-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="cv-name" id="preview-name">VOTRE NOM</div>
                    <div class="cv-title" id="preview-title">Titre</div>
                    <div style="border-bottom: 1px solid rgba(255,255,255,0.3); margin-bottom: 20px;"></div>
                    <div id="preview-profile">Brief Summary of Yourself</div>

                    <div class="cv-contact" style="margin-top: 30px;">
                        <div class="cv-contact-item">
                            <i class="fas fa-envelope"></i>
                            <span id="preview-email">Email</span>
                        </div>
                        <div class="cv-contact-item">
                            <i class="fas fa-phone"></i>
                            <span id="preview-phone">Telephone</span>
                        </div>
                        <div class="cv-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span id="preview-address">Address</span>
                        </div>
                        <div class="cv-contact-item" id="preview-linkedin-item" style="display: none;">
                            <i class="fab fa-linkedin"></i>
                            <span id="preview-linkedin">LinkedIn</span>
                        </div>
                    </div>


                    <div class="cv-section">
                        <div class="cv-section-title" style="color: white;">LANGUES</div>
                        <div id="preview-langues"></div>
                    </div>
                </div>

                <div class="cv-main">
                    <div class="cv-section">
                        <div class="cv-section-title">EXPÉRIENCE PROFESSIONNELLE</div>
                        <div id="preview-experiences"></div>
                    </div>

                    <div class="cv-section">
                        <div class="cv-section-title">FORMATION</div>
                        <div id="preview-formations"></div>
                    </div>


                    <div class="cv-section">
                        <div class="cv-section-title" >COMPÉTENCES</div>
                        <div id="preview-competences"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script>
        let experienceCounter = 0;
        let formationCounter = 0;
        let competenceCounter = 0;
        let langueCounter = 0;

        // Ajouter une expérience
        function addExperience() {
            const container = document.getElementById('experiences-container');
            const item = document.createElement('div');
            item.className = 'dynamic-item';
            item.innerHTML = `
                <button type="button" class="remove-btn" onclick="removeItem(this)">×</button>
                <div class="form-group">
                    <label>Période</label>
                    <input type="text" name="experiences[${experienceCounter}][period]" placeholder="2020-2023" onchange="updatePreview()">
                </div>
                <div class="form-group">
                    <label>Entreprise</label>
                    <input type="text" name="experiences[${experienceCounter}][entreprise]" placeholder="Nom de l'entreprise" onchange="updatePreview()">
                </div>
                <div class="form-group">
                    <label>Poste</label>
                    <input type="text" name="experiences[${experienceCounter}][poste]" placeholder="Intitulé du poste" onchange="updatePreview()">
                </div>
            `;
            container.appendChild(item);
            experienceCounter++;
            updatePreview();
        }

        // Ajouter une formation
        function addFormation() {
            const container = document.getElementById('formations-container');
            const item = document.createElement('div');
            item.className = 'dynamic-item';
            item.innerHTML = `
                <button type="button" class="remove-btn" onclick="removeItem(this)">×</button>
                <div class="two-column">
                    <div class="form-group">
                        <label>Date début</label>
                        <input type="date" name="formations[${formationCounter}][dateDebut]" onchange="updatePreview()">
                    </div>
                    <div class="form-group">
                        <label>Date fin</label>
                        <input type="date" name="formations[${formationCounter}][dateFin]" onchange="updatePreview()">
                    </div>
                </div>
                <div class="form-group">
                    <label>Établissement</label>
                    <input type="text" name="formations[${formationCounter}][etablissement]" placeholder="Nom de l'établissement" onchange="updatePreview()">
                </div>
                <div class="form-group">
                    <label>Diplôme/Formation</label>
                    <input type="text" name="formations[${formationCounter}][libelle]" placeholder="Intitulé du diplôme" onchange="updatePreview()">
                </div>
            `;
            container.appendChild(item);
            formationCounter++;
            updatePreview();
        }

        // Ajouter une compétence
        function addCompetence() {
            const container = document.getElementById('competences-container');
            const item = document.createElement('div');
            item.className = 'dynamic-item';
            item.innerHTML = `
                <button type="button" class="remove-btn" onclick="removeItem(this)">×</button>
                <div class="form-group">
                    <label>Compétence</label>
                    <input type="text" name="competences[${competenceCounter}][libelle]" placeholder="Nom de la compétence" onchange="updatePreview()">
                </div>
                <div class="form-group">
                    <label>Niveau (%)</label>
                    <input type="range" min="0" max="100" name="competences[${competenceCounter}][level]" onchange="updatePreview()">
                </div>
            `;
            container.appendChild(item);
            competenceCounter++;
            updatePreview();
        }

        // Ajouter une langue
        function addLangue() {
            const container = document.getElementById('langues-container');
            const item = document.createElement('div');
            item.className = 'dynamic-item';
            item.innerHTML = `
                <button type="button" class="remove-btn" onclick="removeItem(this)">×</button>
                <div class="form-group">
                    <label>Langue</label>
                    <input type="text" name="langues[${langueCounter}][libelle]" placeholder="Français, Anglais..." onchange="updatePreview()">
                </div>
                <div class="form-group">
                    <label>Niveau</label>
                    <select name="langues[${langueCounter}][level]" onchange="updatePreview()">
                        <option value="">Sélectionner</option>
                        <option value="Débutant">Débutant</option>
                        <option value="Intermédiaire">Intermédiaire</option>
                        <option value="Avancé">Avancé</option>
                        <option value="Natif">Natif</option>
                    </select>
                </div>
            `;
            container.appendChild(item);
            langueCounter++;
            updatePreview();
        }

        // Supprimer un élément
        function removeItem(button) {
            button.parentElement.remove();
            updatePreview();
        }

        // Mettre à jour la prévisualisation
        function updatePreview() {
            // Informations personnelles
            const nom = document.getElementById('nom').value || 'VOTRE NOM';
            const prenom = document.getElementById('prenom').value || '';
            document.getElementById('preview-name').textContent = `${nom} ${prenom}`.trim();

            document.getElementById('preview-title').textContent = 'Titre';
            document.getElementById('preview-profile').textContent = document.getElementById('profile').value || 'Brief Summary of Yourself';
            document.getElementById('preview-email').textContent = document.getElementById('gmail').value || 'Email';
            document.getElementById('preview-phone').textContent = document.getElementById('tel').value || 'Telephone';
            document.getElementById('preview-address').textContent = document.getElementById('adresse').value || 'Address';

            // LinkedIn
            const linkedin = document.getElementById('lienLinkedin').value;
            if (linkedin) {
                document.getElementById('preview-linkedin-item').style.display = 'flex';
                document.getElementById('preview-linkedin').textContent = 'LinkedIn';
            } else {
                document.getElementById('preview-linkedin-item').style.display = 'none';
            }

            // Expériences
            const experiencesContainer = document.getElementById('preview-experiences');
            experiencesContainer.innerHTML = '';
            const experiences = document.querySelectorAll('#experiences-container .dynamic-item');
            experiences.forEach(exp => {
                const period = exp.querySelector('input[name*="[period]"]').value;
                const entreprise = exp.querySelector('input[name*="[entreprise]"]').value;
                const poste = exp.querySelector('input[name*="[poste]"]').value;

                if (period || entreprise || poste) {
                    const expDiv = document.createElement('div');
                    expDiv.className = 'cv-item';
                    expDiv.innerHTML = `
                        <div class="cv-item-date">${period}</div>
                        <div class="cv-item-title">${poste}</div>
                        <div class="cv-item-subtitle">${entreprise}</div>
                        <div style="clear: both;"></div>
                    `;
                    experiencesContainer.appendChild(expDiv);
                }
            });

            // Formations
            const formationsContainer = document.getElementById('preview-formations');
            formationsContainer.innerHTML = '';
            const formations = document.querySelectorAll('#formations-container .dynamic-item');
            formations.forEach(form => {
                const dateDebut = form.querySelector('input[name*="[dateDebut]"]').value;
                const dateFin = form.querySelector('input[name*="[dateFin]"]').value;
                const etablissement = form.querySelector('input[name*="[etablissement]"]').value;
                const libelle = form.querySelector('input[name*="[libelle]"]').value;

                if (dateDebut || dateFin || etablissement || libelle) {
                    const formDiv = document.createElement('div');
                    formDiv.className = 'cv-item';
                    const period = dateDebut && dateFin ? `${dateDebut} - ${dateFin}` : (dateDebut || dateFin);
                    formDiv.innerHTML = `
                        <div class="cv-item-date">${period}</div>
                        <div class="cv-item-title">${libelle}</div>
                        <div class="cv-item-subtitle">${etablissement}</div>
                        <div style="clear: both;"></div>
                    `;
                    formationsContainer.appendChild(formDiv);
                }
            });

            // Compétences
            const competencesContainer = document.getElementById('preview-competences');
            competencesContainer.innerHTML = '';
            const competences = document.querySelectorAll('#competences-container .dynamic-item');
            competences.forEach(comp => {
                const libelle = comp.querySelector('input[name*="[libelle]"]').value;
                const level = comp.querySelector('input[name*="[level]"]').value;

                if (libelle) {
                    const compDiv = document.createElement('div');
                    compDiv.style.marginBottom = '15px';
                    compDiv.innerHTML = `
                        <div>${libelle}</div>
                        <div class="skill-bar">
                            <div class="skill-fill" style="width: ${level || 0}%"></div>
                        </div>
                    `;
                    competencesContainer.appendChild(compDiv);
                }
            });

            // Langues
            const languesContainer = document.getElementById('preview-langues');
            languesContainer.innerHTML = '';
            const langues = document.querySelectorAll('#langues-container .dynamic-item');
            langues.forEach(lang => {
                const libelle = lang.querySelector('input[name*="[libelle]"]').value;
                const level = lang.querySelector('select[name*="[level]"]').value;

                if (libelle) {
                    const langDiv = document.createElement('div');
                    langDiv.className = 'language-item';
                    langDiv.innerHTML = `
                        <span>${libelle}</span>
                        <span style="font-size: 12px; opacity: 0.8;">${level}</span>
                    `;
                    languesContainer.appendChild(langDiv);
                }
            });
        }

        // Écouteurs d'événements pour la mise à jour en temps réel
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = ['nom', 'prenom', 'age', 'tel', 'gmail', 'adresse', 'profile', 'lienGithub', 'lienLinkedin'];
            inputs.forEach(id => {
                document.getElementById(id).addEventListener('input', updatePreview);
            });
        });

        // Gestion du formulaire
        document.getElementById('cvForm').addEventListener('submit', function(e) {
            e.preventDefault();

        });
    </script>
</body>
</html>
