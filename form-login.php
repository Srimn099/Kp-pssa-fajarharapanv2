<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - LKSA Fajar Harapan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		body {
			background-color: rgb(213, 213, 213);
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}

		.login-container {
			display: flex;
			width: 800px;
			background: #fff;
			border-radius: 10px;
			box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
			overflow: hidden;
		}

		.login-left {
			background: #0056b3;
			color: white;
			width: 50%;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			text-align: center;
			padding: 20px;
		}

		.login-left img {
			width: 100px;
			margin-bottom: 15px;
		}

		.login-right {
			width: 50%;
			padding: 40px;
		}

		.btn-home {
			margin-top: 15px;
		}

		/* Custom Styling for Input Fields */
		.form-control {
			border: 1px solid #808080;
			border-radius: 5px;
			padding: 10px;
			font-size: 16px;
		}

		.form-control:focus {
			border-color: #003d80;
			box-shadow: 0 0 5px rgba(0, 86, 179, 0.5);
		}

		/* Password Input with Eye Icon */
		.password-wrapper {
			position: relative;
		}

		.password-wrapper .toggle-password {
			position: absolute;
			top: 50%;
			right: 10px;
			transform: translateY(-50%);
			cursor: pointer;
			color: #0056b3;
		}
	</style>
</head>

<body>
	<div class="login-container">
		<div class="login-left">
			<img src="image/logo_panti.png" alt="Logo Muhammadiyah">
			<h2>LKSA FAJAR HARAPAN</h2>
		</div>
		<div class="login-right">
			<h4 class="text-center">Login</h4>
			<p class="text-center">Belum punya akun? <a href="#">Buat akun</a></p>
			<form action="login/login.php" method="POST">
				<div class="mb-3">
					<input type="text" name="username" class="form-control" placeholder="Username" required>
				</div>
				<div class="mb-3 password-wrapper">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					<i class="fas fa-eye-slash toggle-password" id="togglePassword"></i>
				</div>
				<div class="d-flex justify-content-between mb-3">
					<a href="#">Lupa password?</a>
				</div>
				<button type="submit" class="btn btn-primary w-100">Login</button>
				<a href="index.php" class="btn btn-secondary w-100 btn-home">Kembali ke Home</a>
			</form>
		</div>
	</div>

	<script>
		// Toggle Show/Hide Password
		document.getElementById("togglePassword").addEventListener("click", function() {
			const passwordField = document.getElementById("password");
			if (passwordField.type === "password") {
				passwordField.type = "text";
				this.classList.remove("fa-eye-slash");
				this.classList.add("fa-eye");
			} else {
				passwordField.type = "password";
				this.classList.remove("fa-eye");
				this.classList.add("fa-eye-slash");
			}
		});
	</script>
</body>

</html>