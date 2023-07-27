<?php

class contaSaida {

	public $insereDadosSaida;
	public $mostraDadosSaida;

	function conectar(){
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

	function insereContaSaida($id_empresa, $cat, $subcat, $val, $forPag, $data){
		$pdo = conectar();
		$val = floatval(str_replace(',', '.', str_replace('.', '', $val)));

		if($data == ''){
			$data = date("Y-m-d");
		}

		$this->insereDadosSaida=$pdo->prepare(
			"INSERT INTO saida (id_saida, id_empresa, categoria, subcategoria, valor, forma_pagamento, data) 
			 VALUES (?, ?, ?, ?, ?, ?, ?)");
		$this->insereDadosSaida->bindValue(1, NULL);
		$this->insereDadosSaida->bindValue(2, $id_empresa);
		$this->insereDadosSaida->bindValue(3, $cat);
		$this->insereDadosSaida->bindValue(4, $subcat);
		$this->insereDadosSaida->bindValue(5, $val);
		$this->insereDadosSaida->bindValue(6, $forPag);
		$this->insereDadosSaida->bindValue(7, $data);
		//$this->insereDadosSaida->execute();
		try {
			$this->insereDadosSaida->execute();
			echo "Cadastro efetuado com sucesso!";
		} catch (Exception $e) {
			print_r($this->insereDadosSaida->errorInfo());
		}
		/*
		if(!$this->insereDadosSaida->execute()){
		   print_r($this->insereDadosSaida->errorInfo());
		}else{
			echo "Cadastro efetuado com sucesso!";
		}*/
	}

	function exibeContasSaida($id_empresa){
		$pdo = conectar();
		$this->mostraDadosSaida=$pdo->prepare(
			"SELECT c.categoria, sc.subcategoria, data, valor 
			 FROM entrada e 
			 JOIN cat_entradas c 
			 on c.id_categoria = e.categoria 
			 JOIN sub_cat_entrada sc 
			 on sc.id_subcategoria 
			 WHERE id_empresa=:id_empresa 
			 ORDER BY data DESC");
		$this->mostraDadosSaida->bindValue(":id_empresa", $id_empresa);
		$this->mostraDadosSaida->execute();

		while ($r = $this->mostraDadosSaida->fetch(PDO::FETCH_ASSOC)) {
			$dataP = explode("-", $r['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

		    echo $data.'  '.$r['categoria'].'  '.utf8_encode($r['subcategoria']).'  '.number_format($r['valor'],2,',','.')."<br>";
		}
	}
}