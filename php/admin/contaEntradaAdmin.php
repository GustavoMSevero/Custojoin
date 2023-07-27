<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("../con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

//print_r($data);

$idsubcategoria = $data->subcategoria;
$contaEntrada = $data->contaEntrada;
$idempresa = $data->idempresa;

$contaEntrada = utf8_decode($contaEntrada);

$tipo = "Recebimento";

$insereContaEntrada=$pdo->prepare("INSERT INTO conta (idconta, conta, tipo, empresa_idempresa, subcategoria_idsubcategoria)
									VALUES(?, ?, ?, ?, ?)");
$insereContaEntrada->bindValue(1, NULL);
$insereContaEntrada->bindValue(2, $contaEntrada);
$insereContaEntrada->bindValue(3, $tipo);
$insereContaEntrada->bindValue(4, $idempresa);
$insereContaEntrada->bindValue(5, $idsubcategoria);

$insereContaEntrada->execute();

?>