<?php


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


?>