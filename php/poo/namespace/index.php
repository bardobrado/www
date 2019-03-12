<?php

require_once("config.php");

use Cliente\Cadastro;

$cad = new Cadastro();

$cad->setNome("Djalma Sindeaux");
$cad->setEmail("djalma@code.com");
$cad->setSenha("00000");

//echo $cad->toString();
$cad->registrarVenda();



?>