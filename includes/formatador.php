<?php

function formataCpfCnpj($cpf_cnpj) {
	$formatado = "";

	// echo strlen($cpf_cnpj);exit;
	if (strlen($cpf_cnpj) == 11) {

		$formatado = substr($cpf_cnpj, 0, 3) . ".";
		$formatado .= substr($cpf_cnpj, 3, 3) . " .";
		$formatado .= substr($cpf_cnpj, 6, 3) . "-";
		$formatado .= substr($cpf_cnpj, 9, 2);

	} else {

		$formatado = substr($cpf_cnpj, 0, 2) . ".";
		$formatado .= substr($cpf_cnpj, 2, 3) . ".";
		$formatado .= substr($cpf_cnpj, 5, 3) . "/";
		$formatado .= substr($cpf_cnpj, 8, 4) . "-";
		$formatado .= substr($cpf_cnpj, 12, 2);

	}
	return $formatado;
}

function formataCep($cep) {
	$formatado = "";

	$formatado = substr($cep, 0, 2) . ".";
	$formatado .= substr($cep, 2, 3) . "-";
	$formatado .= substr($cep, 5, 3);

	return $formatado;

}

function formataPreco($preco) {

	$formatado = "R$";
	$formatado .= number_format($preco, 2, ",", ".");
	return $formatado;

}

function formataData($data) {
	$formatado = date("d/m/y", strtotime($data));
	return $formatado;
}

function formataTelefone($telefone) {
	$formatado = "";

	$formatado = "(" . substr($telefone, 0, 2) . ")";
	$formatado .= " " . substr($telefone, 2, -4) . "-";
	$formatado .= substr($telefone, -4);

	return $formatado;

}