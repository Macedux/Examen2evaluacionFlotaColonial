<!DOCTYPE html>
<html>

<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Crear nuevo usuario</h1>

    <form method="POST">
        Nombre de usuario:<br>
        <input type="text" name="userName" required><br><br>

        Contraseña:<br>
        <input type="password" name="password" required minlength="6"><br><br>

        <button type="submit"class="btn btn-primary">Registrarse</button>
        <?php if (isset($error)): ?>
            <p style="color: red;"><b>Error:</b> <?= $error ?></p>
        <?php endif; ?>
    </form>

    <br>
    <p>¿Ya tienes una cuenta? <a href="index.php?accion=login"class="btn btn-secondary">Inicia sesión aquí</a></p>
    <a href="index.php"class="btn btn-secondary">Volver al inicio</a>
</body>

</html>