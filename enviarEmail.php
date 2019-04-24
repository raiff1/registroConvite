<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Enviar email</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<script type="text/javascript" scr="jquery.min.js"></script>
		<script type="text/javascript" scr="bootstrap.min.js"></script>
	</head>
	<body style="background-color:#EEE">
		<?php
			require "config.php";
			if (empty($_SESSION["logado"])) {
				echo "<script>window.location.href='index.php'</script>";
				exit;
			}

			if (isset($_POST["email_destinatario"]) && !empty($_POST["email_destinatario"])) {
				$email_destinatario = addslashes($_POST["email_destinatario"]);
				//Verifica o código e o número de convites do usuário
				$sql = "SELECT * FROM usuarios WHERE id='".addslashes($_SESSION["logado"])."';";
				$sql = $pdo->query($sql);
				if ($sql->rowCount() > 0) {
					//Pega o código atrelado ao usuário
					$info = $sql->fetch();
					$codigo = $info["codigo"];
					$nome = $info["nome"];
					$sobrenome = $info["sobrenome"];
					$id = $info["id"];
					//Atualiza o número de convites
					$sql = "UPDATE usuarios SET convites = convites-1 WHERE id='$id';";
					$sql = $pdo->query($sql);
				} else {
					echo "<script>alert('Número de convites esgotados!')</script>";
					echo "<script>window.location.href='areaInterna.php'</script>";
					exit;
				}

				$corpo = "Olá, você recebeu um convite de ".$nome." ".$sobrenome." para poder se cadastrar em nosso sistema. Clique no link abaixo para se cadastrar!"."\n\n".
					"raiffsmith.000webhostapp.com/cadastrar.php?codigo=".$codigo;

				$cabeçalho = "From: Teste Sistema 
								<raiffsmith.000webhostapp.com>"."\r\n".
							 "Reply-To: Raiff Smith
							 	<raiffsmith.000webhostapp.com>"."\r\n".
							 "X-Mailer: PHP/".phpversion();

				mail($email_destinatario, "Convite para cadastro", 
					$corpo, $cabeçalho);

				echo "<script>alert('Convite enviado com sucesso!')</script>";
				echo "<script>window.location.href='areaInterna.php'</script>";
				exit;
			}

		?>
		<div style="text-align:center;
		padding-top: 120px;
		padding-bottom: 40px;">
			<form method="POST">
				<h1>Enviar convite</h1>
				<input style="max-width:280px; margin:0 auto; float:none;" class="form-control" type="text" name="email_destinatario" placeholder="Digite o email" required /><br/>

				<input class="btn-primary" type="submit" value="Enviar email" />
				<a href="areaInterna.php">Retornar</a>
			</form>
		</div>
	</body>
</html>