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
    case 'get categories':
        
        $carregaGrupos=$pdo->prepare("SELECT * FROM categoria");
        $carregaGrupos->execute();

        $return = array();

        while ($linha=$carregaGrupos->fetch(PDO::FETCH_ASSOC)) {

            $idcategory = $linha['idcategory'];
            $codecategory = $linha['codecategory'];
            $categoryname = $linha['categoryname'];

            $return[] = array(
                'idcategory'	=> $linha['idcategory'],
                'codecategory'	=> $linha['codecategory'],
                'categoryname'	=> $linha['categoryname']
            );
        }

        echo json_encode($return);

        break;

    case 'save subcategory':

        $codeCategoria = $data->categoria; // código categoria
        $codeSubcategory = $data->codeSubcategory; // código subcategoria
        $subcategoria = $data->subcategoria; //categoria

        try {
            $saveGroup=$pdo->prepare("INSERT INTO subcategoria (idsubcategoria, idcategoria, codeSubcategory, subcategoria) VALUES(?,?,?,?)");
            $saveGroup->bindValue(1, NULL);
            $saveGroup->bindValue(2, $code);
            $saveGroup->bindValue(3, $codeSubcategory);
            $saveGroup->bindValue(4, $group);
            $saveGroup->execute();

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
        break;
    
    default:
        # code...
        break;
}
