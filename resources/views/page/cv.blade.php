<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Professionnel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/cv.css') }}">
</head>
<body>
    <div class="main-container">
        <!-- Section Templates (1/3 - à gauche) -->
        <div class="templates-section">
            <div class="templates-header">
                <a href="{{ route('dashboard') }}" style=" font-weight: 800 btn btn-outlin-primary"><i class="bi bi-arrow-left-square-fill"></i> GO BACK</a>
                <h2 class="templates-title">Templates CV</h2>
                <p class="templates-subtitle">Choisissez votre design</p>
            </div>

            <div class="templates-list">

                    <a href="{{ route('template1') }}">

                    <div class="template-card active" style="cursor: pointer;" data-route="template1">
                    <div class="template-image">
                        <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=300&h=400&fit=crop&q=80" alt="Template Classique">
                        <div class="template-overlay"></div>


                    </div>
                    <div class="template-info">
                        <a class="template-name">Template Classique </a>
                        <div class="template-description">Design professionnel et élégant pour tous secteurs</div>
                    </div>
                </div>
                </a>

        <a type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">


                    <div class="template-card active" style="cursor: pointer;" data-route="template1">
                    <div class="template-image">
                        <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=300&h=400&fit=crop&q=80" alt="Template Classique">
                        <div class="template-overlay"></div>
                        <div class="crown-icon">PRO</div>
                    </div>
                    <div class="template-info">
                        <a class="template-name">Template premium</a>
                        <div class="template-description">Design professionnel et élégant pour tous secteurs</div>

                    </div>
                </div>

        </a>


                <a href="{{ route('template3') }}" >
                    <div class="template-card active" style="cursor: pointer;" data-route="template1">
                    <div class="template-image">
                        <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=300&h=400&fit=crop&q=80" alt="Template Classique">
                        <div class="template-overlay"></div>
                        <div class="crown-icon"></div>
                    </div>
                    <div class="template-info">
                        <a class="template-name">Template professionnel</a>
                        <div class="template-description">Design professionnel et élégant pour tous secteurs</div>
                    </div>
                </div>
                </a>


                <a href="{{ route('template4') }}">
                    <div class="template-card active" style="cursor: pointer;" data-route="template1">
                    <div class="template-image">
                        <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=300&h=400&fit=crop&q=80" alt="Template Classique">
                        <div class="template-overlay"></div>
                        <div class="crown-icon"></div>
                    </div>
                    <div class="template-info">
                        <a class="template-name">Template Classique</a>
                        <div class="template-description">Design professionnel et élégant pour tous secteurs</div>
                    </div>
                </div>
                </a>







            </div>
        </div>

        <!-- Section CV (2/3 - à droite) -->
        <div class="cv-section">
                <!-- Barre de personnalisation -->
            <div class="customization-bar">
                <div class="customization-group">
                    <span class="customization-label">Couleurs:</span>
                    <div class="color-option color-blue active" onclick="changeColor('blue')" title="Bleu"></div>
                    <div class="color-option color-purple" onclick="changeColor('purple')" title="Violet"></div>
                    <div class="color-option color-green" onclick="changeColor('green')" title="Vert"></div>
                    <div class="color-option color-red" onclick="changeColor('red')" title="Rouge"></div>
                    <div class="color-option color-orange" onclick="changeColor('orange')" title="Orange"></div>
                    <div class="color-option color-dark" onclick="changeColor('dark')" title="Sombre"></div>
                </div>

                <div class="customization-group">
                    <span class="customization-label">Police:</span>
                    <div class="font-option active" onclick="changeFont('segoe')">Segoe UI</div>
                    <div class="font-option" onclick="changeFont('arial')">Arial</div>
                    <div class="font-option" onclick="changeFont('georgia')">Georgia</div>
                    <div class="font-option" onclick="changeFont('times')">Times</div>




                <div class="nav-item d-flex align-items-center" style="position: absolute; right:3rem;">
    <div class="notification-badge me-3 me-lg-3 mx-2" id="notificationBell" data-bs-toggle="modal" data-bs-target="#notificationModal">
        <i class="bi bi-bell fs-5 text-black"></i>
        <span class="badge-number">{{ $count ?? 0 }}</span>
    </div>
    <div class="dropdown">
        <div class="profile-icon mx-2" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name[0] ?? 'A' }}
        </div>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><p class="dropdown-item">Hello {{ Auth::user()->name ?? 'User' }}</p></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
   </ul>                     </div>                 </div>                    </div>              </div>             @yield('content')         </div>     </div>

