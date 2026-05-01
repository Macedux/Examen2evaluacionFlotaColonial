<!DOCTYPE html>
<html>

<head>
    <title>Editar nave</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Editar Nave</h1>

    <form method="POST">
        Tipo:<br>
        <select name="tipo" required style="width: auto;">
            <option value="NaveBatalla" <?= ($nave instanceof NaveBatalla) ? 'selected' : '' ?>>Nave de Batalla</option>
            <option value="NaveCarguera" <?= ($nave instanceof NaveCarguera) ? 'selected' : '' ?>>Nave de Logistica
            </option>
            <option value="NaveCientifica" <?= ($nave instanceof NaveCientifica) ? 'selected' : '' ?>>Nave Científica
            </option>
        </select><br><br>

        Nombre:<br>
        <input type="text" name="nombre" value="<?= $nave->getNombre() ?>" required style="width: auto;"><br><br>

        Estado:<br>
        <select name="estado" required style="width: auto;">
            <option value="Activa">Activa</option>
            <option value="Dañada">Dañada</option>
            <option value="Destruida">Destruida</option>

        </select><br><br>

        velocidad FtL:<br>
        <select name="velocidadFtL" required style="width: auto;">
            <option value="0" <?= ($nave->getVelocidadFtL() == 0) ? 'selected' : '' ?>>No</option>
            <option value="1" <?= ($nave->getVelocidadFtL() == 1) ? 'selected' : '' ?>>Sí</option>
        </select><br><br>

        Capacidad de pasajeros:<br>
        <input type="number" name="capacidadPasajeros" value="<?= $nave->getCapacidadPasajeros() ?>" required
            style="width: auto;"><br><br>

        Estado del casco:<br>
        <input type="number" name="puntosDeCasco" value="<?= $nave->getPuntosDeCasco() ?>" required
            style="width: auto;"><br><br>
        Armamento disponible:<br>
        <input type="text" name="armamento" value="<?= $nave instanceof NaveBatalla ? $nave->getArmamento() : '' ?>"
            style="width: auto;"><br><br>

        Clasificación:<br>
        <select name="clasificacion" style="width: auto;">
            <option value="Battlestar" <?= $nave instanceof NaveBatalla && $nave->getClasificacion() == 'Battlestar' ? 'selected' : '' ?>>Estrella de combate - BS</option>
            <option value="Escolta" <?= $nave instanceof NaveBatalla && $nave->getClasificacion() == 'Escolta' ? 'selected' : '' ?>>Escolta ligera Valkiria - BE</option>
            <option value="Destructor" <?= $nave instanceof NaveBatalla && $nave->getClasificacion() == 'Destructor' ? 'selected' : '' ?>>Destructor - BD</option>
        </select><br><br>

        Tipo de Carga:<br>
        <select name="tipoCarga" style="width: auto;">
            <option value="">-</option>
            <option value="Armamento" <?= $nave instanceof NaveCarguera && $nave->getTipoCarga() == 'Armamento' ? 'selected' : '' ?>>Armamento</option>
            <option value="Ciudadanos" <?= $nave instanceof NaveCarguera && $nave->getTipoCarga() == 'Ciudadanos' ? 'selected' : '' ?>>Ciudadanos</option>
            <option value="Secreto" <?= $nave instanceof NaveCarguera && $nave->getTipoCarga() == 'Secreto' ? 'selected' : '' ?>>Secreto</option>
        </select><br><br>

        Capacidad de carga:<br>
        <input type="number" name="capacidadDeCarga"
            value="<?= $nave instanceof NaveCarguera ? $nave->getCapacidadDeCarga() : '' ?>"
            style="width: auto;"><br><br>

        Laboratorios abordo:<br>
        <input type="number" name="numeroLaboratorios"
            value="<?= $nave instanceof NaveCientifica ? $nave->getNumeroLaboratorios() : '' ?>"
            style="width: auto;"><br><br>

        Especialidad:<br>
        <input type="text" name="especialidad"
            value="<?= $nave instanceof NaveCientifica ? $nave->getEspecialidad() : '' ?>" style="width: auto;"><br><br>


        <button type="submit" class="btn btn-primary">Actualizar nave</button>
    </form>

    <br>
    <a href="index.php" class="btn btn-secondary">Volver al listado</a>
</body>

</html>