<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("adminCJ/con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$idempresa = $data->idempresa;
$dia = $data->dia;
$mes = $data->mes;
$ano = $data->ano;

// $relatorioMensal=$pdo->prepare("SELECT MONTH(:mes), codigo, descricao, SUM(valor) 
//                             AS valor_total 
//                             FROM conta_importada 
//                             WHERE idempresa=:idempresa 
//                             GROUP BY data, codigo, descricao 
//                             ORDER BY data, codigo");
// $relatorioMensal->bindValue(":idempresa", $idempresa);
// $relatorioMensal->bindValue(":mes", $mes);
// $relatorioMensal->execute();

$relatorioMensal=$pdo->prepare("INSERT INTO relatorios (mes, idempresa, codigo, descricao, valor_total)
                                SELECT data, idempresa, codigo, descricao, SUM(valor) AS valor_total 
                                FROM conta_importada 
                                WHERE idempresa=:idempresa
                                AND MONTH(data)=:mes
                                AND YEAR(data)=:ano
                                GROUP BY data, codigo, descricao 
                                ORDER BY data, codigo");
$relatorioMensal->bindValue(":idempresa", $idempresa);
$relatorioMensal->bindValue(":mes", $mes);
$relatorioMensal->bindValue(":ano", $ano);
$relatorioMensal->execute();


// while ($linha=$relatorioMensal->fetch(PDO::FETCH_ASSOC)) {

//     $codigo = $linha['codigo'];
//     $descricao = $linha['descricao'];
//     $valor_total = $linha['valor_total'];

//     $valor_total = number_format($valor_total,2,",",".");

//     $return[] = array(
//         'codigo'	=> $codigo,
//         'descricao'	=> $descricao,
//         'valor_total'	=> $valor_total
//     );

// }

// echo json_encode($return);




?>