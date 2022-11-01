<?php
session_start();

if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
}

//Obtenemos la propiedad en base al id que recibimos por GET
include("conexion.php");
$id_propiedad = $_GET['id'];

//Armamos el query para seleccionar la propiedad
$query = "SELECT * FROM propiedades WHERE id='$id_propiedad'";

//Ejecutamos la consulta
$resultado_propiedad = mysqli_query($conn, $query);
$propiedad = mysqli_fetch_assoc($resultado_propiedad);
/************************************************************* */


function obtenerTipo($id_tipo)
{
    include("conexion.php");
    $query = "SELECT * FROM tipos WHERE id='$id_tipo'";

    //Ejecutamos la consulta
    $resultado_tipo = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_tipo);
    return $row['nombre_tipo'];
}

function obtenerFotosGaleria($id_propiedad)
{
    include("conexion.php");
    $query = "SELECT * FROM fotos WHERE id_propiedad='$id_propiedad'";

    //Ejecutamos la consulta
    $resultado_fotos = mysqli_query($conn, $query);
    return $resultado_fotos;
}

function obtenerPais($id_pais)
{
    include("conexion.php");
    $query = "SELECT * FROM paises WHERE id='$id_pais'";

    //Ejecutamos la consulta
    $resultado_pais = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_pais);
    return $row['nombre_pais'];
}

function obtenerCiudad($id_ciudad)
{
    include("conexion.php");
    $query = "SELECT * FROM ciudades WHERE id='$id_ciudad'";

    //Ejecutamos la consulta
    $resultado_ciudad = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_ciudad);
    return $row['nombre_ciudad'];
}

?>






<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>KEVIN - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="detalle-propiedad">
                <h2>Detalle de Propiedad</h2>
                <hr>
                <div class="contenedor-tabla">
                    <h3>Descripción de la propiedad</h3>
                    <table class="descripcion">
                        <tr>
                            <td>ID de la Propiedad</td>
                            <td><?php echo $propiedad['id'] ?></td>
                        </tr>
                        <tr>
                            <td>Título de la Propiedad:</td>
                            <td> <?php echo $propiedad['titulo'] ?> </td>
                        </tr>

                        <tr>
                            <td>Descripción de la Propiedad</td>
                            <td> <?php echo $propiedad['descripcion'] ?> </td>
                        </tr>

                        <tr>
                            <td>Tipo de propiedad</td>
                            <td> <?php echo obtenerTipo($propiedad['tipo']) ?> </td>
                        </tr>

                        <tr>
                            <td>Elija estado de la propiedad</label></td>
                            <td> <?php echo $propiedad['estado'] ?> </td>
                        </tr>

                        <tr>
                            <td>Ubicación</label></td>
                            <td> <?php echo $propiedad['ubicacion'] ?> </td>
                        </tr>

                        <tr>
                            <td>Habitaciones</label></td>
                            <td> <?php echo $propiedad['habitaciones'] ?> </td>
                        </tr>

                        <tr>
                            <td>Baños</td>

                            <td> <?php echo $propiedad['banios'] ?> </td>
                        </tr>

                        <tr>
                            <td>Pisos</td>
                            <td> <?php echo $propiedad['pisos'] ?> </td>
                        </tr>

                        <tr>
                            <td>Garage</td>
                            <td> <?php echo $propiedad['garage'] ?> </td>
                        </tr>

                        <tr>
                            <td>Dimensiones</td>
                            <td> <?php echo $propiedad['dimensiones'] ?> </td>
                        </tr>

                        <tr>
                            <td>Precio (Alquiler o Venta)</td>
                            <td> <?php echo $propiedad['precio'] ?> </td>
                        </tr>
                    </table>
                </div>

                <div class="contenedor-tabla">
                    <h3>Galería de Fotos</h3>
                    <table class="descripcion">
                        <tr>
                            <td>Foto Principal</td>
                            <td><img src="<?php echo $propiedad['url_foto_principal'] ?>" alt=""></td>
                        </tr>

                        <tr>
                            <td> Galería</td>
                            <td><?php $resultFotos = obtenerFotosGaleria($propiedad['id']); ?>
                                <?php while ($foto = mysqli_fetch_assoc($resultFotos)) : ?>

                                    <img src="fotos/<?php echo $propiedad['id'] . "/" . $foto['nombre_foto'] ?>">

                                <?php endwhile ?>
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="contenedor-tabla">
                    <h3>Ubicación y Datos del propietario</h3>

                    <table class="descripcion">
                        <tr class="fila">
                            <td><label for="pais">Pais</td>
                            <td> <?php echo obtenerPais($propiedad['pais']) ?> </td>
                        </tr>
                        <tr class="fila">
                            <td>Ciudad</td>
                            <td> <?php echo obtenerCiudad($propiedad['ciudad']) ?> </td>
                        </tr>

                        <tr>
                            <td>Nombre del propietario</td>
                            <td> <?php echo $propiedad['propietario'] ?> </td>
                        </tr>
                        <tr>
                            <td>Teléfono del propietario</td>
                            <td><?php echo $propiedad['telefono_propietario'] ?> </td>
                        </tr>
                    </table>
                </div>


            </div>
        </div>
    </div>
</body>

</html>