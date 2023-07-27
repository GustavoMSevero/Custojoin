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
                'idcategory'	=> $idcategory,
                'codecategory'	=> $codecategory,
                'categoryname'	=> $categoryname
            );
        }

        echo json_encode($return);

        break;

    case 'get category to edit':

        $idcategory = $_GET['idcategory'];
        
        $carregaCategories=$pdo->prepare("SELECT * FROM categoria WHERE idcategory=:idcategory");
        $carregaCategories->bindValue(":idcategory", $idcategory);
        $carregaCategories->execute();

        $return = array();

        while ($linha=$carregaCategories->fetch(PDO::FETCH_ASSOC)) {

            $idcategory = $linha['idcategory'];
            $codegroup = $linha['codegroup'];
            $codecategory = $linha['codecategory'];
            $categoryname = $linha['categoryname'];

            $return = array(
                'idcategory'    => $idcategory,
                'codegroup'	=> $codegroup,
                'codecategory'	=> $codecategory,
                'categoryname'	=> $categoryname
            );
        }

        echo json_encode($return);

        break;

    case 'update category':

        $idcategory = $data->idcategory;
        $codegroup = $data->codegroup;
        $codecategory = $data->codecategory;
        $categoryname = $data->categoryname;

        // echo $idcategory.'-'.$codegroup.'-'.$codecategory.'-'.$categoryname;

        try {
            //code...
            $updateCategory=$pdo->prepare("UPDATE categoria SET codegroup=:codegroup, codecategory=:codecategory, categoryname=:categoryname 
                                            WHERE idcategory=:idcategory");
            $updateCategory->bindValue(":codegroup", $codegroup);
            $updateCategory->bindValue(":codecategory", $codecategory);
            $updateCategory->bindValue(":categoryname", $categoryname);
            $updateCategory->bindValue(":idcategory", $idcategory);
            $updateCategory->execute();

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        

        break;
    
    default:
        # code...
        break;
}
