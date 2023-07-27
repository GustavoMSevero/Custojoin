<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("../con.php");

$pdo = conectar();

$pegaSubcategoria=$pdo->prepare("SELECT * FROM subcategoria");
$pegaSubcategoria->execute();

$return = array();

while ($linhaSubcate=$pegaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

	$return[] = array(
		'idsubcategoria'	=> $linhaSubcate['idsubcategoria'],
		'subcategoria'	=> utf8_encode($linhaSubcate['subcategoria']),
		'tipo'	=> $linhaSubcate['tipo']
	);
}

echo json_encode($return);

?>