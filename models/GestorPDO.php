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
                $consulta = "INSERT INTO naves (tipo, nombre, estado, velocidadFTL, capacidadPasajeros, puntosCasco, cylonSospechoso, armamento,clasificacion ) VALUES (:tipo,:nombre, :estado, :velocidadFTL, :capacidadPasajeros, :puntosCasco, :cylonSospechoso, :armamento, :clasificacion )";
                $consulta = $this->db->prepare($consulta);
                $consulta->bindValue(':tipo', "Batalla");
                $consulta->bindValue(':nombre', $nave->getNombre());
                $consulta->bindValue(':estado', $nave->getEstado());
                $consulta->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $consulta->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $consulta->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $consulta->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $consulta->bindValue(':armamento', $nave->getArmamento());
                $consulta->bindValue(':clasificacion', $nave->getClasificacion());

            } elseif ($nave instanceof NaveCarguera) {
                $consulta = "INSERT INTO naves (tipo, nombre, estado, velocidadFTL, capacidadPasajeros, puntosCasco, cylonSospechoso, tipoCarga,capacidadCarga ) VALUES (:tipo,:nombre, :estado, :velocidadFTL, :capacidadPasajeros, :puntosCasco, :cylonSospechoso, :tipoCarga, :capacidadCarga )";
                $consulta = $this->db->prepare($consulta);
                $consulta->bindValue(':tipo', "Carguera");
                $consulta->bindValue(':nombre', $nave->getNombre());
                $consulta->bindValue(':estado', $nave->getEstado());
                $consulta->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $consulta->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $consulta->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $consulta->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $consulta->bindValue(':tipoCarga', $nave->getTipoCarga());
                $consulta->bindValue(':capacidadCarga', $nave->getCapacidadDeCarga());
            } else {
                $consulta = "INSERT INTO naves (tipo, nombre, estado, velocidadFTL, capacidadPasajeros, puntosCasco, cylonSospechoso, numLaboratorios,especialidad ) VALUES (:tipo,:nombre, :estado, :velocidadFTL, :capacidadPasajeros, :puntosCasco, :cylonSospechoso, :numLaboratorios, :especialidad )";
                $consulta = $this->db->prepare($consulta);
                $consulta->bindValue(':tipo', "Científica");
                $consulta->bindValue(':nombre', $nave->getNombre());
                $consulta->bindValue(':estado', $nave->getEstado());
                $consulta->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $consulta->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $consulta->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $consulta->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $consulta->bindValue(':numLaboratorios', $nave->getNumeroLaboratorios());
                $consulta->bindValue(':especialidad', $nave->getEspecialidad());
            }
            return $consulta->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function actualizar($nave)
    {

        try {
            if ($nave instanceof NaveBatalla) {
                $consulta = "UPDATE naves SET tipo=:tipo, nombre=:nombre, estado=:estado, velocidadFTL=:velocidadFTL, capacidadPasajeros=:capacidadPasajeros, puntosCasco=:puntosCasco, cylonSospechoso=:cylonSospechoso, armamento=:armamento,clasificacion=:clasificacion WHERE id = :id";
                $consulta = $this->db->prepare($consulta);
                $consulta->bindValue(':id', $nave->getId());
                $consulta->bindValue(':tipo', "Batalla");
                $consulta->bindValue(':nombre', $nave->getNombre());
                $consulta->bindValue(':estado', $nave->getEstado());
                $consulta->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $consulta->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $consulta->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $consulta->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $consulta->bindValue(':armamento', $nave->getArmamento());
                $consulta->bindValue(':clasificacion', $nave->getClasificacion());

            } elseif ($nave instanceof NaveCarguera) {
                $consulta = "UPDATE naves SET tipo=:tipo, nombre=:nombre, estado=:estado, velocidadFTL=:velocidadFTL, capacidadPasajeros=:capacidadPasajeros, puntosCasco=:puntosCasco, cylonSospechoso=:cylonSospechoso, tipoCarga=:tipoCarga,capacidadCarga=:capacidadCarga WHERE id = :id";
                $consulta = $this->db->prepare($consulta);
                $consulta->bindValue(':id', $nave->getId());
                $consulta->bindValue(':tipo', "Carguera");
                $consulta->bindValue(':nombre', $nave->getNombre());
                $consulta->bindValue(':estado', $nave->getEstado());
                $consulta->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $consulta->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $consulta->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $consulta->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $consulta->bindValue(':tipoCarga', $nave->getTipoCarga());
                $consulta->bindValue(':capacidadCarga', $nave->getCapacidadDeCarga());
            } else {
                $consulta = "UPDATE naves SET tipo=:tipo, nombre=:nombre, estado=:estado, velocidadFTL=:velocidadFTL, capacidadPasajeros=:capacidadPasajeros, puntosCasco=:puntosCasco, cylonSospechoso=:cylonSospechoso, numLaboratorios=:numLaboratorios,especialidad=:especialidad WHERE id = :id";
                $consulta = $this->db->prepare($consulta);
                $consulta->bindValue(':id', $nave->getId());
                $consulta->bindValue(':tipo', "Científica");
                $consulta->bindValue(':nombre', $nave->getNombre());
                $consulta->bindValue(':estado', $nave->getEstado());
                $consulta->bindValue(':velocidadFTL', $nave->getVelocidadFtL());
                $consulta->bindValue(':capacidadPasajeros', $nave->getCapacidadPasajeros());
                $consulta->bindValue(':puntosCasco', $nave->getPuntosDeCasco());
                $consulta->bindValue(':cylonSospechoso', $nave->getCylonSospechoso());
                $consulta->bindValue(':numLaboratorios', $nave->getNumeroLaboratorios());
                $consulta->bindValue(':especialidad', $nave->getEspecialidad());
            }
            return $consulta->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function listar()
    {
        $consulta = "SELECT * FROM naves";
        $rtdo = $this->db->query($consulta);
        $arrayNaves = [];
        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)) {
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
        $consulta = "SELECT * FROM naves WHERE id = ?";
        $rtdo = $this->db->prepare($consulta);
        $rtdo->execute([$id]);
        $value = $rtdo->fetch(PDO::FETCH_ASSOC);

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
        $consulta = "SELECT * FROM usuarios WHERE username = ?";
        $rtdo = $this->db->prepare($consulta);
        $rtdo->execute([$nick]);
        $value = $rtdo->fetch(PDO::FETCH_ASSOC);

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
