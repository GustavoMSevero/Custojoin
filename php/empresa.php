<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);


$opcao = $data->opcao;

switch ($opcao) {
	case 'cadEmpresa':

		$empresa = $data->nome;
		$endereco = $data->endereco;
		$telefone = $data->telefone;
		$cidade = $data->cidade;
		$estado = $data->estado;
		$cnpj = $data->cnpj;
		$iestadual = $data->iestadual;

		$empresa = utf8_decode($empresa);
		$endereco = utf8_decode($endereco);
		$cidade = utf8_decode($cidade);

		$insereEmpresa=$pdo->prepare("INSERT INTO empresa (idempresa, empresa, cnpj, endereco, telefone, iestadual, cidade, uf) 
									  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$insereEmpresa->bindValue(1, NULL);
		$insereEmpresa->bindValue(2, $empresa);
		$insereEmpresa->bindValue(3, $cnpj);
		$insereEmpresa->bindValue(4, $endereco);
		$insereEmpresa->bindValue(5, $telefone);
		$insereEmpresa->bindValue(6, $iestadual);
		$insereEmpresa->bindValue(7, $cidade);
		$insereEmpresa->bindValue(8, $estado);
		$insereEmpresa->execute();
		$idempresa = $pdo->lastInsertId();

		$return = array(
			'idempresa' => $idempresa,
			'empresa' => $empresa,
			'status' => "Empresa cadastrada"
		);

		echo json_encode($return);

		break;

	case 'atualizarEmpresa':
		
		$idempresa = $data->idempresa;
		$empresa = $data->empresa;
		$endereco = $data->endereco;
		$telefone = $data->telefone;
		$cidade = $data->cidade;
		$estado = $data->estado;
		$cnpj = $data->cnpj;
		$iestadual = $data->iestadual;

		$empresa = utf8_decode($empresa);
		$endereco = utf8_decode($endereco);
		$cidade = utf8_decode($cidade);

		$atualizarEmpresa=$pdo->prepare("UPDATE empresa SET empresa=:empresa, cnpj=:cnpj, endereco=:endereco, iestadual=:iestadual, cidade=:cidade, uf=:uf, telefone=:telefone WHERE idempresa=:idempresa");

		$atualizarEmpresa->bindValue(":empresa", $empresa);
		$atualizarEmpresa->bindValue(":cnpj", $cnpj);
		$atualizarEmpresa->bindValue(":endereco", $endereco);
		$atualizarEmpresa->bindValue(":telefone", $telefone);
		$atualizarEmpresa->bindValue(":iestadual", $iestadual);
		$atualizarEmpresa->bindValue(":cidade", $cidade);
		$atualizarEmpresa->bindValue("uf", $estado);
		$atualizarEmpresa->bindValue(":telefone", $telefone);
		$atualizarEmpresa->bindValue(":idempresa", $idempresa);

		$atualizarEmpresa->execute();

		$return = array(
			'empresa' => $empresa,
			'msgAtualEmpresaSucesso' => "Empresa atualizada com sucesso"
		);

		echo json_encode($return);

		break;
	
	default:
		# code...
		break;
}





?>