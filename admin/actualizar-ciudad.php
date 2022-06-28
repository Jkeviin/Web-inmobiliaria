<?php

//Seleccionamos todos los paises
//nos conectamos a la base de datos
include("conexion.php");

//Obtenemos la propiedad en base al id que recibimos por GET
include("conexion.php");
$id_ciudad = $_GET['id'];

//Armamos el query para seleccionar la propiedad
$query = "SELECT * FROM ciudades WHERE id='$id_ciudad'";

//Ejecutamos la consulta
$result = mysqli_query($conn, $query);
$ciudad = mysqli_fetch_assoc($result);



//obtenemos todos los paises
$query = "SELECT * FROM paises";
$resultado_paises = mysqli_query($conn, $query);

if (isset($_GET['modificar'])) {
    //nos conectamos a la base de datos
    include("conexion.php");

    //tomamos los datos que vienen del formulario
    $id = $_GET['id'];
    $id_pais = $_GET['pais'];
    $nombre_ciudad = $_GET['nombre_ciudad'];

    //armamos el query para actualizar el pais
    $query = "UPDATE ciudades SET id_pais='$id_pais', nombre_ciudad='$nombre_ciudad' WHERE id='$id'" ;

    //actualizamos en la tabla paises
    if (mysqli_query($conn, $query)) { //Se actualizo correctamente
        $mensaje = "La ciudad se actualizó correctamente";
    } else {
        $mensaje = "No se pudo actualizar en la BD" . mysqli_error($conn);
    }
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
    <title>SAWPI - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="nueva-ciudad">
                <h2>Actualizar Ciudad</h2>
                <hr>

                <div class="box-nuevo-tipo">
                    <h3>Actualizar Ciudad</h3>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
                        <label for="pais">Seleccione el pais</label>
                        <input type="hidden" name="id" value="<?php echo $ciudad['id'] ?>"> 

                        <select name="pais" id="" class="input-entrada-texto">
                            <?php while ($row = mysqli_fetch_assoc($resultado_paises)) : ?>
                                <?php if ($row['id'] == $ciudad['id_pais']) : ?>
                                    <option value="<?php echo $row['id'] ?>" selected>
                                        <?php echo $row['nombre_pais'] ?>
                                    </option>
                                <?php else : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['nombre_pais'] ?>
                                    </option>
                                <?php endif ?>
                            <?php endwhile ?>
                        </select>
                        <input type="text" name="nombre_ciudad" value="<?php echo $ciudad['nombre_ciudad']?>" placeholder="Nombre de la Ciudad">
                        <input type="submit" name="modificar" value="Modificar" class="btn-accion">
                    </form>

                    <?php if (isset($_GET['modificar'])) : ?>
                        <script>
                            alert("<?php echo $mensaje ?>");
                            window.location.href = 'index.php';
                        </script>


                    <?php endif ?>


                </div>

            </div>
        </div>
    </div>
</body>