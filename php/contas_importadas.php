<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("adminCJ/con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];

// $data = file_get_contents("php://input");
// $data = json_decode($data);

// if($data){
// 	$option = $data->option;
// }else{
// 	$option = $_GET['option'];
// }

$pegarContasImportadas=$pdo->prepare("SELECT * FROM conta_importada WHERE idempresa=:idempresa");
$pegarContasImportadas->bindValue(":idempresa", $idempresa);
$pegarContasImportadas->execute();

while ($linha=$pegarContasImportadas->fetch(PDO::FETCH_ASSOC)) {

    $dataP = explode('-', $linha['data']);
    $data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

    $return[] = array(
        'idconta'	=> $linha['idconta'],
        'data'	=>  $data,
        'codigo'	=> $linha['codigo'],
        'tipo'	=> $linha['tipo'],
        'valor'	=> $linha['valor'],
        'descricao'	=> utf8_encode($linha['descricao']),
    );

}

echo json_encode($return);



?>