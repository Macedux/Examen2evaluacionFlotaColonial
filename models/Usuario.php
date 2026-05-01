<?php
class Usuario
{
    protected $id;

    protected $username;

    protected $password;

    protected $rol;

    protected $colorFondo;

    protected $idioma;

    public function __construct($id, $username, $password, $rol='usuario', $colorFondo=null, $idioma='es')
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->rol = $rol;
        $this->colorFondo = $colorFondo;
        $this->idioma = $idioma;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function getColorFondo()
    {
        return $this->colorFondo;
    }
    public function getIdioma()
    {

        return $this->idioma;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setpassword($password)
    {
        $this->password = $password;
    }
    public function setRol($rol)
    {
        $this->rol = $rol;
    }
    public function setColorFondo($colorFondo)
    {
        $this->colorFondo = $colorFondo;
    }
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;

    }

}


?>