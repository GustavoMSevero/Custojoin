<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

class contaEntrada {

	public $insereDadosEntrada;
	public $mostraDadosEntrada;

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

	function mostraContasEntrada($id_empresa){ 
		$pdo = $this->conectar(); 
		$this->mostraDadosEntrada=$pdo->prepare( 
			"SELECT c.categoria, sc.subcategoria, data, valor, forma_pagamento
			FROM entrada e 
			JOIN cat_entradas c 
			on c.id_categoria = e.categoria 
			JOIN sub_cat_entrada sc 
			on sc.id_subcategoria 
			WHERE id_empresa=:id_empresa 
			ORDER BY data DESC"); 
		$this->mostraDadosEntrada->bindValue(":id_empresa", $id_empresa); 
		$this->mostraDadosEntrada->execute(); 

		$return = array(); 

		while ($r = $this->mostraDadosEntrada->fetch(PDO::FETCH_ASSOC)) { 

			$dataP = explode("-", $r['data']); 
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0]; 

			$r['data'] = $data; 
			$r['categoria'] = utf8_encode($r['categoria']); 
			$r['subcategoria'] = utf8_encode($r['subcategoria']); 
			$r['valor'] = number_format($r['valor'],2,',','.'); 
			$r['forma_pagamento'];
			$return[] = $r; 
		} 

		echo json_encode($return); 
	}


}
