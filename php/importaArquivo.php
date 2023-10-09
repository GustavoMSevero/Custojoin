<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

header("Access-Control-Allow-Methods", "POST, PUT, OPTIONS");
header("Access-Control-Allow-Origin", "*.*");
header("Access-Control-Allow-Headers", "Content-Type");

include_once("adminCJ/con.php");

$pdo = conectar();

include_once("PHPExcel/Classes/PHPExcel.php");

$uploadDir = "uploadFile/";
$idempresa = $_GET['idempresa'];

$uploadfile = $uploadDir . $_FILES['file_xls']['name'];


if(move_uploaded_file($_FILES['file_xls']['tmp_name'], $uploadfile)) {
  echo "Dados pegos com sucesso.";
}else{
  echo "Não foi possível pegar arquivo";
}



//Consulta a tabela para saber se já tem dados nela
$pegaDados=$pdo->prepare("SELECT * FROM dadosImportados");
$pegaDados->execute();
$qtd = $pegaDados->rowCount();

if($qtd > 0){ // se tiver dados, apaga tudo
  $qryZera=$pdo->prepare("DELETE FROM dadosImportados");
  $qryZera->execute();
}

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load($uploadfile);

$sheet = $objPHPExcel->getActiveSheet();

foreach ($sheet->rangeToArray($sheet->calculateWorksheetDataDimension()) as $row) {
  // echo 'Data '.$row[0]." Tipo ".$row[1]."  Valor ".$row[2]." Descriçao ".$row[3]."<br>";
  // var_dump($row[0]);
  echo $row[0];
  // $rowP = explode("-", $row[0]);
  // $rowData = $rowP[1].'-'.$rowP[0].'-'.$rowP[2];

  // $qryInsert=$pdo->prepare("INSERT INTO dadosImportados (id_empresa, data, tipo, valor, descricao) VALUES(?,?,?,?,?)"); // prepara para insere os dados não formatados para a tabela dadosImportados
  //  // prepara para inserir os dados não formatados para a tabela dadosImportados
  // $qryInsert->bindValue(1, $idempresa);
  // $qryInsert->bindValue(2, $rowData);
  // $qryInsert->bindValue(3, $row[1]);
  // $qryInsert->bindValue(4, $row[2]);
  // $qryInsert->bindValue(5, $row[3]);
  // $qryInsert->execute();

}

// $buscaDadosImportados=$pdo->prepare("SELECT * FROM dadosImportados WHERE id_empresa=:idempresa");
// $buscaDadosImportados->bindValue("idempresa", $idempresa);
// $buscaDadosImportados->execute();

// while ($linha=$buscaDadosImportados->fetch(PDO::FETCH_ASSOC)) {
//       $id_dado = $linha['id_dado'];
//       $id_empresa = $linha['id_empresa'];
//       $data = $linha['data'];
//       $tipo = $linha['tipo'];
//       $valor = $linha['valor'];
//       $descricao = $linha['descricao'];
//       $idsubcategoria = 0;

//       $dataP = explode('-', $data);
//   		$data = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];

//       $valor = floatval(str_replace(',', '.', str_replace('.', '', $valor)));

//       $insere=$pdo->prepare("INSERT INTO importa (id_dado, id_empresa, data, tipo, valor, descricao, idsubcategoria) VALUES (?,?,?,?,?,?,?)");
//       $insere->bindValue(1, $id_dado);
//       $insere->bindValue(2, $id_empresa);
//       $insere->bindValue(3, $data);
//       $insere->bindValue(4, $tipo);
//       $insere->bindValue(5, $valor);
//       $insere->bindValue(6, $descricao);
//       $insere->bindValue(7, $idsubcategoria);
//       $insere->execute();

// }


?>
