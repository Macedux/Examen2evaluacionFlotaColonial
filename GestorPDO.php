<?php

class GestorPDO 
{

    private $db; //al no extender necesita tener una propiedad , aqui se guarda la conexion PDO

    public function __construct() //Se obtiene conexion unica a traves de singleton, se accede ala instancia y luego al PDO que contiene
    {
        $this->db =Connection:: getInstance()->getConn();
    }

    public function registrarUsuario($usuario)
    {
        try {
            $sql = "INSERT INTO usuarios (username, password) VALUES (:username, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':username', $usuario->getUsername());
            $stmt->bindValue(':password', $usuario->getPassword());
            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    public function crear($nave)
    {

        try {
            if ($nave instanceof NaveBatalla) {
                $sql = "INSERT INTO naves (tipo, nombre, estado, velocidadFTL, capacidadPasajeros, puntosCasco, cylonSospechoso, armamento,clasificacion ) VALUES (:tipo,:nombre, :estado, :velocidadFTL, :capacidadPasajeros, :puntosCasco, :cylonSospechoso, :armamento, :clasificacion )";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':tipo', "Batalla");
                $stmt->bindValue(':nombre', $nave->getNombre());
                $stmt->bindValue(':estado', $nave->getEstado());
                $stmt->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $stmt->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $stmt->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $stmt->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $stmt->bindValue(':armamento', $nave->getArmamento());
                $stmt->bindValue(':clasificacion', $nave->getClasificacion());

            } elseif ($nave instanceof NaveCarguera) {
                $sql = "INSERT INTO naves (tipo, nombre, estado, velocidadFTL, capacidadPasajeros, puntosCasco, cylonSospechoso, tipoCarga,capacidadCarga ) VALUES (:tipo,:nombre, :estado, :velocidadFTL, :capacidadPasajeros, :puntosCasco, :cylonSospechoso, :tipoCarga, :capacidadCarga )";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':tipo', "Carguera");
                $stmt->bindValue(':nombre', $nave->getNombre());
                $stmt->bindValue(':estado', $nave->getEstado());
                $stmt->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $stmt->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $stmt->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $stmt->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $stmt->bindValue(':tipoCarga', $nave->getTipoCarga());
                $stmt->bindValue(':capacidadCarga', $nave->getCapacidadDeCarga());
            } else {
                $sql = "INSERT INTO naves (tipo, nombre, estado, velocidadFTL, capacidadPasajeros, puntosCasco, cylonSospechoso, numLaboratorios,especialidad ) VALUES (:tipo,:nombre, :estado, :velocidadFTL, :capacidadPasajeros, :puntosCasco, :cylonSospechoso, :numLaboratorios, :especialidad )";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':tipo', "Científica");
                $stmt->bindValue(':nombre', $nave->getNombre());
                $stmt->bindValue(':estado', $nave->getEstado());
                $stmt->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $stmt->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $stmt->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $stmt->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $stmt->bindValue(':numLaboratorios', $nave->getNumeroLaboratorios());
                $stmt->bindValue(':especialidad', $nave->getEspecialidad());
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function actualizar($nave)
    {

        try {
            if ($nave instanceof NaveBatalla) {
                $sql = "UPDATE naves SET tipo=:tipo, nombre=:nombre, estado=:estado, velocidadFTL=:velocidadFTL, capacidadPasajeros=:capacidadPasajeros, puntosCasco=:puntosCasco, cylonSospechoso=:cylonSospechoso, armamento=:armamento,clasificacion=:clasificacion WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id', $nave->getId());
                $stmt->bindValue(':tipo', "Batalla");
                $stmt->bindValue(':nombre', $nave->getNombre());
                $stmt->bindValue(':estado', $nave->getEstado());
                $stmt->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $stmt->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $stmt->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $stmt->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $stmt->bindValue(':armamento', $nave->getArmamento());
                $stmt->bindValue(':clasificacion', $nave->getClasificacion());

            } elseif ($nave instanceof NaveCarguera) {
                $sql = "UPDATE naves SET tipo=:tipo, nombre=:nombre, estado=:estado, velocidadFTL=:velocidadFTL, capacidadPasajeros=:capacidadPasajeros, puntosCasco=:puntosCasco, cylonSospechoso=:cylonSospechoso, tipoCarga=:tipoCarga,capacidadCarga=:capacidadCarga WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id', $nave->getId());
                $stmt->bindValue(':tipo', "Carguera");
                $stmt->bindValue(':nombre', $nave->getNombre());
                $stmt->bindValue(':estado', $nave->getEstado());
                $stmt->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $stmt->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $stmt->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $stmt->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $stmt->bindValue(':tipoCarga', $nave->getTipoCarga());
                $stmt->bindValue(':capacidadCarga', $nave->getCapacidadDeCarga());
            } else {
                $sql = "UPDATE naves SET tipo=:tipo, nombre=:nombre, estado=:estado, velocidadFTL=:velocidadFTL, capacidadPasajeros=:capacidadPasajeros, puntosCasco=:puntosCasco, cylonSospechoso=:cylonSospechoso, numLaboratorios=:numLaboratorios,especialidad=:especialidad WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id', $nave->getId());
                $stmt->bindValue(':tipo', "Científica");
                $stmt->bindValue(':nombre', $nave->getNombre());
                $stmt->bindValue(':estado', $nave->getEstado());
                $stmt->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $stmt->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $stmt->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $stmt->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $stmt->bindValue(':numLaboratorios', $nave->getNumeroLaboratorios());
                $stmt->bindValue(':especialidad', $nave->getEspecialidad());
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function listar()
    {
        $sql = "SELECT * FROM naves";
        $stmt = $this->db->query($sql);
        $arrayNaves = [];
        while ($value = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($value['tipo'] == "Batalla") {
                $nave = new NaveBatalla($value['id'], $value['nombre'], $value['estado'], $value['velocidadFTL'], $value['capacidadPasajeros'], $value['puntosCasco'], $value['cylonSospechoso'], $value['armamento'], $value['clasificacion']);
            } elseif ($value['tipo'] == "Carguera") {
                $nave = new NaveCarguera($value['id'], $value['nombre'], $value['estado'], $value['velocidadFTL'], $value['capacidadPasajeros'], $value['puntosCasco'], $value['cylonSospechoso'], $value['tipoCarga'], $value['capacidadCarga']);
            } else {
                $nave = new NaveCientifica($value['id'], $value['nombre'], $value['estado'], $value['velocidadFTL'], $value['capacidadPasajeros'], $value['puntosCasco'], $value['cylonSospechoso'], $value['numLaboratorios'], $value['especialidad']);
            }

            $arrayNaves[] = $nave;
        }
        return $arrayNaves;
    }
    public function buscar($id)
    {
        $sql = "SELECT * FROM naves WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $value = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$value)
            return null;

        if ($value['tipo'] == "Batalla") {
            return new NaveBatalla($value['id'], $value['nombre'], $value['estado'], $value['velocidadFTL'], $value['capacidadPasajeros'], $value['puntosCasco'], $value['cylonSospechoso'], $value['armamento'], $value['clasificacion']);
        } elseif ($value['tipo'] == "Carguera") {
            return new NaveCarguera($value['id'], $value['nombre'], $value['estado'], $value['velocidadFTL'], $value['capacidadPasajeros'], $value['puntosCasco'], $value['cylonSospechoso'], $value['tipoCarga'], $value['capacidadCarga']);
        } else {
            return new NaveCientifica($value['id'], $value['nombre'], $value['estado'], $value['velocidadFTL'], $value['capacidadPasajeros'], $value['puntosCasco'], $value['cylonSospechoso'], $value['numLaboratorios'], $value['especialidad']);
        }
    }
    public function buscarUsuarioPorNick($nick)
    {
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nick]);
        $value = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$value) {
            return null;
        } else {
            return new Usuario($value['id'], $value['username'], $value['password'], $value['rol'], $value['colorFondo'], $value['idioma']);
        }
    }
    public function marcarCylon($id, $valor)
{
    $sql = "UPDATE naves SET cylonSospechoso = :valor WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':valor', $valor);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}

public function actualizarCasco($id, $puntos,$estado)
{
    $sql = "UPDATE naves SET puntosCasco = :puntos, estado = :estado WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':puntos', $puntos);
    $stmt->bindValue(':estado', $estado);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}
    public function eliminar($id)
    {
        $sql = "DELETE FROM naves WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
