<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("adminCJ/con.php");

$pdo = conectar();

@$idempresa = $_GET['idempresa'];

$data = file_get_contents("php://input");
$data = json_decode($data);

if($data){
	$opcao = $data->opcao;
}else{
	$opcao = $_GET['opcao'];
}

switch ($opcao) {
    case 'pegar contas importadas':

        $pegarContasImportadas=$pdo->prepare("SELECT * FROM conta_importada WHERE idempresa=:idempresa");
        $pegarContasImportadas->bindValue(":idempresa", $idempresa);
        $pegarContasImportadas->execute();

        while ($linha=$pegarContasImportadas->fetch(PDO::FETCH_ASSOC)) {

            $dataP = explode('-', $linha['data']);
            $valor = $linha['valor'];
            $data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

            $valor = number_format($valor,2,",",".");

            $return[] = array(
                'idconta'	=> $linha['idconta'],
                'data'	=>  $data,
                'codigo'	=> $linha['codigo'],
                'tipo'	=> $linha['tipo'],
                'valor'	=> $valor,
                'descricao'	=> mb_convert_encoding($linha['descricao'], 'UTF-8', 'ISO-8859-1')
            );

        }

        echo json_encode($return);

        break;

    case 'pegar conta importada':
        $idconta = $_GET['idconta'];
    
        $pegarContaImportada=$pdo->prepare("SELECT * FROM conta_importada WHERE idempresa=:idempresa AND idconta=:idconta");
        $pegarContaImportada->bindValue(":idempresa", $idempresa);
        $pegarContaImportada->bindValue(":idconta", $idconta);
        $pegarContaImportada->execute();

        while ($linha=$pegarContaImportada->fetch(PDO::FETCH_ASSOC)) {

            $dataP = explode('-', $linha['data']);
            $valor = $linha['valor'];
            $data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

            $valor = number_format($valor,2,",",".");

            $return = array(
                'idconta'	=> $linha['idconta'],
                'data'	=>  $data,
                'codigo'	=> $linha['codigo'],
                'tipo'	=> $linha['tipo'],
                'valor'	=> $valor,
                'descricao'	=> mb_convert_encoding($linha['descricao'], 'UTF-8', 'ISO-8859-1')
            );

        }

        echo json_encode($return);

        break;

    case 'atualizar conta importada':
        $idconta = $data->idconta;
        $dataConta = $data->data;
        $codigo = $data->codigo;
        $tipo = $data->tipo;
        $valor = $data->valor;
        $descricao = $data->descricao;
        $idempresa = $data->idempresa;

        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $valor);

        $dataContaP = explode('/',$dataConta);
        $dataConta = $dataContaP[2]."/".$dataContaP[1]."/".$dataContaP[0];

        // echo $idempresa." ".$descricao." ".$codigo." ".$tipo." ".$valor." ".$dataConta." ".$idconta;
        try {
            $atualizarDados=$pdo->prepare("UPDATE conta_importada SET data=:data, codigo=:codigo, tipo=:tipo, valor=:valor, descricao=:descricao
                                    WHERE idconta=:idconta AND idempresa=:idempresa");
            $atualizarDados->bindValue(":data", $dataConta);
            $atualizarDados->bindValue(":codigo", $codigo);
            $atualizarDados->bindValue(":tipo", $tipo);
            $atualizarDados->bindValue(":valor", $valor);
            $atualizarDados->bindValue(":descricao", $descricao);
            $atualizarDados->bindValue(":idconta", $idconta);
            $atualizarDados->bindValue(":idempresa", $idempresa);
            $atualizarDados->execute();

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage();
        }

        break;
    
    default:
        # code...
        break;
}



?>