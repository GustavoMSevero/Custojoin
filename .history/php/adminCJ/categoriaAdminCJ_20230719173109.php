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
    case 'save category':
        // print_r($data);
        $group = $data->group;
        $codecategory = $data->codecategory;
        $categoryname = $data->categoryname;

        $getGroupName=$pdo->prepare("SELECT groupname FROM grupo WHERE codegroup=:group");
        $getGroupName->bindValue(":group", $group);
        $getGroupName->execute();

        $saveCategory=$pdo->prepare("INSERT INTO category (idcategory, codegroup, codecategory, categoryname) VALUES(?,?,?,?)");
        $saveCategory->bindValue(1, NULL);
        $saveCategory->bindValue(2, $group);
        $saveCategory->bindValue(3, $codecategory);
        $saveCategory->bindValue(4, $categoryname);
        $saveCategory->execute();


        break;

    case 'get categories':

        $getCategories=$pdo->prepare("SELECT * FROM category");
        $getCategories->execute();

        while ($linha=$getCategories->fetch(PDO::FETCH_ASSOC)) {

            $idcategory = $linha['idcategory'];
            $codegroup = $linha['codegroup'];
            $codecategory = $linha['codecategory'];
            $categoryname = $linha['categoryname'];

            $getGroupName=$pdo->prepare("SELECT groupname FROM grupo WHERE codegroup=:group");
            $getGroupName->bindValue(":group", $codegroup);
            $getGroupName->execute();

            while ($linha=$getGroupName->fetch(PDO::FETCH_ASSOC)) {
                    $groupname = $linha['groupname'];
            }

            $return[] = array(
                'idcategory'   => $idcategory,
                'codegroup'	=> $codegroup,
                'groupname'	=> $groupname,
                'codecategory'	=> $codecategory,
                'categoryname'	=> $categoryname
            );
        }

        echo json_encode($return);

        break;
    
    default:
        # code...
        break;
}
