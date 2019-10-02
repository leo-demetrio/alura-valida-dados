<?php

class ValidadorCNPJ {

	public function ehValido($cnpj) {

		if (!ValidadorCNPJ::ehCNPJ($cnpj)) {
			return false;
		}

		$somente_numeros = ValidadorCNPJ::removeFormatacao($cnpj);

		if (!ValidadorCNPJ::verificaNumerosIguais($somente_numeros)) {
			return false;
		}

		if (!ValidadorCNPJ::validaDigitos($somente_numeros)) {
			return false;
		}

		return true;

	}

	private function ehCNPJ($cnpj) {
		$regex_cnpj = "/[0-9]{2}\.[0-9]{3}\.[0-9]{3}\/[0-9]{4}\-[0-9]{2}/";
		return preg_match($regex_cnpj, $cnpj);
	}
	public function removeFormatacao($cnpj) {
		$somente_numeros = str_replace([".", "/", "-"], "", $cnpj);
		return $somente_numeros;
	}
	private function verificaNumerosIguais($cnpj_somente_numeros) {
		for ($i = 0; $i <= 14; $i++) {
			if (str_repeat($i, 14) == $cnpj_somente_numeros) {
				return false;
			}
		}

		return true;
	}
	private function validaDigitos($cnpj_somente_numeros) {
		$primeiro_digito = 0;
		$segundo_digito = 0;

		for ($i = 0, $peso = 5; $i <= 11; $i++, $peso--) {
			$peso = ($peso < 2) ? 9 : $peso;
			$primeiro_digito += $cnpj_somente_numeros[$i] * $peso;
		}
		$calculo_um = (($primeiro_digito % 11) < 2) ? 0 : (11 - ($primeiro_digito % 11));

		for ($i = 0, $peso = 6; $i <= 12; $i++, $peso--) {
			$peso = ($peso < 2) ? 9 : $peso;
			$segundo_digito += $cnpj_somente_numeros[$i] * $peso;
		}

		$claculo_dois = (($segundo_digito % 11) < 2) ? 0 : (11 - ($segundo_digito % 11));

		if ($calculo_um != $cnpj_somente_numeros[12] || $claculo_dois != $cnpj_somente_numeros[13]) {
			return false;
		} else {
			return true;
		}

	}

}