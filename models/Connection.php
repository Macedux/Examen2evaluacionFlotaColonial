<?php

class Connection
{
    protected $pdo; //Tipo objeto PDO
    private $configFile = "conf.json";

    private static $instance = null; //instancia d ela conexion de la base de datos para que solo se haga una vez (para no reventar el servidor)
                                    //estatica es que solo puede llamarse desde la clase
    public function __construct()
    {
        $this->makeConnection();
    }

    public static function getInstance()
    { //cambio ,para singelton para obtener la instancia
        if (self::$instance === null) { //como la propiedad es estatica no puedes usar $this
            self::$instance = new self();//self hace referencia a la misma clase, se puede poner connexion
        }
        return self::$instance;
    }
    private function makeConnection()
    {
        try {
            if (!file_exists($this->configFile)) {
                throw new Exception("Archivo de configuración no encontrado.");
            }

            $configData = file_get_contents($this->configFile);
            $c = json_decode($configData, true);
            $dsn = "mysql:host=" . $c['host'] . ";dbname=" . $c['db'];
            $this->pdo = new PDO($dsn, $c['userName'], $c['password']);

        } catch (PDOException $e) {

            echo "<b>Mensaje:</b> " . $e->getMessage() . "<br>";
            echo "<b>Código de error MySQL:</b> " . $e->getCode() . "<br>";
        } catch (Exception $e) {

            echo "Error de sistema: " . $e->getMessage();
        }
    }

    public function getConn()
    {
        return $this->pdo;
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    private function __clone(){} //esto hace que el objeto no se pueda clonar  (patron singleton stricto) cambio de seguridad no hace falta entender

    public function __wakeup(){//cambio de seguridad no hace falta entender
        throw new \Exception("No puedes deserializar una instancia de Connection.");
    }
}
//FIN DE LA CONEXIÓN