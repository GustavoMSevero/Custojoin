<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("../con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$idempresa = $data->idempresa;
$tipo = "Pagamento";

$buscaContaSaida=$pdo->prepare('SELECT * FROM conta WHERE empresa_idempresa=:idempresa AND tipo=:tipo');
$buscaContaSaida->bindValue('idempresa', $idempresa);
$buscaContaSaida->bindValue('tipo', $tipo);
$buscaContaSaida->execute();


while ($linhaContaS=$buscaContaSaida->fetch(PDO::FETCH_ASSOC)) {

	$idsub = $linhaContaS['subcategoria_idsubcategoria'];

	$buscaSubcategoria=$pdo->prepare('SELECT subcategoria FROM subcategoria WHERE idsubcategoria=:idsub');
	$buscaSubcategoria->bindValue('idsub', $idsub);
	$buscaSubcategoria->execute();

	while ($linhaSub=$buscaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

		$return[] = array(
			'idconta'	=> $linhaContaS['idconta'],
			'conta'	=> utf8_encode($linhaContaS['conta']),
			'idsubcategoria'	=> $linhaContaS['subcategoria_idsubcategoria'],
			'subcategoria'	=> utf8_encode($linhaSub['subcategoria']),
		);

	}

}

echo json_encode($return);