<?php

abstract class Animal {

    public function fala() {

        return "Som";
    }
    
    public function mover() {

        return "Anda";
    }
}

class Cachorro extends Animal {

    public function falar() {
        
        return "Late";
    }
}

class Gato extends Animal {

    public function falar() {
        return "Mia";
    }
}

class Passaro extends Animal {

    public function falar() {

        return "Canta";
    }

    public function mover() {
        return "Voa e " . parent::mover();
    }
}

$pluto = new Cachorro();

echo $pluto->falar()."<br>". $pluto->mover()."<br>";

$joe = new Gato();

echo $joe->falar()."<br>". $joe->mover()."<br>";

$papa = new Passaro();

echo $papa->falar()."<br>".$papa->mover()."<br>";

?>