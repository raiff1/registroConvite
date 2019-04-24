<?php
	session_start();
	//Remove o valor da sessão para deslogar o usuário
	unset($_SESSION["logado"]);
	header("Location: index.php");
	exit;
?>