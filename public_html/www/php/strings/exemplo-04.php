<?php

$frase = "A repetição é mãe da repetição.";

$palavra = "mãe";

$q = strpos($frase, "mãe");

$texto = substr($frase, 0,strpos($frase, "mãe") );

var_dump($texto);

$texto2 = substr($frase, $q, strlen($frase ) );

var_dump($texto2);

$texto2 = substr($frase, $q + strlen($palavra), strlen($frase ) );

var_dump($texto2);

?>