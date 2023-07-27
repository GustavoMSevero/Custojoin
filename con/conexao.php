<?php

function conectar(){
	$host = "localhost";
	$user = "root";
	$pass = "root";
	$dbname = "fluxo_de_caixa";
	
	try {
		$opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$pdo = new PDO("mysql:host=localhost;dbname=fluxojoinbd;", "root", "root", $opcoes);
	} catch (Exception $e) {
		echo $e->getMessage();
	}

	return $pdo;

}

?>