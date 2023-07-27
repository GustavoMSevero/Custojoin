<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("../con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$idempresa = $data->idempresa;
$tipo = "Recebimento";

$buscaContaEntrada=$pdo->prepare('SELECT * FROM conta WHERE empresa_idempresa=:idempresa AND tipo=:tipo');
$buscaContaEntrada->bindValue('idempresa', $idempresa);
$buscaContaEntrada->bindValue('tipo', $tipo);
$buscaContaEntrada->execute();

while ($linhaContaE=$buscaContaEntrada->fetch(PDO::FETCH_ASSOC)) {

	$idsub = $linhaContaE['subcategoria_idsubcategoria'];

	$buscaSubcategoria=$pdo->prepare('SELECT subcategoria FROM subcategoria WHERE idsubcategoria=:idsub');
	$buscaSubcategoria->bindValue('idsub', $idsub);
	$buscaSubcategoria->execute();

	while ($linhaSub=$buscaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

		$return[] = array(
			'idconta'	=> $linhaContaE['idconta'],
			'conta'	=> utf8_encode($linhaContaE['conta']),
			'idsubcategoria'	=> $linhaContaE['subcategoria_idsubcategoria'],
			'subcategoria'	=> utf8_encode($linhaSub['subcategoria']),
		);

	}

}

echo json_encode($return);


