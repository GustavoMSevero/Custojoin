<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("adminCJ/con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];

$pegarRelatorio=$pdo->prepare("SELECT * FROM relatorios WHERE idempresa=:idempresa AND mes=:mes AND ano=:ano");
$pegarRelatorio->bindValue(":idempresa", $idempresa);
$pegarRelatorio->bindValue(":mes", $mes);
$pegarRelatorio->bindValue(":ano", $ano);
$pegarRelatorio->execute();

// $numeroDeLinhas = $pegarRelatorio->rowCount();
// echo "número de registros $numeroDeLinhas";
$count = $pegarRelatorio->rowCount();

if($count == null){

    $status = 0;
    $msg = "Sem dados para exibir";

    $return = array(
        'status'   => $status,
        'msg'	=> $msg
    );

    echo json_encode($return);

} else {

    while ($linha=$pegarRelatorio->fetch(PDO::FETCH_ASSOC)) {

    $codigo = $linha['codigo'];
    $descricao = $linha['descricao'];
    $valor = $linha['valor'];
    $mes = $linha['mes'];
    $ano = $linha['ano'];

    $valor = number_format($valor,2,",",".");

    $return[] = array(
        'codigo'	=> $codigo,
        'descricao'	=> mb_convert_encoding($descricao, 'UTF-8', 'ISO-8859-1'),
        'valor'	=> $valor,
        'mes'	=> $mes,
        'ano'	=> $ano
    );

}

echo json_encode($return);
}




?>