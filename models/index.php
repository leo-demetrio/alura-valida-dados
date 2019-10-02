<?php
require_once "ValidadorCNPJ.php";

$valor = "0123456789";
$valor = $valor[strlen($valor) - 1];
// $valorr = substr($valor, 0, 5);
echo $valor;

$cnpj = new ValidadorCNPJ;

$numero = 12345678000195;

$result = $cnpj->ehValido($numero);
echo $result;

// $result = $cnpj->validaDigitos($numero);
// echo $result;