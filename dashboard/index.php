<?php
require_once "./painel/class/User-class.php";
$class = new User();
$class->criarUser();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<style>
		body {
			background: linear-gradient(100deg, #ffe53bd8, #ff2525da);
		}

		.card-body {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		.card-body form {
			background-color: transparent;
			border-radius: 3px;
			box-shadow: 0px 8px 10px rgba(0, 0, 0, .5);
			padding: 30px 20px;
			width: 30%;
		}
	</style>
</head>

<body>


	<div class="container">
		<div class="card-body">
			<form method="POST" action="autenticar.php">
				<div class="mb-3">
					<label for="email" class="form-label">E-mail</label>
					<input type="email" class="form-control" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha</label>
					<input type="password" class="form-control" id="senha" name="senha">
				</div>
				<div class="form-group">
					<input type="submit" value="Entrar" class="btn btn-dark float-right login_btn">
				</div>
			</form>
		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>