<?php

class UsuarioController
{
    private $gestor;
    public function __construct($gestor)
    {
        $this->gestor = $gestor;
    }
    public function alta()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['userName'];
            $passwordPlana = $_POST['password'];

            // 1. Hasheamos la contraseña
            $passwordHash = password_hash($passwordPlana, PASSWORD_DEFAULT);

            // 2. Creamos el OBJETO Usuario (sin ID, porque es nuevo)
            $nuevoUsuario = new Usuario(null, $username, $passwordHash);
            //validacion si el usuario ya esta creado
            $resultado = $this->gestor->registrarUsuario($nuevoUsuario);

            if ($resultado) {
                header("Location: index.php?accion=login");
                exit;
            } else {
                $error = "El usuario ya está registrado.";
            }

        }

        include "views/alta.php";
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {//se envia un post
            $username = $_POST['userName'];//declaramos variables
            $password = $_POST['password'];
            $recordar = isset($_POST['recordarme']);
            $usuario = $this->gestor->buscarUsuarioPorNick($username);//el gestor llama al usuario para que le de un nick

            if ($usuario && password_verify($password, $usuario->getPassword())) {//si se verifica contraseña
                $_SESSION['usuario_id'] = $usuario->getId();//usuario recoge el usuario por ID
                $_SESSION['userName'] = $usuario->getUsername();//Usuario recoge el nick
                $_SESSION['usuario_rol'] = $usuario->getRol();//tambien hay que comprobar los roles del que hace login
                //pero , si ademas se ha recordado!
                if ($recordar) {
                    $token = base64_encode($usuario->getUsername()); //creamos un token  para guardar en la bbdd
                    //creamos la cookie
                    setcookie(
                        "usuario_login",
                        $token,
                        [
                            'expires' => time() + (86400 * 30), // 30 días
                            'path' => '/',
                            'httponly' => true,  // Seguridad: No accesible por JS
                            'samesite' => 'Strict'
                        ]
                    );

                }
                header("Location: index.php");
                exit;
            } else {
                $error = "Credenciales incorrectas.";
            }
        }




        include "views/login.php";


    }

    public function idioma()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['idioma'] = $_POST['idioma'];
        }
        header("Location: index.php");
        exit;
    }
    public function logout()
    {
        // Vaciamos las variables de sesión
        $_SESSION = [];

        // Destruimos la sesión completamente
        session_destroy();

        // Eliminamos la cookie al cerrar sesión
        if (isset($_COOKIE['usuario_login'])) {
            setcookie('usuario_login', '', time() - 3600000, '/');
        }
        // Eliminamos también la cookie del color
        if (isset($_COOKIE['color_fondo'])) {
            setcookie('color_fondo', '', time() - 3600000, '/');
        }
        if (isset($_COOKIE['idioma'])) {
            setcookie('idioma', '', time() - 3600000, '/');
        }

        // Redirigimos al inicio
        header("Location: index.php?accion=login");
        exit;
    }
}
