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

class Programador extends Pessoa {

    public function verDados() {

        echo get_class($this) . "<br>";

        echo $this->nome . "<br/>";
        echo $this->idade . "<br/>";
        echo $this->senha . "<br/>";
    }

}

$objeto = new Programador();

//echo $objeto->idade. "<br>";

$objeto->verDados();

?>