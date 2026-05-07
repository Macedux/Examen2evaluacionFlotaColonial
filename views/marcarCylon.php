<!DOCTYPE html>
<html>

<head>
    <title>Sospecha de Cylon</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Marcar como nave sospechosa de presencia Cylon</h1>

    <form method="POST" style="text-align: left;">
        Nave sospechosa:<br>
        <input type="checkbox" name="cylon_sospechoso" value="1"<?= $nave->getCylonSospechoso() ? 'checked' : '' ?> >
        
        <button type="submit" class="btn btn-cylon">Marcar</button>
        <?php if (isset($error)): ?>
            <p style="color: red;"><b>Error:</b> <?= $error ?></p>
        <?php endif; ?>
    </form>
    <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
</body>

</html>