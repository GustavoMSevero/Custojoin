<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$tipo = "Pagamento";

$carregaSubcategoria=$pdo->prepare("SELECT * FROM subcategoria WHERE tipo=:tipo");
$carregaSubcategoria->bindValue("tipo", $tipo);
$carregaSubcategoria->execute();

$return = array();

while ($linha=$carregaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

	$return[] = array(
		'tipo'	=> $linha['tipo'],
		'subcategoria'	=> $linha['subcategoria'],
		'idsubcategoria'	=> $linha['idsubcategoria'],
	);
}

echo json_encode($return);