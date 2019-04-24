<!DOCTYPE html>
<html>
	<head>
		<title>Cadastro</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<script type="text/javascript" scr="jquery.min.js"></script>
		<script type="text/javascript" scr="bootstrap.min.js"></script>
	</head>
	<body style="background-color:#EEE">
		<?php
			require "config.php";
			//Verifica se o código foi mandado certo, caso não foi mandado ou esteja errado, ele sai da página. Se está tudo correto, ele apenas segue a execução do código normalmente para o cadastro.
			if (!empty($_GET["codigo"])) {
				$codigo = addslashes($_GET["codigo"]);

				$sql = "SELECT * FROM usuarios WHERE codigo='$codigo';";
				$sql = $pdo->query($sql);
				//Caso não tenha o código, ele volta pro index.php
				if ($sql->rowCount() == 0) {
					echo "<script>window.location.href='index.php'</script>";
					exit;
				}
			} else {
				echo "<script>window.location.href='index.php'</script>";
				exit;
			}

			if (isset($_POST["email"]) && !empty($_POST["email"])) {
				$nome = addslashes(ucwords(strtolower($_POST["nome"])));
				$sobrenome = addslashes(ucwords(strtolower($_POST["sobrenome"])));
				$email = addslashes($_POST["email"]);
				$senha = md5(addslashes($_POST["senha"]));
				//Gera um código aleatório para cada usuário
				$novocodigo = md5(time().rand(0,9999));

				$sql = "SELECT * FROM usuarios WHERE email='$email';";
				$sql = $pdo->query($sql);
				if ($sql->rowCount() > 0) {
					echo "<script>alert('Email já cadastrado!\\nPor favor tente novamente')</script>";
					echo "<script>window.location.href='cadastrar.php?codigo=".$codigo."'</script>";
					exit;
				} else {
					$sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, codigo, convites) VALUES ('$nome', '$sobrenome', '$email', '$senha', '$novocodigo', 5);";
					$pdo->query($sql);
					echo "<script>alert('Usuário cadastrado com sucesso!')</script>";
					echo "<script>window.location.href='index.php'</script>";
					exit;
				}
			}
		?>
		<div style="text-align:center;
		padding-top: 120px;
		padding-bottom: 40px;">
		<form class="form-signin" method="POST">
			<h2>Cadastro</h2>
			<input style="max-width:280px; margin:0 auto; float:none;" class="form-control" type="text" name="nome" placeholder="Nome" required /><br/><br/>

			<input style="max-width:280px; margin:0 auto; float:none;" class="form-control" type="text" name="sobrenome" placeholder="Sobrenome" required /><br/><br/>

			<input style="max-width:280px; margin:0 auto; float:none;" class="form-control" type="email" name="email" placeholder="Email" required /><br/><br/>

			<input style="max-width:280px; margin:0 auto; float:none;" class="form-control" type="password" name="senha" placeholder="Senha" required /><br/><br/>

			<input class="btn-primary" type="submit" value="Cadastrar" />
		</form>
		</div>
	</body>
</html>