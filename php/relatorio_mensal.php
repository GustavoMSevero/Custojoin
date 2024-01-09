<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("adminCJ/con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$idempresa = $data->idempresa;
$mes = $data->mes;
$ano = $data->ano;

$checaSeExiste=$pdo->prepare("SELECT *
                                FROM relatorios 
                                WHERE idempresa=:idempresa
                                AND MONTH(mes)=:mes
                                AND YEAR(mes)=:ano");
$checaSeExiste->bindValue(":idempresa", $idempresa);
$checaSeExiste->bindValue(":mes", $mes);
$checaSeExiste->bindValue(":ano", $ano);
$checaSeExiste->execute();

$numeroDeLinhas = $checaSeExiste->rowCount();

if ($numeroDeLinhas > 0) {

    $return = array(
        'mes'	=> $mes,
        'ano'	=> $ano
    );

    echo json_encode($return);

} else {

    $relatorioMensal=$pdo->prepare("INSERT INTO relatorios (mes, idempresa, codigo, descricao, valor_total)
                                    SELECT data, idempresa, codigo, descricao, SUM(valor) AS valor_total 
                                    FROM conta_importada 
                                    WHERE idempresa=:idempresa
                                    AND MONTH(data)=:mes
                                    AND YEAR(data)=:ano
                                    GROUP BY data, codigo, descricao");
    $relatorioMensal->bindValue(":idempresa", $idempresa);
    $relatorioMensal->bindValue(":mes", $mes);
    $relatorioMensal->bindValue(":ano", $ano);
    $relatorioMensal->execute();

    $return = array(
        'mes'	=> $mes,
        'ano'	=> $ano
    );

    echo json_encode($return);
}

?>