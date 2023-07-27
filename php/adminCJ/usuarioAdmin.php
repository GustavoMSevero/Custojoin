<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$opcao = $data->opcao;

switch ($opcao) {
	case 'logar':

		$email = $data->email;
		$senha = $data->senha;
		//echo $email.'-'.$senha;

		$buscaAdmin=$pdo->prepare("SELECT * FROM usuarioAdmin WHERE email=:email AND senha=:senha");
		$buscaAdmin->bindValue("email", $email);
		$buscaAdmin->bindValue("senha", $senha);

		$buscaAdmin->execute();

		$return = array();

		while ($linhaAdmin=$buscaAdmin->fetch(PDO::FETCH_ASSOC)) {

			$linhaAdmin['nome'] = $linhaAdmin['nome'];
			$return = $linhaAdmin;

		}

		echo json_encode($return);

		break;

	/*case 'logar':

		$email = $data->email;
		$senha = $data->senha;
		$buscaUsuario=$pdo->prepare("SELECT empresa_idempresa, email, senha, usuario FROM usuario WHERE email=:email AND senha=:senha");

		$buscaUsuario->bindValue("email", $email);
		$buscaUsuario->bindValue("senha", $senha);

		$buscaUsuario->execute();

		$return = array();

		while ($linha=$buscaUsuario->fetch(PDO::FETCH_ASSOC)) {

			$linha['usuario'] = $linha['usuario'];
			$linha['idempresa'] = $linha['empresa_idempresa'];
			$return = $linha;

		}

		$buscaEmpresa=$pdo->prepare("SELECT idempresa, empresa FROM empresa WHERE idempresa=:idempresa");
		$buscaEmpresa->bindValue("idempresa", $return['empresa_idempresa']);
		$buscaEmpresa->execute();

		while ($linhaEmp=$buscaEmpresa->fetch(PDO::FETCH_ASSOC)) {

			$empresa = $linhaEmp['empresa'];
			$return['empresa'] = $empresa;

		}

		
		echo json_encode($return);

		break;
	
	default:
		# code...
		break;*/
}





?>