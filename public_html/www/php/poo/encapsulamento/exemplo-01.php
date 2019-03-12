<?php

class Pessoa {

public $nome = "Rasmus Lerdorf"; // todos tem acesso
protected $idade = 48; // somente herdeiros
private $senha = "12345"; // nem herdeiros

public function verDados() {
    echo $this->nome . "<br/>";
    echo $this->idade . "<br/>";
    echo $this->senha . "<br/>";
}
}

$objeto = new Pessoa();

//echo $objeto->idade. "<br>";

$objeto->verDados();

?>