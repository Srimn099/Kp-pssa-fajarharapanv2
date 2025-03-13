<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LKSA Fajar Harapan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			/* display: flex; */
			font-family: Arial, sans-serif;
		}



		.hero {
			background: url('image/fhb_01.jpeg') no-repeat center center/cover;
			color: white;
			height: 80vh;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			position: relative;
			padding: 20px;
			padding-top: 100px;
			/* Menyesuaikan geseran ke bawah */
		}

		/* Efek Overlay */
		.hero::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.5);
		}

		.hero-content {
			position: relative;
			z-index: 1;
		}

		.hero h1 {
			font-size: 50px;
			font-weight: bold;
			text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
		}

		.hero h1.br {
			font-size: 50px;
			font-weight: bold;
			text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
			color: blue;
		}

		.hero p {
			font-size: 1.2rem;
			margin-bottom: 20px;
		}

		.card img {
			height: 200px;
			object-fit: cover;

		}

		.info-list {
			list-style: none;
			padding: 0;
		}

		.info-list li {
			display: flex;
			justify-content: space-between;
			border-bottom: 1px solid #ddd;
			/* Opsional untuk garis pemisah */
			padding: 5px 0;
		}

		.info-title {
			font-weight: bold;
			width: 200px;
			/* Sesuaikan lebar agar rata */
		}
	</style>
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
		<div class="container">
			<a class="navbar-brand fw-bold" href="#">LKSA FAJAR HARAPAN</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item"><a class="nav-link text-white" href="#" id="backToTop">Home</a></li>
					<li class="nav-item"><a class="nav-link text-white" href="#about">Tentang</a></li>
					<li class="nav-item"><a class="nav-link text-white" href="#services">Layanan</a></li>
					<li class="nav-item"><a class="nav-link text-white" href="#contact">Kontak</a></li>
					<li class="nav-item">
						<a class="btn btn-light" href="form-login.php">Login</a>
					</li>


				</ul>
			</div>
		</div>
	</nav>

	<!-- Hero Section -->
<header class="hero">
    <div class="hero-content">
        <h1>Selamat Datang di Lembaga Kesejahteraan Sosial Anak <br> Fajar Harapan <br> <span style="color: blue;">MUHAMMADIYAH</span></h1>
        <a href="#about" class="btn btn-light">Lebih Lanjut</a>
    </div>
</header>


	<!-- About Section -->
	<section id="about" class="container my-5 text-center">
		<h2 class="fw-bold">Tentang Kami</h2>

		<!-- <img src="image/header03.png" class="img-fluid my-3" alt="Tentang Kami"> -->

		<p class="text-dark mt-3 fw-normal">
			Lembaga Kesejahteraan Sosial Anak adalah salah satu amal usaha Muhammadiyah yang memberikan santunan kepada anak-anak keluarga yang tidak mampu. <br>
			Diutamakan anak-anak yatim agar mereka berkemampuan hidup dalam masyarakat yang penuh persaingan serta memiliki kepribadian Islam.
		</p>
		<div class="row justify-content-center">
			<div class="col-md-8">
				<table class="table table-bordered text-start">
					<tbody>
						<tr>

							<td><strong>Nama LKS</strong></td>
							<td>: Panti Sosial Asuhan Anak FAJAR HARAPAN</td>
						</tr>
						<tr>
							<td><strong>Alamat</strong></td>
							<td>: Komp. Perumnas Sukaluyu Blok E.1-107 RT 04/09, Tlp 022-2503078, Bandung 40123</td>
						</tr>
						<tr>
							<td><strong>Tanggal Berdiri</strong></td>
							<td>: 23 Juni 2002</td>
						</tr>
						<tr>
							<td><strong>Terdaftar</strong></td>
							<td>: Dinas Provinsi Jawa Barat No. 064/4193/PPSKS/05/2014</td>
						</tr>
						<tr>
							<td><strong>NPWP</strong></td>
							<td>: 01.478.787.3-423.002</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</section>


	<!-- Services Section -->
	<section id="services" class="container my-5">
		<div class="row text-center">
			<div class="col-md-3">
				<div class="card p-3">
					<img src="image/fhb_01.jpeg" class="card-img-top" alt="Pemulihan">
					<h5>Pemulihan</h5>
					<p>Mengembalikan kondisi fisik, mental, dan sosial anak asuh.</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card p-3">
					<img src="image/fhb_01.jpeg" class="card-img-top" alt="Perlindungan">
					<h5>Perlindungan</h5>
					<p>Melindungi anak dari pengaruh negatif luar.</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card p-3">
					<img src="image/fhb_01.jpeg" class="card-img-top" alt="Pembinaan">
					<h5>Pembinaan</h5>
					<p>Memberikan pembinaan untuk perkembangan anak.</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card p-3">
					<img src="image/fhb_01.jpeg" class="card-img-top" alt="Pengembangan">
					<h5>Pengembangan</h5>
					<p>Mengembangkan potensi anak untuk masa depan lebih baik.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Contact Section -->
	<section id="contact" class="container my-5 text-center">
		<h2 class="fw-bold">Kontak Kami</h2>
		<p class="text-muted">Hubungi kami untuk informasi lebih lanjut.</p>

		<a href="mailto:info@lksa.com" class="btn btn-primary">Email Kami</a>

		<!-- Google Maps -->
		<div class="map-container mt-3" style="width: 90%; max-width: 600px; margin: auto;">
			<iframe
				width="100%"
				height="400"
				style="border:0;"
				allowfullscreen=""
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9327424905096!2d107.62808987475678!3d-6.898647693100558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64dc6f8a9d9%3A0xfe64a815adf09f6!2sPanti%20Sosial%20Asuhan%20Anak%20(Psaa)%20Fajar%20Harapan!5e0!3m2!1sid!2sid!4v1741367242411!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>

	</section>

	<!-- Footer -->
	<footer class="bg-primary text-white text-center py-3">
		<p>&copy; 2025 LKSA Fajar Harapan. All Rights Reserved.</p>
	</footer>

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>