<?php
require_once "ValidadorCPF.php";
require_once "ValidadorCNPJ.php";

class Cliente {

	var $nome;
	var $cpf_cnpj;
	var $telefone;
	var $email;
	var $cep;
	var $endereco;
	var $bairro;
	var $numero;
	var $cidade;
	var $uf;

	function __construct(
		$nome,
		$cpf_cnpj,
		$telefone,
		$email,
		$cep,
		$endereco,
		$bairro,
		$numero,
		$cidade,
		$uf
	) {

		//Validação
		if (!$this->cepValidado($cep)) {
			throw new Exception("Cep inválido");
		}

		if (!$this->telefoneValido($telefone)) {
			throw new Exception("Telefone inválido");
		}
		if (!$this->emailValido($email)) {
			throw new Exception("Email inválido");
		}

		$cpf = new ValidadorCPF;
		$cnpj = new ValidadorCNPJ;

		$cpf_cnpj_puro = $cnpj->removeFormatacao($cpf_cnpj);

		if ($tamanho = strlen($cpf_cnpj_puro) == 14) {
			// echo $tamanho;exit;

			if (!$cnpj->ehValido($cpf_cnpj)) {
				throw new Exception("CNPJ inválido");
			}

		} else {
			if (!$cpf->ehValido($cpf_cnpj)) {
				throw new Exception("CPF inválido");
			}

		}

		$this->nome = $nome;
		$this->cpf_cnpj = $this->removeFormatacao($cpf_cnpj);
		$this->telefone = $this->removeFormatacao($telefone);
		$this->email = $email;
		$this->cep = $this->removeFormatacao($cep);
		$this->endereco = $endereco;
		$this->bairro = $bairro;
		$this->numero = $numero;
		$this->cidade = $cidade;
		$this->uf = $uf;
	}

	private function cepValidado($cep) {
		if (strlen($cep) == 10) {
			$regex_cep = "/[0-9]{2}\.[0-9]{3}\-[0-9]{3}/";

			return preg_match($regex_cep, $cep);
		} else {
			return false;
		}

	}
	private function telefoneValido($telefone) {
		if (strlen($telefone) == 15) {
			$regex_telefone = "/\([0-9]{2}\)[0-9]{5}\-[0-9]{4}/";
			return preg_match($regex_telefone, str_replace(" ", "", $telefone));
		} else {
			return false;
		}
	}
	private function emailValido($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}

	public function removeFormatacao($info) {
		$dado = str_replace([".", "/", "(", ")", "-", " "], "", $info);
		return $dado;
	}

}
