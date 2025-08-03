<<<<<<< HEAD
<!-- Enhanced Master Data Configuration -->

<head>
    <title>Pengaturan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #7209b7;
            --light: #f8f9fa;
            --dark: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            z-index: -1;
            transition: height 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .glass-card:hover::before {
            height: 100%;
        }

        .menu-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.3s ease;
        }

        .glass-card:hover .menu-icon {
            color: white;
            -webkit-text-fill-color: white;
        }

        .menu-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .menu-desc {
            font-size: 0.9rem;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .glass-card:hover .menu-title,
        .glass-card:hover .menu-desc {
            color: white;
        }

        .page-header {
            position: relative;
            margin-bottom: 3rem;
            text-align: center;
        }

        .page-title {
            font-weight: 700;
            position: relative;
            display: inline-block;
            color: var(--dark);
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 2px;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            margin-top: 1rem;
        }
    </style>
</head>

<div class="container py-5">
    <div class="page-header">
        <h1 class="page-title">Konfigurasi Master Data</h1>
        <p class="page-subtitle">Kelola data utama sistem administrasi LKSA</p>
    </div>
    <div class="row g-4 justify-content-center">
        <!-- Data Panti Asuhan -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="home-admin.php?page=company" class="text-decoration-none">
                <div class="glass-card text-center p-4 h-100">
                    <i class="fas fa-home menu-icon"></i>
                    <h4 class="menu-title">Data Panti Asuhan</h4>
                </div>
            </a>
        </div>

        <!-- Data User -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="home-admin.php?page=form-view-user" class="text-decoration-none">
                <div class="glass-card text-center p-4 h-100">
                    <i class="fas fa-users menu-icon"></i>
                    <h4 class="menu-title">Data User</h4>
                </div>
            </a>
        </div>

        <!-- Chart of Account -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="home-admin.php?page=perkiraan" class="text-decoration-none">
                <div class="glass-card text-center p-4 h-100">
                    <i class="fas fa-chart-pie menu-icon"></i>
                    <h4 class="menu-title">Chart of Account</h4>
                </div>
            </a>
        </div>

        <!-- Setup Transaksi Rutin -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="home-admin.php?page=transsetup" class="text-decoration-none">
                <div class="glass-card text-center p-4 h-100">
                    <i class="fas fa-cogs menu-icon"></i>
                    <h4 class="menu-title">Setup Transaksi Rutin</h4>
                </div>
            </a>
        </div>
    </div>
</div>
=======
            <!-- Basic Examples -->
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>												
<?php


?>	
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Konfigurasi Master Data</label></center></h1>
							<br><br><br>
                            <center><a href="home-admin.php?page=company" class="">Data Panti Asuhan</a></center><br>
							<center><a href="home-admin.php?page=form-view-user" class="">Data User</a></center><br>
							<center><a href="home-admin.php?page=perkiraan" class="">Chart of Account (Tabel Perkiraan)</a></center><br> 
							<center><a href="home-admin.php?page=transsetup" class="">Setup Transaksi Rutin</a></center>
							<br><br><br>
						</div>
                    </div>    
                </div>
            </div>
            <!-- #END# Basic Examples -->
			
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
