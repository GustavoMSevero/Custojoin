<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("../adminCJ/con.php");

$pdo = conectar();
    

$data = file_get_contents("php://input");
$data = json_decode($data);

$email = $data->email;
$password = $data->password;


$buscaAdmin=$pdo->prepare("SELECT * FROM adminUser WHERE email=:email AND password=:senha");
$buscaAdmin->bindValue(":email", $email);
$buscaAdmin->bindValue(":senha", $password);
$buscaAdmin->execute();

$return = array();

while ($linhaAdmin=$buscaAdmin->fetch(PDO::FETCH_ASSOC)) {

    $email = $linhaAdmin['email'];
    $status = 1;

    $return = array(
        'email' => $email,
        'status' => $status
    );

}

echo json_encode($return);





?>