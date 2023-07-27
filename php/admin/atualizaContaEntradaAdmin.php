<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("../con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$conta = $data->conta;
$idconta = $data->idconta;
$idempresa = $data->idempresa;

$conta = utf8_decode($conta);

$atualizaContaEntrada=$pdo->prepare('UPDATE conta SET conta=:conta WHERE empresa_idempresa=:idempresa AND idconta=:idconta');
$atualizaContaEntrada->bindValue('conta', $conta);
$atualizaContaEntrada->bindValue('idempresa', $idempresa);
$atualizaContaEntrada->bindValue('idconta', $idconta);
$atualizaContaEntrada->execute();

$return = array(
	'msgAtualContaSucesso' => "Conta atualizada com sucesso!"
);

echo json_encode($return);
