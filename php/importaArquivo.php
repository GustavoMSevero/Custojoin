<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

header("Access-Control-Allow-Methods", "POST, PUT, OPTIONS");
header("Access-Control-Allow-Origin", "*.*");
header("Access-Control-Allow-Headers", "Content-Type");

include_once("adminCJ/con.php");
include_once("lib/SimpleXLSX.php");

use Shuchkin\SimpleXLSX;

$pdo = conectar();

$uploadDir = "uploadFile/";
$idempresa = $_GET['idempresa'];

if (
  !isset($_FILES['file_xls']['tmp_name'])
) {
  echo 'No file selected';
  die();
}

$uploadfile = $uploadDir . $_FILES['file_xls']['name'];

$allReadyImported = false;

if(move_uploaded_file($_FILES['file_xls']['tmp_name'], $uploadfile)) {
  if ( $xlsx = SimpleXLSX::parse($uploadfile) ) {
    // var_dump( $xlsx->rows() );
    // echo $xlsx->rows()[1][0]." ";
    foreach ($xlsx->rows() as $row) {
      $rowP = explode(" ", $row[0]);
      // echo $idempresa." ";
      // echo $rowP[0]." "; data
      // echo $row[1]." "; codigo
      // echo $row[2]." "; tipo
      // echo $row[3]." "; valor
      // echo $row[4]." "; descricao

      $checkIfExists=$pdo->prepare("SELECT * FROM conta_importada 
                                  WHERE idempresa=:idempresa 
                                  AND data=:data 
                                  AND codigo=:codigo 
                                  AND tipo=:tipo 
                                  AND valor=:valor 
                                  AND descricao=:descricao
                                  ");
      $checkIfExists->bindValue(":idempresa", $idempresa);
      $checkIfExists->bindValue(":data", $rowP[0]);
      $checkIfExists->bindValue(":codigo", $row[1]);
      $checkIfExists->bindValue(":tipo", $row[2]);
      $checkIfExists->bindValue(":valor", $row[3]);
      $checkIfExists->bindValue(":descricao", $row[4]);
      $checkIfExists->execute();
      $numRows = $checkIfExists->rowCount();

      if ($numRows > 0) {
        // echo "Dados já importados";
        $allReadyImported = true;
  
      } else {
        $insert=$pdo->prepare("INSERT INTO conta_importada (idconta, idempresa, data, codigo, tipo, valor, descricao) VALUES(?,?,?,?,?,?,?)");
        $insert->bindValue(1, NULL);
        $insert->bindValue(2, $idempresa);
        $insert->bindValue(3, $rowP[0]);
        $insert->bindValue(4, $row[1]);
        $insert->bindValue(5, $row[2]);
        $insert->bindValue(6, $row[3]);
        $insert->bindValue(7, $row[4]);
        $insert->execute();
      }
      
    }

    if ($allReadyImported == true) {

        $message = "Dados ja importados";

        $return = array(
          'message' => $message
        );
        
        echo json_encode($return);
    }
  } else {
    echo SimpleXLSX::parseError();
  }
}else{
  echo "Não foi possível pegar arquivo";
}


?>
