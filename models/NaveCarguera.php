<?php
class NaveCarguera extends Nave
{
    protected $tipoCarga;

    protected $capacidadDeCarga;


    public function __construct($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros,$puntosDeCasco,$cylonSospechoso,$tipoCarga,$capacidadDeCarga)
    {
       
        parent :: __construct($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros,$puntosDeCasco,$cylonSospechoso);
        $this->tipoCarga = $tipoCarga;
        $this->capacidadDeCarga = $capacidadDeCarga;

    }   

    public function getTipoCarga()
    {
        return $this->tipoCarga;
    }
    public function getCapacidadDeCarga()
    {
        return $this->capacidadDeCarga;
    }
        public function setTipoCarga($tipoCarga)
    {
        $this->tipoCarga = $tipoCarga;
    }
    public function setCapacidadDeCarga($capacidadDeCarga)
    {
        $this->capacidadDeCarga = $capacidadDeCarga;
    }
    
public function recibirAtaque($impactos)//Principio open/closed (en principio hace lo mismo que Nave, pero si quiero puedo modificarlo para aumentar el daño)
{
    $this->puntosDeCasco = $this->puntosDeCasco - ($impactos * 1);
    if ($this->puntosDeCasco < 0) $this->puntosDeCasco = 0;
    if ($this->puntosDeCasco > 90) {
        $this->estado = 'Activa';
    } elseif ($this->puntosDeCasco > 0) {
        $this->estado = 'Dañada';
    } else {
        $this->estado = 'Destruida';
    }
    return $this->puntosDeCasco;
}

    }


?>