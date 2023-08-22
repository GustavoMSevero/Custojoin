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
        
        $carregaCategoria=$pdo->prepare("SELECT * FROM categoria");
        $carregaCategoria->execute();

        $return = array();

        while ($linha=$carregaCategoria->fetch(PDO::FETCH_ASSOC)) {

            $idcategory = $linha['idcategory'];
            $codegroup = $linha['codegroup'];
            $codecategory = $linha['codecategory'];
            $categoryname = $linha['categoryname'];

            $buscaGrupo=$pdo->prepare("SELECT groupname FROM grupo WHERE codegroup=:codegroup");
            $buscaGrupo->bindValue(":codegroup", $codegroup);
            $buscaGrupo->execute();

            while ($linha=$buscaGrupo->fetch(PDO::FETCH_ASSOC)) {
                $groupname = $linha['groupname'];
            }

            $return[] = array(
                'idcategory'	=> $idcategory,
                'codegroup'	=> $codegroup,
                'groupname'	=> $groupname,
                'codecategory'	=> $codecategory,
                'categoryname'	=> $categoryname
            );
        }

        echo json_encode($return);

        break;

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