<!-- Modal de notification Bootstrap -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(isset($notifications) && $notifications->count() > 0)
                    @foreach ($notifications as $notification)
                        <div class="notification-item d-flex align-items-start mb-3">
                            <div class="notification-content flex-grow-1">
                                <div class="notification-title">
                                    <strong>{{ $notification->contenu }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <div class="notification-info">
                                        <span class="badge {{ $notification->estLu ? 'bg-secondary' : 'bg-success' }}">
                                            {{ $notification->estLu ? 'lu' : 'non lu' }}
                                        </span>
                                    </div>
                                    <div class="notification-meta d-flex align-items-center">
                                        <span class="me-2">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">Aucune notification disponible</p>
                @endif
            </div>
            <div class="modal-footer">
                <a href="#" class="text-primary text-decoration-none">Voir toutes les notifications</a>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body mt-2">
        <button type="button" class="btn-close mb-2" data-bs-dismiss="modal" aria-label="Close"></button>


<style>


    .facture {
        flex: 1;
        border: 1px solid #ccc;
        padding: 20px;
        max-width: 600px;
        background-color: #f9f9f9;
        border-radius: 6px;
    }

    .paiement {
        flex: 1;
        max-width: 600px;
    }

    h1, h2 {
        margin-top: 0;
    }

    h2 {
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    .total {
        font-weight: bold;
        font-size: 1.2em;
        margin-top: 20px;
    }

    #paypal-button-container {
        margin-top: 40px;
    }
</style>

<div>
    <div id="success-alert" class="alert alert-success alert-dismissible fade success-alert" role="alert" style="display: none;">
        <strong>Succès !</strong> Votre paiement est réussi et votre réservation bien enregistrée.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="container">
        <div class="facture">
            <h2 class="text-center">Facture</h2>

            <p class="total">Total à payer : 5$</p>
        </div>

        <div class="paiement">
            <h3 class="text-center">Effectuer le paiement</h3>
            <div id="paypal-button-container"></div>
        </div>
    </div>
</div>

    <!-- Formulaire pour créer la notification après paiement -->
    <form id="notification-form" method="POST" action="{{ route('notifications.create') }}" style="display: none;">
        @csrf
        <input type="hidden" id="notification-content" name="contenu" value="Votre paiement de 5$ via PayPal a été traité avec succès">
        <input type="hidden" name="id_user" value="{{ auth()->id() }}">
    </form>

<!-- Script PayPal -->
<script src="https://www.paypal.com/sdk/js?client-id=Aa-SflJqXqi9ZQDNq9fEkcLgRk3aT2_4Ap_nwIx0seEfxnLMzShSO5cdM0ZPSWoHYMgVw8vsK23acZXB"></script>

<script>
    const total = 5; // Exemple si DH doit être converti

    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total.toString()
                    }
                }]
            });
        },

        onApprove: function(data, actions) {
             return actions.order.capture().then(function(details) {
                    // Remplir les champs du formulaire avec les détails du paiement
                    document.getElementById('notification-content').value = `Votre paiement de 5$ via PayPal a été traité avec succès. Transaction ID: ${data.orderID}. Payé par: ${details.payer.name.given_name} ${details.payer.name.surname}. Merci pour votre réservation!`;



                     setTimeout(() => {
                    window.location.href = "{{ route('template2') }}";
                    }, 3000);
                    document.getElementById('notification-form').submit();





            });
        }
    }).render('#paypal-button-container');

    function showSuccessAlert() {
        const alert = document.getElementById('success-alert');
        alert.style.display = 'block';
        alert.classList.add('show');
        document.getElementById('notification-form').submit();
                    showSuccessAlert();

        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => {
                alert.style.display = 'none';
            }, 150);
        }, 2000);



    }
</script>


      </div>

    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script>
        function selectTemplate(element, templateType) {
            // Retirer la classe active de tous les templates
            document.querySelectorAll('.template-card').forEach(card => {
                card.classList.remove('active');
            });

            // Ajouter la classe active au template sélectionné
            element.classList.add('active');

            console.log('Template sélectionné:', templateType);
        }

        function changeColor(color) {
            // Retirer la classe active de toutes les couleurs
            document.querySelectorAll('.color-option').forEach(option => {
                option.classList.remove('active');
            });

            // Ajouter la classe active à la couleur sélectionnée
            document.querySelector(`.color-${color}`).classList.add('active');

            // Changer la couleur du header
            const header = document.getElementById('cvHeader');
            header.className = 'header';
            header.classList.add(`color-${color}`);
        }

        function changeFont(font) {
            // Retirer la classe active de toutes les polices
            document.querySelectorAll('.font-option').forEach(option => {
                option.classList.remove('active');
            });

            // Ajouter la classe active à la police sélectionnée
            event.target.classList.add('active');

            // Changer la police du CV
            const cvContainer = document.querySelector('.cv-container');
            cvContainer.className = 'cv-container';
            cvContainer.classList.add(`font-${font}`);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

</body>
</html>
