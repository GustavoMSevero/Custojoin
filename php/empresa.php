<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("adminCJ/con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$opcao = $data->opcao;

switch ($opcao) {
	case 'cadastrar empresa':

		// print_r($data);
		$nome_empresa = $data->nome;
		$endereco = $data->endereco;
		$telefone = $data->telefone;
		$cidade = $data->cidade;
		$uf = $data->uf;
		$cnpj = $data->cnpj;
		$ie = $data->ie;
		$usuario = $data->usuario;
		$email = $data->email;
		$senha = md5($data->senha);

		$insereEmpresa=$pdo->prepare("INSERT INTO empresa (id, empresa, endereco, telefone, cidade, uf, cnpj, ie, usuario, email, senha)
										VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$insereEmpresa->bindValue(1, NULL);
		$insereEmpresa->bindValue(2, $nome_empresa);
		$insereEmpresa->bindValue(3, $endereco);
		$insereEmpresa->bindValue(4, $telefone);
		$insereEmpresa->bindValue(5, $cidade);
		$insereEmpresa->bindValue(6, $uf);
		$insereEmpresa->bindValue(7, $cnpj);
		$insereEmpresa->bindValue(8, $ie);
		$insereEmpresa->bindValue(9, $usuario);
		$insereEmpresa->bindValue(10, $email);
		$insereEmpresa->bindValue(11, $senha);
		$insereEmpresa->execute();
		$idempresa = $pdo->lastInsertId();

		$return = array(
			'idempresa' => $idempresa,
			'empresa' => $nome_empresa,
			'msg' => "Empresa cadastrada",
			'status' => 1
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

	case 'logar':
		
		// print_r($data);
		$email = $data->email;
		$senha = md5($data->senha);

		$buscaEmpresa=$pdo->prepare("SELECT * FROM empresa WHERE email=:email AND senha=:senha");
		$buscaEmpresa->bindValue("email", $email);
		$buscaEmpresa->bindValue("senha", $senha);
		$buscaEmpresa->execute();

		while ($linha=$buscaEmpresa->fetch(PDO::FETCH_ASSOC)) {
			$id = $linha['id'];
			$empresa = $linha['empresa'];
		}

		$return = array(
			'id' => $id,
			'empresa' => $empresa,
			'status' => 1
		);


		echo json_encode($return);

		break;
	
	default:
		# code...
		break;
}





?>