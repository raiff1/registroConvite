<?php
	$dsn = "mysql:dbname=id3367851_projeto_registroporconvite;
	host=localhost";
	$dbuser = "id3367851_raiff1";
	$dbpasswd = "9401ra";

	try {
		$pdo = new PDO($dsn, $dbuser, $dbpasswd);
	} catch(PDOException $e) {
	echo "Erro: ".$e->getMessage();
	exit;
	}
?>