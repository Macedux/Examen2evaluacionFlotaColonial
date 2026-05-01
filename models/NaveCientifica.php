<?php
class NaveCientifica extends Nave
{
    protected $numeroLaboratorios;

    protected $especialidad;


    public function __construct($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros,$puntosDeCasco,$cylonSospechoso,$numeroLaboratorios,$especialidad)
    {
       
        parent :: __construct($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros,$puntosDeCasco,$cylonSospechoso);
        $this->numeroLaboratorios = $numeroLaboratorios;
        $this->especialidad = $especialidad;

    }   

    public function getNumeroLaboratorios()
    {
        return $this->numeroLaboratorios;
    }
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
        public function setNumeroLaboratorios($numeroLaboratorios)
    {
        $this->numeroLaboratorios = $numeroLaboratorios;
    }
    public function setEspecialidad ($especialidad)
    {
        $this->especialidad = $especialidad;
    }
    
public function recibirAtaque($impactos)
{
    $this->puntosDeCasco = $this->puntosDeCasco - ($impactos * 2);
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