<!DOCTYPE html>
<html>

<head>
    <title>Registrar Nave</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Registrar Nave</h1>

    <form method="POST">
        Tipo:<br>
        <select name="tipo" required style="width: auto;">
            <option value="NaveBatalla">Nave de Batalla</option>
            <option value="NaveCarguera">Nave de Logistica</option>
            <option value="NaveCientifica">Nave Científica</option>
        </select><br><br>

        Nombre:<br>
        <input type="text" name="nombre" required style="width: auto;"><br><br>

        Estado:<br>
        <select name="estado" required style="width: auto;">
            <option value="Activa">Activa</option>
            <option value="Dañada">Dañada</option>
            <option value="Destruida">Destruida</option>
        </select><br><br>

        velocidad FtL:<br>
        <select name="velocidadFtL" style="width: auto;">
            <option value="null">-</option>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select><br><br>

        Capacidad de pasajeros:<br>
        <input type="number" name="capacidadPasajeros" required style="width: auto;"><br><br>

        Estado del casco:<br>
        <input type="number" name="puntosDeCasco" style="width: auto;"><br><br>


        Armamento disponible:<br>
        <input type="text" name="armamento" style="width: auto;"><br><br>

        Clasificación:<br>
        <select name="clasificacion" style="width: auto;">
            <option value="Battlestar">Estrella de combate - BS</option>
            <option value="Escolta">Escolta ligera Valkiria - BE</option>
            <option value="Destructor">Destructor - BD</option>
        </select><br><br>



        Tipo de Carga:<br>
        <select name="tipoCarga" style="width: auto;">
            <option value="">-</option>
            <option value="Armamento">Armamento</option>
            <option value="Ciudadanos">Ciudadanos</option>
            <option value="Secreto">Secreto</option>
        </select><br><br>

        Capacidad de carga:<br>
        <input type="number" name="capacidadDeCarga" style="width: auto;"><br><br>



        Laboratorios abordo:<br>
        <input type="number" name="numeroLaboratorios" style="width: auto;"><br><br>

        Especialidad:<br>
        <input type="text" name="especialidad" style="width: auto;"><br><br>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

    <br>
    <a href="index.php" class="btn btn-secondary">Volver</a>
</body>

</html>