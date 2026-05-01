<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><b>Error:</b> <?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        Nombre de Usuario:<br>
        <input type="text" name="userName" required style="width: auto;"><br><br>

        Contraseña:<br>
        <input type="password" name="password" required style="width: auto;"><br><br>
        <input type="checkbox" name="recordarme"style="width: auto;"> Recordarme en este terminal<br><br>
        <button type="submit"class="btn btn-primary">Entrar</button>
    </form>

    <br>
    <p>¿No tienes cuenta? </p>
    <a href="index.php?accion=alta"class="btn btn-secondary">Regístrate aquí</a>
    <a href="index.php"class="btn btn-secondary">Volver al inicio</a>
</body>
</html>