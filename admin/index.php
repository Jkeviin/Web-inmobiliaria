<?php
session_start();

//Si el usuario no esta logeado lo enviamos al login
if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
}

include("funciones.php");

//con la función obtenerTotalRegistros obtengo el total de registros de una tabla
// el nombre de la tabla lo mando por paramaetro
$totalPropiedades = obtenerTotalRegistros('propiedades');
$totalTipos = obtenerTotalRegistros('tipos');
$totalPaises = obtenerTotalRegistros('paises');
$totaCiudades = obtenerTotalRegistros('ciudades');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>KEVIN - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="dashboard">
                <h2>Dashboard</h2>
                <hr>
                <div class="contenedor-cajas-info">
                    <div class="caja-info propiedades">
                        <p>Total Popiedades</p>
                        <hr>
                        <span class="dato"> <?php echo $totalPropiedades ?></span>
                        <hr>
                        <a href="listado-propiedades.php">Ver Detalles</a>
                    </div>
                    <div class="caja-info">
                        <p>Total Tipo de Propiedades</p>
                        <hr>
                        <span class="dato"> <?php echo $totalTipos ?></span>
                        <hr>
                        <a href="listado-tipo-propiedades.php">Ver Detalles</a>
                    </div>
                    <div class="caja-info">
                        <p>Total Paises</p>
                        <hr>
                        <span class="dato"><?php echo $totalPaises ?></span>
                        <hr>
                        <a href="listado-paises.php">Ver Detalles</a>
                    </div>
                    <div class="caja-info">
                        <p>Total Ciudades</p>
                        <hr>
                        <span class="dato"><?php echo $totaCiudades ?></span>
                        <hr>
                        <a href="listado-ciudades.php">Ver Detalles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#link-dashboard').addClass('pagina-activa');
    </script>

</body>

</html>