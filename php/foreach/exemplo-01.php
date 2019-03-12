<?php

$meses = array (
    "Janeiro", "Fevereiro", "Março",
    "Abril", "Maio", "Junho",
    "Julho", "Agosto", "Setembro",
    "Outubro", "Novembro", "Dezembro"
);

foreach ($meses as $mes) {
    echo "O mês é ". $mes . "<br>";
}


foreach ($meses as $index => $mes) {
    echo "Indice: " . $index . "<br>";
    echo "O mês é ". $mes . "<br>";
}