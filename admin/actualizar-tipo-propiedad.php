<?php

//Obtenemos la propiedad en base al id que recibimos por GET
include("conexion.php");
$id_tipo_propiedad = $_GET['id'];

//Armamos el query para seleccionar el tipo de propiedad propiedad
$query = "SELECT * FROM tipos WHERE id='$id_tipo_propiedad'";

//Ejecutamos la consulta
$result = mysqli_query($conn, $query);
$tipo = mysqli_fetch_assoc($result);
/************************************************************* */

if (isset($_GET['modificar'])) {
    //nos conectamos a la base de datos
    include("conexion.php");

    //tomamos los datos que vienen del formulario
    $id = $_GET['id'];
    $nombre_tipo = $_GET['nombre_tipo'];

    //armamos el query para actualizar en la tabla tipos
    $query = "UPDATE tipos SET nombre_tipo='$nombre_tipo' WHERE id='$id'" ;

    //actualizamos en la tabla tipos
    if (mysqli_query($conn, $query)) { //Se actualizo correctamente
        $mensaje = "Tipo de Propiedad actualizó correctamente";
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
    <title>KEVIN - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>
    
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <!-- utilizamos el id de nuevo-tipo-propiedad para aprovechar los estilos ya creados -->
            <div id="nuevo-tipo-propiedad">
                <h2>Actualizar Tipo de Propiedad</h2>
                <hr>

                <div class="box-nuevo-tipo">
                    <h3>Actualizar Tipo de Propiedad</h3>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
                        <input type="hidden" name="id" value="<?php echo $tipo['id'] ?>"> 
                        <input type="text" name="nombre_tipo" value="<?php echo $tipo['nombre_tipo'] ?>" placeholder="Tipo de propiedad" required>
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

</html>