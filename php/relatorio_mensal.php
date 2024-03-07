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

// $mes = (int)$mes;

$checaSeExiste=$pdo->prepare("SELECT *
                                FROM relatorios
                                WHERE idempresa=:idempresa
                                AND mes=:mes
                                AND ano=:ano");
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

    // NOVO mes sendo 01
    // ("INSERT INTO relatorioss (idempresa, descricao, codigo, valor, ano, mes)
    // SELECT idempresa, descricao, codigo, sum(valor), DATE_FORMAT(data, '%Y'), DATE_FORMAT(data, '%m')
    // FROM conta_importada 
    // WHERE descricao in (SELECT DISTINCT descricao  FROM conta_importada WHERE idempresa=:idempresa)
    // and idempresa=:idempresa
    // GROUP BY descricao, codigo, DATE_FORMAT(data, '%Y'), DATE_FORMAT(data, '%m')
    // order by descricao, DATE_FORMAT(data, '%Y'), DATE_FORMAT(data, '%m')");

    // NOVO mes sendo 1
    // insert into relatorioss (idempresa, descricao, codigo, valor, ano, mes)
    // select idempresa, descricao, codigo, sum(valor), YEAR(data), MONTH(data)
    // from conta_importada 
    // where descricao in (SELECT DISTINCT descricao  FROM conta_importada WHERE idempresa = 12)
    // and idempresa = 12
    // group by descricao, codigo, year(data), MONTH(data)
    // order by descricao, year(data), month(data);
    
    $relatorioMensal=$pdo->prepare("INSERT INTO relatorios (idempresa, descricao, codigo, valor, ano, mes)
                                    SELECT idempresa, descricao, codigo, sum(valor), YEAR(data), MONTH(data) 
                                    FROM conta_importada 
                                    WHERE descricao in (SELECT DISTINCT descricao  FROM conta_importada WHERE idempresa=:idempresa)
                                    and idempresa=:idempresa
                                    GROUP BY descricao, codigo, year(data), MONTH(data)
                                    order by descricao, year(data), month(data)");
    $relatorioMensal->bindValue(":idempresa", $idempresa);
    $relatorioMensal->execute();

    $return = array(
        'mes'	=> $mes,
        'ano'	=> $ano
    );

    echo json_encode($return);
}

?>