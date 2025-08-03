<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detail User</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-color: #f8f9fa;
			font-family: 'Arial', sans-serif;
			text-align: center;
		}

		.profile-card {
			max-width: 500px;
			margin: auto;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			background-color: #ffffff;
			padding: 20px;
			text-align: center;
		}

		.profile-img {
			width: 120px;
			height: 120px;
			border-radius: 50%;
			object-fit: cover;
			border: 4px solid #007bff;
		}

		.profile-card h3 {
			margin-top: 15px;
			color: #333;
		}

		.profile-card p {
			color: #555;
			font-size: 16px;
		}

		.profile-card .badge {
			font-size: 14px;
			padding: 5px 10px;
		}
	</style>
</head>

<body class="bg-light">
	<div class="container mt-5">
		<div class="profile-card">
			<img src="image/user.png" alt="User Profile" class="profile-img">
			<h3><?= $_SESSION['nama']; ?></h3>
			<p><strong>Username:</strong> <?= $_SESSION['username']; ?></p>
			<p><strong>Hak Akses:</strong> <span class="badge bg-primary"><?= $_SESSION['hak_akses']; ?></span></p>
		</div>
	</div>
</body>

</html>