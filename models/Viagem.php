
<?php

class Viagem {

	var $origem;
	var $destino;
	var $data_ida;
	var $data_volta;
	var $classe;
	var $adultos;
	var $criancas;
	var $preco;

	function __construct(
		$origem,
		$destino,
		$data_ida,
		$data_volta,
		$classe,
		$adultos,
		$criancas,
		$preco

	) {

		if (!$this->validaData($data_ida)) {
			throw new Exception("Data de ida inválida");
		}

		if (!$this->validaData($data_volta)) {
			throw new Exception("Data de volta inválida");
		}

		if (!$this->validaPreco($preco)) {
			throw new Exception("Preço inválido");
		}

		$this->origem = $origem;
		$this->destino = $destino;
		$this->data_ida = $data_ida;
		$this->data_volta = $data_volta;
		$this->classe = $classe;
		$this->adultos = $adultos;
		$this->criancas = $criancas;
		$this->preco = $this->convertePreco($preco);
	}

	public function validaData($data) {

		if (strlen($data) != 10) {
			return false;
		}

		if (!strpos($data, "-")) {
			return false;
		}

		$partes = explode("-", $data);

		$ano = $partes[0];
		$mes = $partes[1];
		$dia = $partes[2];

		if (strlen($ano) < 4) {
			return false;
		}

		if (!checkdate($mes, $dia, $ano)) {
			return false;
		}

		$data_atual = date("y-m-d");

		if (strtotime(strtotime($data) < $data_atual)) {
			return false;
		}
		return true;

	}
	private function validapreco($preco) {

		$regex_preco = "/^[0-9]{1,3}([.][0-9]{3})*[,][0-9]{2}$/";
		return preg_match($regex_preco, $preco);
	}
	public function convertePreco($preco) {
		$numero = str_replace(",", ".", $preco);
		$numero = str_replace(".", "", substr($numero, 0, -3)) . substr($numero, -3);
		$numero = doubleval($numero);
		return $numero;
	}
}
