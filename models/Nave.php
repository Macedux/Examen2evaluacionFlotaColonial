<?php
abstract class Nave // abstract hace que no pueda haber una nave a secas  (CLASE CONCEPTUAL) y permite declarar metodos sin cuerpo que las hijas estan oblicadas a declarar. Buena practica OOP
{                    //La palabra abstract en PHP es una protección técnica — le dice al lenguaje "esta clase nunca puede instanciarse directamente"   
    protected $id;

    protected $nombre;

    protected $estado;

    protected $velocidadFtL;

    protected $capacidadPasajeros;

    protected $puntosDeCasco = 100;
    protected $cylonSospechoso;

    public function __construct($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros, $puntosDeCasco, $cylonSospechoso)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->estado = $estado;
        $this->velocidadFtL = $velocidadFtL;
        $this->capacidadPasajeros = $capacidadPasajeros;
        $this->puntosDeCasco = $puntosDeCasco;
        $this->cylonSospechoso = $cylonSospechoso;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getVelocidadFtL()
    {
        return $this->velocidadFtL;
    }
    public function getCapacidadPasajeros()
    {
        return $this->capacidadPasajeros;
    }
    public function getPuntosDeCasco()
    {

        return $this->puntosDeCasco;
    }
    public function getCylonSospechoso()
    {

        return $this->cylonSospechoso;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function setVelocidadFtL($velocidadFtL)
    {
        $this->velocidadFtL = $velocidadFtL;
    }
    public function setCapacidadPasajeros($capacidadPasajeros)
    {
        $this->capacidadPasajeros = $capacidadPasajeros;
    }
    public function setPuntosdeCasco($puntosDeCasco)
    {

        if ($puntosDeCasco < 0) { //Esto hace que los puntos de casco no sean negativos (nota de diseño : la nave se)
            $puntosDeCasco = 0;
        }
        $this->puntosDeCasco = $puntosDeCasco;

    }
    public function setCylonSospechoso($cylonSospechoso)
    {
        $this->cylonSospechoso = $cylonSospechoso;
    }
    public function recibirAtaque($impactos)
    {
        $this->puntosDeCasco = $this->puntosDeCasco - $impactos;
        if ($this->puntosDeCasco < 0)
            $this->puntosDeCasco = 0;
        if ($this->puntosDeCasco >90) {
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