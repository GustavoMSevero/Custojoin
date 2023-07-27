<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

class contaEntrada {

	public $insereDadosEntrada;
	public $id_empresa;
	public $cat;
	public $subcat;
	public $val;
	public $forPag;
	public $data;

	function conectar() {
		$host = "localhost";
		$user = "root";
		$pass = "root";
		$dbname = "fluxo_de_caixa";
		
		try {
			$opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$pdo = new PDO("mysql:host=localhost;dbname=fluxo_de_caixa;", "root", "root", $opcoes);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return $pdo;
	}

	function insereContaEntrada($id_empresa, $cat, $subcat, $val, $forPag, $data) {
		$pdo = $this->conectar();
		$val = floatval(str_replace(',', '.', str_replace('.', '', $val)));

		if($data == ""){
			$data = date("Y-m-d");
		}

		$this->insereDadosEntrada=$pdo->prepare(
			"INSERT INTO entrada (id_entrada, id_empresa, categoria, subcategoria, valor, forma_pagamento, data) 
			 VALUES (?, ?, ?, ?, ?, ?, ?)");
		$this->insereDadosEntrada->bindValue(1, NULL);
		$this->insereDadosEntrada->bindValue(2, $id_empresa);
		$this->insereDadosEntrada->bindValue(3, $cat);
		$this->insereDadosEntrada->bindValue(4, $subcat);
		$this->insereDadosEntrada->bindValue(5, $val);
		$this->insereDadosEntrada->bindValue(6, $forPag);
		$this->insereDadosEntrada->bindValue(7, $data);
		$this->insereDadosEntrada->execute();
	}

	/*function insereContaEntrada($id_empresa, $cat, $subcat, $val, $forPag, $data){
		$pdo = conectar();
		$val = floatval(str_replace(',', '.', str_replace('.', '', $val)));

		if($data == ''){
			$data = date("Y-m-d");
		}

		$this->insereDadosEntrada=$pdo->prepare(
			"INSERT INTO entrada (id_entrada, id_empresa, categoria, subcategoria, valor, forma_pagamento, data) 
			 VALUES (?, ?, ?, ?, ?, ?, ?)");
		$this->insereDadosEntrada->bindValue(1, NULL);
		$this->insereDadosEntrada->bindValue(2, $id_empresa);
		$this->insereDadosEntrada->bindValue(3, $cat);
		$this->insereDadosEntrada->bindValue(4, $subcat);
		$this->insereDadosEntrada->bindValue(5, $val);
		$this->insereDadosEntrada->bindValue(6, $forPag);
		$this->insereDadosEntrada->bindValue(7, $data);
		//$this->insereDadosEntrada->execute();
		try {
			$this->insereDadosEntrada->execute();
			echo "Cadastro efetuado com sucesso!";
		} catch (Exception $e) {
			print_r($e);
			//print_r($this->insereDadosEntrada->errorInfo());
		}

	}*/


}

$entrada = new contaEntrada;

$entrada->insereContaEntrada(1, 1, 1, 1111.11, "Dinheiro", "");
