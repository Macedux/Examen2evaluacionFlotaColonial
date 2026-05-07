<?php

class NaveController
{

    private $gestor;

    public function __construct($gestor)
    {
        $this->gestor = $gestor;
    }

    public function index() //al index le he añadido el PAGINADOR! no se pide pero imaginemos si listamos muchas naves
    {
        $naves = $this->gestor->listar();
        $totalNaves = count($naves);
        $navesPorPagina = 5;
        $totalPaginas = ceil($totalNaves / $navesPorPagina);
        $paginaActual = $_GET['pagina'] ?? 1;
        $naves = array_slice($naves, ($paginaActual - 1) * $navesPorPagina, $navesPorPagina);
        include "views/listar.php";
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $estado = $_POST['estado'];
            $cylonSospechoso = 0;
            $velocidadFtL = $_POST['velocidadFtL'];
            $capacidadPasajeros = $_POST['capacidadPasajeros'];
            $puntosDeCasco = $_POST['puntosDeCasco'];
            if ($_POST['tipo'] == "NaveBatalla") {
                $armamento = $_POST['armamento'];
                $clasificacion = $_POST['clasificacion']; //Ponemos null porque la BBDD genera automaticamente un numero que se autoincrementa
                $nave = new NaveBatalla(null, $nombre, $estado, $velocidadFtL, $capacidadPasajeros, $puntosDeCasco, $cylonSospechoso, $armamento, $clasificacion);
            } elseif ($_POST['tipo'] == "NaveCarguera") {
                $tipoCarga = $_POST['tipoCarga'];
                $capacidadDeCarga = $_POST['capacidadDeCarga'];
                $nave = new NaveCarguera(null, $nombre, $estado, $velocidadFtL, $capacidadPasajeros, $puntosDeCasco, $cylonSospechoso, $tipoCarga, $capacidadDeCarga);
            } else {
                $numeroLaboratorios = $_POST['numeroLaboratorios'];
                $especialidad = $_POST['especialidad'];
                $nave = new NaveCientifica(null, $nombre, $estado, $velocidadFtL, $capacidadPasajeros, $puntosDeCasco, $cylonSospechoso, $numeroLaboratorios, $especialidad);
            }
            $this->gestor->crear($nave);

            header("Location: index.php");
            exit;
        }

        include "views/crear.php";
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        $nave = ($this->gestor->buscar($id));
        if (!$nave) {//si la nave no existe pues retorna al index. guardamos una session de error para que el usuario vea el mensaje pero pueda serguir navegando
            $_SESSION['error'] = "Nave perdida en el ataque de las Doce Colonias"; //echo+header no son compatibles!
            header("Location: index.php");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $estado = $_POST['estado'];
            $velocidadFtL = $_POST['velocidadFtL'];
            $capacidadPasajeros = $_POST['capacidadPasajeros'];
            $puntosDeCasco = $_POST['puntosDeCasco'];
            $cylonSospechoso = $nave->getCylonSospechoso();

            if ($_POST['tipo'] == "NaveBatalla") {
                $nave = new NaveBatalla($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros, $puntosDeCasco, $cylonSospechoso, $_POST['armamento'], $_POST['clasificacion']);
            } elseif ($_POST['tipo'] == "NaveCarguera") {
                $nave = new NaveCarguera($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros, $puntosDeCasco, $cylonSospechoso, $_POST['tipoCarga'], $_POST['capacidadDeCarga']);
            } else {
                $nave = new NaveCientifica($id, $nombre, $estado, $velocidadFtL, $capacidadPasajeros, $puntosDeCasco, $cylonSospechoso, $_POST['numeroLaboratorios'], $_POST['especialidad']);
            }

            $this->gestor->actualizar($nave);//Con el redirect después del POST, la última petición que el navegador recuerda es el GET del listado, no el POST. 
            header("Location: index.php");//header y echo son excluyentes!
            exit;
        }

        include "views/editar.php";
    }
    public function marcarCylon()
    {

        $id = $_GET['id'] ?? null;
        $nave = ($this->gestor->buscar($id));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $valor = isset($_POST['cylon_sospechoso']) ? 1 : 0;
            $this->gestor->marcarCylon($id, $valor);
            header("Location: index.php");
            exit;
        }
        include "views/marcarCylon.php";

    }
public function atacar()
{
    $id = $_GET['id'] ?? null;
    $nave = $this->gestor->buscar($id);
    if (!$nave) {
        header("Location: index.php");
        exit;
    }
    $nuevosCascos = $nave->recibirAtaque(10);
    $this->gestor->actualizarCasco($id, $nuevosCascos, $nave->getEstado());
    header("Location: index.php");
    exit;
}

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        $this->gestor->eliminar($id);
        header("Location: index.php");
        exit;
    }
}
