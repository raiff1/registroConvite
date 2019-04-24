<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<link rel="stylesheet" href="style.css" />
		<script type="text/javascript" scr="jquery.min.js"></script>
		<script type="text/javascript" scr="bootstrap.min.js"></script>
	</head>
	<body>
		<?php
			require "config.php";
			if (isset($_SESSION["logado"])) {
				echo "<script>window.location.href='areaInterna.php'</script>";
			}
			if (isset($_POST["email"]) && !empty($_POST["email"])) {
				$email = addslashes($_POST["email"]);
				$senha = md5(addslashes($_POST["senha"]));

				$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha';";
				$sql = $pdo->query($sql);
				if ($sql->rowCount() > 0) {
					//guarda as informações do usuário
					$info = $sql->fetch();
					//Guarda o ID do usuário no índice logado da sessão
					$_SESSION["logado"] = $info["id"];
					//Redireciona para a nova página e depois para a execução do script com o exit.
					echo "<script>window.location.href='areaInterna.php'</script>";
					exit;
				} else {
					echo "<script>alert('Email / Senha inválido(s)')</script>";
					echo "<script>window.location.href='index.php'</script>";
					exit;
				}
			}
		?>
		<form class="form-signin" method="POST">
			<h1 class="form-signin-heading">Login</h1>
			<input class="form-control" type="email" name="email" placeholder="Email" autofocus required />

			<input class="form-control" type="password" name="senha" placeholder="Senha" required /><br/>

			<input class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar" />
		</form>
	</body>
</html>