<?php
include 'koneksi.php';


// Ambil data dari database
$totalUsers = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM login"))['total'];
$totalAssets = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM inventory"))['total'];
$totalSiswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_siswa"))['total'];
$totalPengelola = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_pengelola"))['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://via.placeholder.com/32" type="image/x-icon">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --dark: #212529;
            --light: #f8f9fa;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            color: #333;


        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }


        .dashboard-header {
            background: var(--primary-gradient);
            color: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.2);
            /* naik ke atas sedikit */
        }

        .card-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            z-index: 1;
            border-left: 4px solid transparent;
        }

        .card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0));
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card-custom:hover::before {
            opacity: 1;
        }

        .card-icon {
            font-size: 2.2rem;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 1rem;
            color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1rem;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-footer {
            background: transparent;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 0.85rem;
            color: #6c757d;
        }

        .bg-primary-custom {
            background: linear-gradient(135deg, #4361ee, #3f37c9);
            border-left-color: #4361ee;
        }

        .bg-success-custom {
            background: linear-gradient(135deg, #4cc9f0, #4895ef);
            border-left-color: #4cc9f0;
        }

        .bg-info-custom {
            background: linear-gradient(135deg, #7209b7, #560bad);
            border-left-color: #7209b7;
        }

        .bg-warning-custom {
            background: linear-gradient(135deg, #f72585, #b5179e);
            border-left-color: #f72585;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .chart-container {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .recent-activity {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .activity-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>



    <div class="container">
        <div class="dashboard-header" data-aos="fade-down">
            <div class="row align-items-center">

                <div class="col-md-8">
                    <h1 class="fw-bold mb-3">Dashboard Admin</h1>
                    <p class="mb-0">Selamat datang kembali! Berikut adalah ringkasan kegiatan dan data terkini di LKSA.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-light rounded-pill px-4">
                        <i class="fas fa-calendar-alt me-2"></i> <?php echo date('d F Y'); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Total Users -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-custom bg-primary-custom stat-card">
                    <div class="d-flex align-items-center">
                        <div class="card-icon bg-white text-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="card-title">Total Users</h5>
                            <h2 class="card-value text-white"><?php echo $totalUsers; ?></h2>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Total Assets -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-custom bg-success-custom stat-card">
                    <div class="d-flex align-items-center">
                        <div class="card-icon bg-white text-success">
                            <i class="fas fa-boxes-stacked"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="card-title">Total Aset</h5>
                            <h2 class="card-value text-white"><?php echo $totalAssets; ?></h2>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Total Siswa -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-custom bg-info-custom stat-card">
                    <div class="d-flex align-items-center">
                        <div class="card-icon bg-white text-info">
                            <i class="fas fa-child-reaching"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="card-title">Total Siswa</h5>
                            <h2 class="card-value text-white"><?php echo $totalSiswa; ?></h2>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Total Pengelola -->
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card card-custom bg-warning-custom stat-card">
                    <div class="d-flex align-items-center">
                        <div class="card-icon bg-white text-warning">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="card-title">Total Pengelola</h5>
                            <h2 class="card-value text-white"><?php echo $totalPengelola; ?></h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">


        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Activity Chart
        const ctx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pengguna',
                    data: [120, 190, 170, 220, 250, 280, 310, 290, 330, 350, 380, 400],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    tension: 0.3,
                    fill: true
                }, {
                    label: 'Siswa',
                    data: [80, 120, 140, 160, 180, 200, 220, 210, 230, 250, 270, 300],
                    borderColor: '#7209b7',
                    backgroundColor: 'rgba(114, 9, 183, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>