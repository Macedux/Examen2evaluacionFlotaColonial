<?php
class NaveBatalla extends Nave
{
    protected $armamento;

    protected $clasificacion;


    public function __construct($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros,$puntosDeCasco,$cylonSospechoso,$armamento,$clasificacion)
    {
       
        parent :: __construct($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros,$puntosDeCasco,$cylonSospechoso);
        $this->armamento = $armamento;
        $this->clasificacion = $clasificacion;

    }   

    public function getArmamento()
    {
        return $this->armamento;
    }
    public function getClasificacion()
    {
        return $this->clasificacion;
    }
        public function setArmamento($armamento)
    {
        $this->armamento = $armamento;
    }
    public function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;
    }
    
public function recibirAtaque($impactos)
{
    $this->puntosDeCasco = $this->puntosDeCasco - ($impactos * 0.5);
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