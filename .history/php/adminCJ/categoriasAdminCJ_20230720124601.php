<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);


if($data){
	$option = $data->option;
}else{
	$option = $_GET['option'];
}

switch ($option) {
    case 'save':

        $group = $data->group;
        $code = $data->code;

        try {
            $saveGroup=$pdo->prepare("INSERT INTO grupo (idgroup, codegroup, groupname) VALUES(?,?,?)");
            $saveGroup->bindValue(1, NULL);
            $saveGroup->bindValue(2, $code);
            $saveGroup->bindValue(3, $group);
            $saveGroup->execute();

            break;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    case 'get categories':
        $carregaGrupos=$pdo->prepare("SELECT * FROM grupo");
        $carregaGrupos->execute();

        $return = array();

        while ($linha=$carregaGrupos->fetch(PDO::FETCH_ASSOC)) {

            $idgroup = $linha['idgroup'];
            $codegroup = $linha['codegroup'];
            $groupname = $linha['groupname'];

            $return[] = array(
                'idgroup'	=> $linha['idgroup'],
                'codegroup'	=> $linha['codegroup'],
                'groupname'	=> $linha['groupname']
            );
        }

        echo json_encode($return);
        break;
    
    default:
        # code...
        break;
}
