<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$tipo = "Recebimento";
$carregaSubcategoria=$pdo->prepare("SELECT * FROM subcategoria WHERE tipo=:tipo");
$carregaSubcategoria->BindValue("tipo", $tipo);
$carregaSubcategoria->execute();

$return = array();

while ($linha=$carregaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

	$return[] = array(
		'tipo'	=> utf8_encode($linha['tipo']),
		'subcategoria'	=> utf8_encode($linha['subcategoria']),
		'idsubcategoria'	=> $linha['idsubcategoria']
	);
}

echo json_encode($return);