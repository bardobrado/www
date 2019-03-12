<?php

interface Veiculo {

    public function acelerar($velocidade);
    public function frear($velocidade);
    public function trocarMarcha($marcha);
}

abstract class Automovel  implements Veiculo {

    public function acelerar($velocidade) {
        echo "O veículo acelerou até ". $velocidade . "km/h";
    }

    public function frear($velocidade) {
        echo "O veículo frenou até " . $velocinadade . "km/h";
    }
    
   public function trocarMarcha($marcha) {
       echo "o veículo engatou a marcha " . $marcha;
   }
}

class DelRey extends Automovel {

    public function empurrar() {
        
    }

}

$carro = new DelRey();

//$carro = new Automovel();

$carro->acelerar(200);


?>