<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("adminCJ/con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];

$pegarRelatorio=$pdo->prepare("SELECT *
                        FROM relatorios 
                        WHERE idempresa=:idempresa
                        AND MONTH(mes)=:mes
                        AND YEAR(mes)=:ano");
$pegarRelatorio->bindValue(":idempresa", $idempresa);
$pegarRelatorio->bindValue(":mes", $mes);
$pegarRelatorio->bindValue(":ano", $ano);
$pegarRelatorio->execute();


while ($linha=$pegarRelatorio->fetch(PDO::FETCH_ASSOC)) {

    $codigo = $linha['codigo'];
    $descricao = $linha['descricao'];
    $valor_total = $linha['valor_total'];

    $valor_total = number_format($valor_total,2,",",".");

    $return[] = array(
        'codigo'	=> $codigo,
        'descricao'	=> $descricao,
        'valor_total'	=> $valor_total
    );

}

echo json_encode($return);




?>