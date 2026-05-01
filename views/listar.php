<?php
$lang = $_SESSION['idioma'] ?? 'Spanish';
$titulo = ($lang == 'English') ? 'Surviving Fleet of the XII Colonies' : 'Flota superviviente de las XII Colonias';
$agregarNave = ($lang == 'English') ? 'Add Ship' : 'Agregar Nave';
$elegirColor = ($lang == 'English') ? 'Choose your ribbon' : 'Selecciona el color de tu cinta';
$seleccionaIdioma = ($lang == 'English') ? 'Select Language' : 'Seleccione Idioma';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de la Flota</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1><?= $titulo ?></h1>

    <div style="padding: 10px; margin-bottom: 20px;">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            Bienvenido, <b><?= $_SESSION['userName'] ?></b> |
            <a href="index.php?accion=logout" class="btn btn-secondary">Cerrar Sesión</a>
        <?php else: ?>
            <a href="index.php?accion=login" class="btn btn-primary">Iniciar Sesión</a> |
            <a href="index.php?accion=alta" class="btn btn-secondary">Registrarse</a>
            <!-- COLOR DE FONDO --->
        <?php endif; ?>
        <P>
            <?= $elegirColor ?>
        </P>
        <div id="barraColor" style="height: 8px; background-color: #0a0c0f;"></div>
        <input type="color" id="colorFondo" value="#ffffff" onchange="cambiarColor(this.value)"
            style="width:40px !important; height:28px !important; display:inline-block;">
    </div>
    <div>

        <form method="POST" action="index.php?accion=idioma">
            <P>
                <?= $seleccionaIdioma ?>
            </P>
            <select name="idioma" style="width: auto;">
                <option value="Spanish">Español</option>
                <option value="English">Inglés</option>
            </select>
            <button type="submit" class="btn btn-secondary">Guardar</button>
        </form>
        <a href="index.php?accion=crear" class="btn btn-primary">
            <?= $agregarNave ?>
        </a>
        <table>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Velocidad FtL</th>
                <th>Capacidad de Pasajeros</th>
                <th>Puntos de Casco</th>
                <th>Armamento</th>
                <th>Clasificacion</th>
                <th>Tipo de carga </th>
                <th>Capacidad de carga</th>
                <th>Numero de laboratorios </th>
                <th>Especialidad</th>
                <th>Sospecha de cylon</th>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                <th>Acciones</th>
                <?php endif; ?>

            </tr>

            <?php foreach ($naves as $n): ?>

            <tr <?= $n->getCylonSospechoso() ? 'class="cylon-row"' : '' ?>>
                <td>
                    <?= $n->getId() ?>
                </td>
                <td>
                    <?php if ($n instanceof NaveBatalla) {
                        echo "Nave de Batalla ";
                    } elseif ($n instanceof NaveCarguera) {
                        echo "Nave de Carga";
                    } else {
                        echo "Nave de Científica";
                    }
                    ?>
                </td>
                <td>
                    <?= $n->getNombre() ?>
                </td>
                <td>
                    <?= $n->getEstado() ?>
                </td>
                <td>
                    <?= $n->getVelocidadFtL() ? 'Sí' : 'No' ?>
                </td>
                <td>
                    <?= $n->getCapacidadPasajeros() ?>
                </td>
                <td>
                    <?= $n->getPuntosDeCasco() ?>
                </td>
                <td>
                    <?php if ($n instanceof NaveBatalla) {
                        echo $n->getArmamento();
                    } ?>
                </td>
                <td>
                    <?php if ($n instanceof NaveBatalla) {
                        echo $n->getClasificacion();
                    }
                    ?>
                </td>
                <td>
                    <?php if ($n instanceof NaveCarguera) {
                        echo $n->getTipoCarga();
                    } ?>
                </td>
                <td>
                    <?php if ($n instanceof NaveCarguera) {
                        echo $n->getCapacidadDeCarga();
                    } ?>
                </td>
                <td>
                    <?php if ($n instanceof NaveCientifica) {
                        echo $n->getNumeroLaboratorios();
                    } ?>
                </td>
                <td>
                    <?php if ($n instanceof NaveCientifica) {
                        echo $n->getEspecialidad();
                    } ?>
                </td>
                <td>
                    <?= $n->getCylonSospechoso() ? 'Sí' : 'No' ?>
                </td>


                <?php
                if (isset($_SESSION['usuario_id'])): ?>


                <td>
                    <a href="index.php?accion=atacar&id=<?= $n->getId() ?>" class="btn btn-secondary">Daño recibido</a>
                    <a href="index.php?accion=editar&id=<?= $n->getId() ?>" class="btn btn-secondary">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?= $n->getId() ?>" class="btn btn-danger">Eliminar</a>
                    <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                    <a href="index.php?accion=marcarCylon&id=<?= $n->getId() ?>" class="btn btn-cylon">⚠ Cylon</a>
                    <?php endif; ?>
                </td>


                <?php endif; ?>


            </tr>
            <?php endforeach; ?>

        </table>
        <?php if ($paginaActual > 1): ?>
        <a href="index.php?accion=index&pagina=<?= $paginaActual - 1 ?>" class="btn btn-secondary">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
        <a href="index.php?accion=index&pagina=<?= $i ?>" class="btn btn-secondary">
            <?= $i ?>
        </a>
        <?php endfor; ?>

        <?php if ($paginaActual < $totalPaginas): ?>
        <a href="index.php?accion=index&pagina=<?= $paginaActual + 1 ?>" class="btn btn-secondary">Siguiente</a>
        <?php endif; ?>
    </div>
    <script>
        window.onload = function () {
            const color = getCookie('color_fondo');
            if (color) {
                document.getElementById('barraColor').style.backgroundColor = color;
                document.getElementById('colorFondo').value = color;
            }
        };

        function cambiarColor(color) {
            document.getElementById('barraColor').style.backgroundColor = color;
            const expires = new Date(Date.now() + 86400000 * 30).toUTCString();
            document.cookie = `color_fondo=${color}; expires=${expires}; path=/`;
        }

        function getCookie(nombre) {
            const cookies = document.cookie.split('; ');
            for (let c of cookies) {
                const [key, val] = c.split('=');
                if (key === nombre) return val;
            }
            return null;
        }
    </script>
    <div>
        <a class="btn btn-secondary" href="" target="_blank" rel="noopener">
            Página GitHub del proyecto
        </a>
    </div>
</body>

</html>