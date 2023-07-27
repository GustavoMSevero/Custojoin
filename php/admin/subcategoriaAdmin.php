<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("../con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$categoria = $data->categoria;
$subcategoria = $data->subcategoria;

$insereSubcategoriaAdmin=$pdo->prepare("INSERT INTO subcategoria (idsubcategoria, subcategoria, tipo) 
										VALUES(?, ?, ?)");
$insereSubcategoriaAdmin->bindValue(1,NULL);
$insereSubcategoriaAdmin->bindValue(2,$subcategoria);
$insereSubcategoriaAdmin->bindValue(3,$categoria);

$insereSubcategoriaAdmin->execute();

?>