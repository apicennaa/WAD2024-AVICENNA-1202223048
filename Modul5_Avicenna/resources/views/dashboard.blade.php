@extends('layouts.app')
@section('content')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2ecc71;
        --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    body {
        background: var(--bg-gradient);
        font-family: 'Poppins', sans-serif;
    }

    .dashboard-container {
        padding: 30px;
    }

    .card-custom {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .card-custom:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .card-header-custom {
        background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        display: flex;
        align-items: center;
        padding: 15px;
    }

    .card-header-custom i {
        margin-right: 10px;
        font-size: 1.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        align-items: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: scale(1.05);
    }

    .stat-icon {
        font-size: 3rem;
        margin-right: 20px;
        opacity: 0.7;
    }

    .stat-content h3 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .chart-container {
        position: relative;
        height: 350px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animated-entry {
        animation: fadeIn 0.8s ease forwards;
        opacity: 0;
    }
</style>

<div class="dashboard-container">
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-md-4 animated-entry" style="animation-delay: 0.2s;">
            <div class="stat-card">
                <div class="stat-icon text-primary">
                    <i class="ri-user-teacher-line"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Dosen</h3>
                    <p class="text-muted">{{ $totalDosen ?? 150 }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 animated-entry" style="animation-delay: 0.4s;">
            <div class="stat-card">
                <div class="stat-icon text-success">
                    <i class="ri-graduation-cap-line"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Mahasiswa</h3>
                    <p class="text-muted">{{ $totalMahasiswa ?? 5000 }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 animated-entry" style="animation-delay: 0.6s;">
            <div class="stat-card">
                <div class="stat-icon text-danger">
                    <i class="ri-book-open-line"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Prodi</h3>
                    <p class="text-muted">{{ $totalProdi ?? 15 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dosen Distribution Chart
        const dosenCtx = document.getElementById('dosenChart').getContext('2d');
        new Chart(dosenCtx, {
            type: 'pie',
            data: {
                labels: ['FTII', 'FTI', 'FEB', 'FKIP', 'Lainnya'],
                datasets: [{
                    data: [30, 25, 20, 15, 10],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });

        // Mahasiswa Growth Chart
        const mahasiswaCtx = document.getElementById('mahasiswaChart').getContext('2d');
        new Chart(mahasiswaCtx, {
            type: 'line',
            data: {
                labels: ['2019', '2020', '2021', '2022', '2023'],
                datasets: [{
                    label: 'Pertumbuhan Mahasiswa',
                    data: [4000, 4500, 4800, 5000, 5200],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection