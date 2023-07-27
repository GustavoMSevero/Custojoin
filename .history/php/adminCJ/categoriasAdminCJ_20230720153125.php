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
        print_r($data);
        $codeCategoria = $data->categoria; // código contábil categoria 1.1
        $codeSubcategory = $data->codeSubcategory; // código contábil subcategoria 1.1.01
        $subcategoria = $data->subcategoria; // subcategoria Disponível

        try {
            $saveSubcategory=$pdo->prepare("INSERT INTO subcategoria (idsubcategoria, codeCategoria, codeSubcategory, subcategoria) VALUES(?,?,?,?)");
            $saveSubcategory->bindValue(1, NULL);
            $saveSubcategory->bindValue(2, $codeCategoria);
            $saveSubcategory->bindValue(3, $codeSubcategory);
            $saveSubcategory->bindValue(4, $subcategoria);
            $saveSubcategory->execute();

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
        break;
    
    default:
        # code...
        break;
}
