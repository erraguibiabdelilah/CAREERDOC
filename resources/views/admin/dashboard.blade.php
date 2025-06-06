@extends('layouts.adminDashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-3 text-gray-800">Tableau de Bord - Statistiques</h1>
        </div>
    </div>

    <!-- Cartes de statistiques principales -->
    <div class="row mb-4">
        <!-- Utilisateurs actifs -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Utilisateurs Actifs
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="active-users">
                                8
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total utilisateurs -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Utilisateurs
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-users">
                                45
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CV créés ce mois -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                CV créés ce mois
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="cvs-month">
                                12
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lettres créées ce mois -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Lettres créées ce mois
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="letters-month">
                                9
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row">
        <!-- Évolution mensuelle -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Évolution Mensuelle</h6>
                    <div class="dropdown no-arrow">
                        <select id="year-filter" class="form-control form-control-sm" style="width: auto;">
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Répartition par type -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Répartition par Type</h6>
                </div>
                <div class="card-body">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- Scripts pour les graphiques et mise à jour temps réel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Données statiques pour les graphiques
    const monthlyData = {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        cvs: [3, 5, 7, 4, 6, 8, 9, 12, 7, 10, 11, 12],
        coverLetters: [2, 3, 4, 3, 5, 6, 7, 9, 5, 8, 8, 9],
        jobRequests: [1, 2, 3, 2, 4, 5, 6, 7, 4, 6, 7, 8]
    };
    
    const pieData = {
        cvs: 84,
        coverLetters: 69,
        jobRequests: 55
    };
    
    // Graphique mensuel
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: monthlyData.labels,
            datasets: [{
                label: 'CV créés',
                data: monthlyData.cvs,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                tension: 0.4
            }, {
                label: 'Lettres de motivation',
                data: monthlyData.coverLetters,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                tension: 0.4
            }, {
                label: 'Demandes d\'emploi',
                data: monthlyData.jobRequests,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Évolution des documents créés par mois'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique en secteurs
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['CV', 'Lettres de motivation', 'Demandes d\'emploi'],
            datasets: [{
                data: [
                    pieData.cvs,
                    pieData.coverLetters,
                    pieData.jobRequests
                ],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Données pour les différentes années
    const yearData = {
        2024: {
            cvs: [3, 5, 7, 4, 6, 8, 9, 12, 7, 10, 11, 12],
            coverLetters: [2, 3, 4, 3, 5, 6, 7, 9, 5, 8, 8, 9],
            jobRequests: [1, 2, 3, 2, 4, 5, 6, 7, 4, 6, 7, 8]
        },
        2023: {
            cvs: [2, 4, 6, 3, 5, 7, 8, 10, 6, 9, 10, 11],
            coverLetters: [1, 2, 3, 2, 4, 5, 6, 8, 4, 7, 7, 8],
            jobRequests: [1, 1, 2, 1, 3, 4, 5, 6, 3, 5, 6, 7]
        }
    };

    // Mise à jour temps réel simulée (optionnel)
    function updateStats() {
        // Simulation de légères variations
        const activeUsers = 8 + Math.floor(Math.random() * 3 - 1); // 7-10
        const totalUsers = 45 + Math.floor(Math.random() * 5); // 45-49
        const cvsMonth = 12 + Math.floor(Math.random() * 3 - 1); // 11-14
        const lettersMonth = 9 + Math.floor(Math.random() * 3 - 1); // 8-11
        
        document.getElementById('active-users').textContent = activeUsers;
        document.getElementById('total-users').textContent = totalUsers;
        document.getElementById('cvs-month').textContent = cvsMonth;
        document.getElementById('letters-month').textContent = lettersMonth;
    }

    // Mise à jour toutes les 30 secondes (optionnel)
    setInterval(updateStats, 30000);

    // Filtre par année
    document.getElementById('year-filter').addEventListener('change', function() {
        const year = this.value;
        const data = yearData[year];
        
        if (data) {
            monthlyChart.data.datasets[0].data = data.cvs;
            monthlyChart.data.datasets[1].data = data.coverLetters;
            monthlyChart.data.datasets[2].data = data.jobRequests;
            monthlyChart.update();
        }
    });
});
</script>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.text-primary {
    color: #4e73df !important;
}
.text-success {
    color: #1cc88a !important;
}
.text-info {
    color: #36b9cc !important;
}
.text-warning {
    color: #f6c23e !important;
}
#monthlyChart, #pieChart {
    height: 300px !important;
}
</style>
@endsection