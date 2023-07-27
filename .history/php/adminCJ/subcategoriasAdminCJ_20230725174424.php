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
    case 'save subcategory':

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

    case 'get subcategories':

        $carregaSubcategories=$pdo->prepare("SELECT * FROM subcategoria");
        $carregaSubcategories->execute();

        $return = array();

        while ($linha=$carregaSubcategories->fetch(PDO::FETCH_ASSOC)) {

            $idsubcategoria = $linha['idsubcategoria'];
            $codeCategoria = $linha['codeCategoria'];
            $codeSubcategory = $linha['codeSubcategory'];
            $subcategoria = $linha['subcategoria'];

            $buscaCategoriaDescricao=$pdo->prepare("SELECT * FROM categoria WHERE codecategory=:codeCategoria");
            $buscaCategoriaDescricao->bindValue(":codeCategoria", $codeCategoria);
            $buscaCategoriaDescricao->execute();

            while ($linha=$buscaCategoriaDescricao->fetch(PDO::FETCH_ASSOC)) {
                $categoryName = $linha['categoryname'];
            }

            $return[] = array(
                'idsubcategoria'    => $idsubcategoria,
                'codeCategoria'	=> $codeCategoria,
                'categoryName'	=> $categoryName,
                'codeSubcategory'	=> $codeSubcategory,
                'subcategoria'	=> $subcategoria
            );
        }

        echo json_encode($return);

        break;

    case 'get subcategory to edit':

        $idsubcategory = $_GET['idsubcategory'];

        $getSubcategoryToEdit=$pdo->prepare("SELECT * FROM subcategoria WHERE idsubcategoria=:idsubcategoria");
        $getSubcategoryToEdit->bindValue(":idsubcategoria", $idsubcategory);
        $getSubcategoryToEdit->execute();

        $return = array();

        while ($linha=$getSubcategoryToEdit->fetch(PDO::FETCH_ASSOC)) {

            $idsubcategoria = $linha['idsubcategoria'];
            $codeCategoria = $linha['codeCategoria'];
            $codeSubcategory = $linha['codeSubcategory'];
            $subcategoria = $linha['subcategoria'];

            $return = array(
                'idsubcategory'    => $idsubcategoria,
                'codeCategory'	=> $codeCategoria,
                'codeSubcategory'	=> $codeSubcategory,
                'subcategory'	=> $subcategoria
            );
        }

        echo json_encode($return);

        break;

    case 'update subcategory':
        print_r($data);
        $idsubcategoria = $data->idsubcategory; // 79
        $codeCategory = $data->codeCategory; // 1
        $codeSubcategory = $data->codeSubcategory; // 1.1.03
        $subcategory = $data->subcategory; // Duplicatas a receber

        $updateSubcategory=$pdo->prepare("UPDATE subcategoria
                                            SET codeCategoria=:codeCategoria, codeSubcategory=:codeSubcategory, 
                                            subcategoria=:subcategory 
                                            WHERE idsubcategoria=:idsubcategoria");
        $updateSubcategory->bindValue(":codeCategoria", $codeCategory);
        $updateSubcategory->bindValue(":codeSubcategory", $codeSubcategory);
        $updateSubcategory->bindValue(":subcategoria", $subcategory);
        $updateSubcategory->bindValue(":idsubcategoria", $idsubcategoria);
        $updateSubcategory->execute();

        default:
            # code...
            break;

}