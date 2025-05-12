<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CVGenius - Créez un CV efficace</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/landignPage.css') }}">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
        <div class="sidebar-logo">
            <img src="/logo.png" alt="CV Designer.ai" class="img-fluid" width="60px" height="60px">
            <span class="logo-span">CAREERDOC</span>
        </div>
      <div class="d-flex">
        <a href="{{ route('login') }}" class="btn btn_btn btn-sm rounded-1 me-2">Créer mon CV</a>
        <a href="{{ route('login') }}" class="btn btn-btn btn-sm rounded-1">Connexion</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">

          <h1 class="display-5 fw-bold mb-4">Un CV efficace pour sortir du lot</h1>
          <p class="mb-4">Avec un CV professionnel, optimisez vos chances grâce à notre créateur de CV très facile à utiliser.</p>

          <div class="d-flex flex-wrap mb-4">
            <a href="{{ route('login') }}" class="btn btn-primary rounded-1 px-4 py-2 me-3 mb-2">Créer mon CV maintenant</a>
            <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-1 px-4 py-2 mb-2">Get Started</a>
          </div>

          <div class="features">
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-check-circle-fill feature-icon"></i>
              <span>Adaptez un CV de qualité grâce à votre créateur de CV</span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <i class="bi bi-check-circle-fill feature-icon"></i>
              <span>Utilisez l'assistant de rédaction grâce aux modèles de CV</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill feature-icon"></i>
              <span>Décrochez plus d'entretiens grâce à votre CV mis à jour</span>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="hero-image">
            <img src="/1.webp" alt="Exemple de CV" class="cv-image">
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="feature-section">
    <div class="container mb-5">
      <div class="text-center mb-5">
        <h6 class="text-muted">VOTRE CV PRÊT EN 3 MINUTES</h6>
        <h2 class="fw-bold">Create a Perfect Resume in 3 easy steps:</h2>
      </div>

      <div class="container steps-container">
        <div class="row text-center">
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card step-card">
              <img src="/111.png" alt="Choisissez votre CV" class="step-image">
              <div class="card-body">

                <h3 class="step-title">  Choisissez votre CV</h3>
                <p class="step-content">Sélectionnez votre modèle dans notre bibliothèque de CV à créer, puis personnalisez la mise en forme à votre guise !</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card step-card">
              <img src="/22.jpeg" alt="Personnalisez votre CV en ligne" class="step-image">
              <div class="card-body">

                <h3 class="step-title"> Personnalisez votre CV en ligne</h3>
                <p class="step-content">Remplissez chaque section de votre CV en vous appuyant sur notre contenu prérédigé, si vous le souhaitez. Utilisez ensuite notre correcteur orthographique pour faire un sans-faute !</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card step-card">
              <img src="/33.avif" alt="Téléchargez votre CV" class="step-image">
              <div class="card-body">

                <h3 class="step-title">Téléchargez votre CV</h3>
                <p class="step-content">Téléchargez votre curriculum vitae au format PDF, Word, PNG ou SVG. Il ne vous reste plus qu'à postuler !</p>
              </div>
            </div>
          </div>
        </div>
      </div>

          <!-- Carousel 3D corrigé -->

      </div>
    </div>
  </section>

  <section class="feature-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="resume-preview position-relative">
            <div class="blue-blob"></div>
            <img src="2.webp" alt="Exemple de CV" class="resume-image">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="section-text">

            <h2 class="section-heading">Oubliez l'angoisse de la page blanche</h2>
            <p class="feature-text">
              Rédigez votre CV en toute tranquillité grâce à notre intelligence artificielle, sélectionnez parmi nos suggestions basées sur votre secteur d'activité! Il contient tout ce dont vous avez besoin pour personnaliser et booster votre CV efficace en quelques minutes!
            </p>
            <a href="{{ route('login') }}" class="btn btn-btn action-btn">Créer un CV maintenant</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Feature Section 2: Professional Templates -->
  <section class="feature-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
          <div class="resume-preview position-relative">
            <div class="purple-blob"></div>
            <img src="/3.webp" alt="Modèle de CV professionnel" class="resume-image ms-auto"  >
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="section-text">

            <h2 class="section-heading">Des modèles conçus par des professionnels pour mettre en avant vos atouts</h2>
            <p class="feature-text">
              Les recruteurs ne passent que 7,4 secondes pour juger un CV. Nos modèles de qualité vous aideront à présenter vos compétences et à sortir du lot.
            </p>
            <a href="{{ route('login') }}" class="btn btn-btn action-btn">Choisir un modèle</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer mt-5">
    <div class="container">
      <div class="row">
        <!-- Colonne 1: CV -->
        <div class="col-md-3 col-sm-6 footer-col">
          <h3 class="footer-heading">CURRICULUM VITAE</h3>
          <a href="#" class="footer-link">Générateur de CV</a>
          <a href="#" class="footer-link">Modèles de CV</a>
          <a href="#" class="footer-link">Exemples de CV</a>
          <a href="#" class="footer-link">Comment faire un CV</a>
        </div>

        <!-- Colonne 2: Lettre de motivation -->
        <div class="col-md-3 col-sm-6 footer-col">
          <h3 class="footer-heading">LETTRE DE MOTIVATION</h3>
          <a href="#" class="footer-link">Générateur de lettre de motivation</a>
          <a href="#" class="footer-link">Exemples de lettre de motivation</a>
          <a href="#" class="footer-link">Comment faire une lettre motivation</a>
        </div>

        <!-- Colonne 3: Blog -->
        <div class="col-md-3 col-sm-6 footer-col">
          <h3 class="footer-heading">BLOG</h3>
          <a href="#" class="footer-link">Objectif professionnel</a>
          <a href="#" class="footer-link">Compétences dans un CV</a>
          <a href="#" class="footer-link">Expérience professionnelle</a>
          <a href="#" class="footer-link">Nos articles sur le CV</a>
          <a href="#" class="footer-link">Nos articles sur la lettre de motivation</a>
          <a href="#" class="footer-link">Nos articles sur la recherche d'emploi</a>
        </div>

        <!-- Colonne 4: À propos -->
        <div class="col-md-3 col-sm-6 footer-col">
          <h3 class="footer-heading">À PROPOS</h3>
          <a href="#" class="footer-link">Qui sommes nous</a>
          <a href="#" class="footer-link">Conditions générales</a>
          <a href="#" class="footer-link">Politique de confidentialité</a>
          <a href="#" class="footer-link">Questions fréquentes</a>
          <a href="#" class="footer-link">Affiliés</a>
          <a href="#" class="footer-link">Nous contacter</a>
          <a href="#" class="footer-link">Plan du site</a>
          <a href="#" class="footer-link">Avis des clients</a>
        </div>
      </div>

      <!-- Service Client -->

      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom text-center">
        <p>© 2025, Bold Limited. Tous droit réservé.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
