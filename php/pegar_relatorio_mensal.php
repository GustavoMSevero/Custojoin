<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("adminCJ/con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];

// $mes = (int)$mes;

$pegarRelatorio=$pdo->prepare("SELECT *
                                FROM relatorios
                                WHERE idempresa=:idempresa
                                AND mes=:mes
                                AND ano=:ano");
$pegarRelatorio->bindValue(":idempresa", $idempresa);
$pegarRelatorio->bindValue(":mes", $mes);
$pegarRelatorio->bindValue(":ano", $ano);
$pegarRelatorio->execute();


while ($linha=$pegarRelatorio->fetch(PDO::FETCH_ASSOC)) {

    $codigo = $linha['codigo'];
    $descricao = $linha['descricao'];
    $valor = $linha['valor'];

    $valor = number_format($valor,2,",",".");

    $return[] = array(
        'codigo'	=> $codigo,
        'descricao'	=> $descricao,
        'valor'	=> $valor
    );

}

echo json_encode($return);




?>