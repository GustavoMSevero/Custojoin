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
    case 'save conta':

        $codeSubcategory = $data->codeSubcategory; // 1.1.01
        $codeconta = $data->codeconta; // 1.1.01.01
        $conta = $data->conta; // Caixa

        try {
            $saveConta=$pdo->prepare("INSERT INTO conta (idconta, codesubcategoria, codeconta, conta) VALUES(?,?,?,?)");
            $saveConta->bindValue(1, NULL);
            $saveConta->bindValue(2, $codeSubcategory);
            $saveConta->bindValue(3, $codeconta);
            $saveConta->bindValue(4, $conta);
            $saveConta->execute();

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
        break;

    case 'get contas':

        $carregaContas=$pdo->prepare("SELECT * FROM conta");
        $carregaContas->execute();

        $return = array();

        while ($linha=$carregaContas->fetch(PDO::FETCH_ASSOC)) {

            $idconta = $linha['idconta'];
            $codesubcategoria = $linha['codesubcategoria'];
            $codeconta = $linha['codeconta'];
            $conta = $linha['conta'];

            $buscaSubcategoriaDescricao=$pdo->prepare("SELECT * FROM subcategoria WHERE codeSubcategory=:codeSubcategoria");
            $buscaSubcategoriaDescricao->bindValue(":codeSubcategoria", $codesubcategoria);
            $buscaSubcategoriaDescricao->execute();

            while ($linha=$buscaSubcategoriaDescricao->fetch(PDO::FETCH_ASSOC)) {
                $subcategoria = $linha['subcategoria'];
            }

            $return[] = array(
                'idconta'    => $idconta,
                'codesubcategoria'	=> $codesubcategoria,
                'subcategoria'	=> $subcategoria,
                'codeconta'	=> $codeconta,
                'conta'	=> $conta
            );
        }

        echo json_encode($return);

        break;

    // case 'get subcategory to edit':

    //     $idsubcategory = $_GET['idsubcategory'];

    //     $getSubcategoryToEdit=$pdo->prepare("SELECT * FROM subcategoria WHERE idsubcategoria=:idsubcategoria");
    //     $getSubcategoryToEdit->bindValue(":idsubcategoria", $idsubcategory);
    //     $getSubcategoryToEdit->execute();

    //     $return = array();

    //     while ($linha=$getSubcategoryToEdit->fetch(PDO::FETCH_ASSOC)) {

    //         $idsubcategoria = $linha['idsubcategoria'];
    //         $codeCategoria = $linha['codeCategoria'];
    //         $codeSubcategory = $linha['codeSubcategory'];
    //         $subcategoria = $linha['subcategoria'];

    //         $return = array(
    //             'idsubcategory'    => $idsubcategoria,
    //             'codeCategory'	=> $codeCategoria,
    //             'codeSubcategory'	=> $codeSubcategory,
    //             'subcategory'	=> $subcategoria
    //         );
    //     }

    //     echo json_encode($return);

    //     break;

    // case 'update subcategory':

    //     $idsubcategoria = $data->idsubcategory; // 79
    //     $codeCategory = $data->codeCategory; // 1
    //     $codeSubcategory = $data->codeSubcategory; // 1.1.03
    //     $subcategory = $data->subcategory; // Duplicatas a receber

    //     $updateSubcategory=$pdo->prepare("UPDATE subcategoria SET codeCategoria=:codeCategoria, codeSubcategory=:codeSubcategory, 
    //                                         subcategoria=:subcategory WHERE idsubcategoria=:idsubcategoria");
    //     $updateSubcategory->bindValue(":codeCategoria", $codeCategory);
    //     $updateSubcategory->bindValue(":codeSubcategory", $codeSubcategory);
    //     $updateSubcategory->bindValue(":subcategory", $subcategory);
    //     $updateSubcategory->bindValue(":idsubcategoria", $idsubcategoria);
    //     $updateSubcategory->execute();

    //     break;

        default:
            # code...
            break;

}