<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Área Interna</title>
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
			$sql = "SELECT * FROM usuarios WHERE id='".addslashes($_SESSION["logado"])."';";
			$sql = $pdo->query($sql);
			if ($sql->rowCount() > 0) {
				//Guarda as informações do usuário na variável info (Ela vira um array)
				$info = $sql->fetch();
				$email = $info["email"];
				$nome = $info["nome"];
				$sobrenome = $info["sobrenome"];
				$convites = $info["convites"];
			}
		?>
		<div style="text-align:center;
		padding-top: 120px;
		padding-bottom: 40px;">
		<h1>Área restrita do usuário</h1>
		<h2> <?php echo $nome." ".$sobrenome; ?></h2>
		<p>Email: <?php echo $email; ?> <a href="sair.php">Sair</a></p>
		<button class="btn-primary" onclick="window.location.href='enviarEmail.php';"          <?php echo($convites==0)?"disabled":""; ?>
				>Enviar email com convite</button> 
				<?php echo "Convites restantes: ".$convites ?>	
		</div>	
	</body>	
</html>