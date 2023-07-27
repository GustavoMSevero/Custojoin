<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

//print_r($data);

$opcao = $data->opcao;


switch ($opcao) {
	case 'cadUsuario':

		$email = $data->email;
		$senha = $data->senha;
		$nome = $data->nome;
		$usuario = $data->user;
		$idempresa = $data->idempresa;

		$insereUsuario=$pdo->prepare("INSERT INTO usuario (idusuario, usuario, senha, email, empresa_idempresa, nome)
									 VALUES (?, ?, ?, ?, ?, ?)");
		$insereUsuario->bindValue(1, NULL);
		$insereUsuario->bindValue(2, $usuario);
		$insereUsuario->bindValue(3, $senha);
		$insereUsuario->bindValue(4, $email);
		$insereUsuario->bindValue(5, $idempresa);
		$insereUsuario->bindValue(6, $nome);

		$insereUsuario->execute();

		$idusuario = $pdo->lastInsertId();

		$buscaUsuario=$pdo->prepare("SELECT empresa_idempresa, email, senha, usuario FROM usuario WHERE email=:email AND senha=:senha");

		$buscaUsuario->bindValue("email", $email);
		$buscaUsuario->bindValue("senha", $senha);

		$buscaUsuario->execute();

		$return = array();

		while ($linha=$buscaUsuario->fetch(PDO::FETCH_ASSOC)) {

		//$linha['usuario'] = $linha['usuario'];
		$usuario = $linha['usuario'];
		//$linha['idempresa'] = $linha['empresa_idempresa'];
		$idempresa = $linha['empresa_idempresa'];
		//$return = $linha;

		$buscaEmpresa=$pdo->prepare("SELECT idempresa, empresa FROM empresa WHERE idempresa=:idempresa");
		$buscaEmpresa->bindValue("idempresa", $idempresa);
		$buscaEmpresa->execute();

				while ($linhaEmp=$buscaEmpresa->fetch(PDO::FETCH_ASSOC)) {

					$empresa = $linhaEmp['empresa'];

					$return = array(
						'empresa'	=> $empresa,
						'usuario'	=> $usuario,
						'idempresa'	=> $idempresa,
						'idusuario' => $idusuario
					);

				}

		}
		//print_r($return);
		echo json_encode($return);

		break;

	case 'logar':

		$email = $data->email;
		$senha = $data->senha;

		$buscaUsuario=$pdo->prepare("SELECT * FROM usuario WHERE email=:email AND senha=:senha");

		$buscaUsuario->bindValue("email", $email);
		$buscaUsuario->bindValue("senha", $senha);

		$buscaUsuario->execute();

		$return = array();

		while ($linha=$buscaUsuario->fetch(PDO::FETCH_ASSOC)) {

		$usuario = $linha['usuario'];
		$idusuario = $linha['idusuario'];
		$idempresa = $linha['empresa_idempresa'];

		$buscaEmpresa=$pdo->prepare("SELECT idempresa, empresa FROM empresa WHERE idempresa=:idempresa");
		$buscaEmpresa->bindValue("idempresa", $idempresa);
		$buscaEmpresa->execute();

				while ($linhaEmp=$buscaEmpresa->fetch(PDO::FETCH_ASSOC)) {

					$empresa = $linhaEmp['empresa'];

					$linha['usuario'] = $usuario;
					$linha['empresa'] = $empresa;
					$linha['idempresa'] = $idempresa;

					$return = $linha;

				}

		}

		//print_r($return);
		echo json_encode($return);

		break;

	case 'atualizarUsuario':

		$email = $data->email;
		$nome = $data->nome;
		$usuario = $data->usuario;
		$senha = $data->senha;
		$idusuario = $data->idusuario;

		$atualizarUsuario=$pdo->prepare("UPDATE usuario SET usuario=:usuario, senha=:senha, email=:email, nome=:nome 
										WHERE idusuario=:idusuario");

		$atualizarUsuario->bindValue(":email", $email);
		$atualizarUsuario->bindValue(":nome", $nome);
		$atualizarUsuario->bindValue(":usuario", $usuario);
		$atualizarUsuario->bindValue(":senha", $senha);
		$atualizarUsuario->bindValue(":idusuario", $idusuario);

		$atualizarUsuario->execute();

		$return = array();

		$return[] = array(
				'usuario'	=> $usuario,
				'msgAtualizadoSucesso'	=> "Usuário atualizado com sucesso!",
				'status'	=> 200
			);

		//print($return);
		echo json_encode($return);

		break;
	
	default:
		# code...
		break;
}




?>