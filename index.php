<?php
require_once "autoload.php";
session_start();

$gestor = new GestorPDO();
$naveController = new NaveController($gestor);
$usuarioController = new UsuarioController($gestor);
$accion = $_GET['accion'] ?? 'index';

// --- LÓGICA DE COOKIES: RE-AUTENTICACIÓN AUTOMÁTICA ---
// Si NO hay sesión iniciada, pero SÍ existe la cookie "usuario_login"
if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_login'])) {

    // 1. Recuperamos el email que guardamos en la cookie (estaba en Base64)
    $nickRecuperado = base64_decode($_COOKIE['usuario_login']);

    // 2. Buscamos al usuario en la base de datos
    $usuario = $gestor->buscarUsuarioPorNick($nickRecuperado);

    // 3. Si el usuario existe, restauramos la sesión automáticamente
    if ($usuario) {
        $_SESSION['usuario_rol'] = $usuario->getRol();
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['userName'] = $usuario->getUsername();
    } else { // Si la cookie es falsa o el usuario ya no existe, borramos la cookie por seguridad

        setcookie('usuario_login', '', time() - 3600, '/');
    }
}
// ----------------------------------------------------------------


switch ($accion) {

    //controladores para usuarios

    case 'login':
        $usuarioController->login();
        break;
    case 'alta':
        $usuarioController->alta();
        break;
    case 'logout':
        $usuarioController->logout();
        break;
    //controladores para naves. Tecnica fall-throught
    case 'marcarCylon':
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {//doble proteccion, ya que si teniamos la primera que es que solo pueda marcar el rol que sea admin, pero PERO!
            header('Location: index.php?accion=login');                                //un señor astuto podia enviar el marcar mediante GET en la URL!
            exit;
        }
        $naveController->marcarCylon();// no se puede aplicar fall throught ya que necesita comparar dos cosas y esto solo funciona si comprueba una cosa (sesion activa)
        break;
    case 'crear':

    case 'editar':

    case 'atacar':

    case 'eliminar':
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?accion=login');
            exit;
        }

        // Si está autenticado, dejamos que ejecute la acción
        if ($accion === 'crear')
            $naveController->crear();
        if ($accion === 'editar')
            $naveController->editar();
        if ($accion === 'eliminar')
            $naveController->eliminar();
        if ($accion === 'atacar')
            $naveController->atacar();
        break;
    case 'idioma':
        $usuarioController->idioma();//El idioma esta fuera del comprobador de login, ¡todo el mundo tiene derecho a cambiar a ponerselo en su idioma!
        break;


    default:
        $naveController->index();
}
