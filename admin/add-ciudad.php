<?php

//Seleccionamos todos los paises
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los paises
$query = "SELECT * FROM paises";

//Ejecutamos la consulta
$resultado = mysqli_query($conn, $query);


if (isset($_POST['agregar'])) {
    //nos conectamos a la base de datos
    include("conexion.php");

    //tomamos los datos que vienen del formulario
    $id_pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];

    //armamos el query para insertar en la tabla ciudades
    $query = "INSERT INTO ciudades (id, id_pais, nombre_ciudad)
    VALUES (NULL,'$id_pais', '$ciudad')";

    //insertamos en la tabla ciudades
    if (mysqli_query($conn, $query)) { //Se insertó correctamente
        $mensaje = "La ciudad se agrego correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_error($conn);
    }
}
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
    <title>SAWPI - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>
    
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="nueva-ciudad">
                <h2>Agregar Nueva Ciudad</h2>
                <hr>

                <div class="box-nuevo-tipo">
                    <h3>Agregar Nueva Ciudad</h3>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

                        <label for="pais">Seleccione el pais</label>
                        <select name="pais" id="">
                            <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
                                <option value="<?php echo $row['id'] ?>">
                                    <?php echo $row['nombre_pais'] ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                        <input type="text" name="ciudad" placeholder="Nombre de la Ciudad">
                        <input type="submit" name="agregar" value="Agregar" class="btn-accion">
                    </form>

                    <?php if (isset($_POST['agregar'])) : ?>
                        <script>
                            alert("<?php echo $mensaje ?>");
                            window.location.href = 'index.php';
                        </script>
                    <?php endif ?>


                </div>

            </div>
        </div>
    </div>

    <script>
        $('#link-add-ciudad').addClass('pagina-activa');
    </script>
</body>