<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("../con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

//print_r($data);

$idsubcategoria = $data->subcategoria;
$contaSaida = $data->contaSaida;
$idempresa = $data->idempresa;

$contaSaida = utf8_decode($contaSaida);

$tipo = "Pagamento";

$insereContaSaida=$pdo->prepare("INSERT INTO conta (idconta, conta, tipo, empresa_idempresa, subcategoria_idsubcategoria)
									VALUES(?, ?, ?, ?, ?)");
$insereContaSaida->bindValue(1, NULL);
$insereContaSaida->bindValue(2, $contaSaida);
$insereContaSaida->bindValue(3, $tipo);
$insereContaSaida->bindValue(4, $idempresa);
$insereContaSaida->bindValue(5, $idsubcategoria);

$insereContaSaida->execute();

?>