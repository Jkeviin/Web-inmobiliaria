<?php
session_start();

if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
}



//funcion que me perimete obtener una propiedad por id

function obtenerPropiedadPorId($id_propiedad)
{
    //Obtenemos la propiedad en base al id que recibimos por GET
    include("conexion.php");

    //Armamos el query para seleccionar la propiedad
    $query = "SELECT * FROM propiedades WHERE id='$id_propiedad'";

    //Ejecutamos la consulta
    $resultado_propiedad = mysqli_query($conn, $query);
    $propiedad = mysqli_fetch_assoc($resultado_propiedad);
    return $propiedad;
}
//tomo el id que me recibí y busco la propiedad
$id_propiedad = $_GET['id'];
$propiedad = obtenerPropiedadPorId($id_propiedad);

/************************************************************* */

function obtenerFotosGaleriaDePropiedad($id_propiedad)
{
    include("conexion.php");

    //Armamos el query para seleccionar las fotos
    $query = "SELECT * FROM fotos WHERE id_propiedad='$id_propiedad'";

    //Ejecutamos la consulta
    $galeria = mysqli_query($conn, $query);
    return $galeria;
}

/********************************************************/
//SELECCIONAMOS LOS TIPOS DE PROPIEDADES
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los tipos
$query = "SELECT * FROM tipos";

//Ejecutamos la consulta
$resultado_tipos = mysqli_query($conn, $query);
/******************************************************/

/********************************************************/
//SELECCIONAMOS LOS PAISES
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los paises
$query = "SELECT * FROM paises";

//Ejecutamos la consulta
$resultado_paises = mysqli_query($conn, $query);
/********************************************************/

/********************************************************/
//SELECCIONAMOS LAS CIUDADES
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los paises
$query = "SELECT * FROM ciudades WHERE id_pais='$propiedad[pais]'";

//Ejecutamos la consulta
$resultado_ciudades = mysqli_query($conn, $query);
/********************************************************/


/******************************************************* */
//GUARDAMOS LA PROPIEDAD
if (isset($_POST['actualizar'])) {
    //nos conectamos a la base de datos
    include("conexion.php");

    //tomamos los datos que vienen del formulario
    $id_propiedad = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $ubicacion = $_POST['ubicacion'];
    $habitaciones = $_POST['habitaciones'];
    $banios = $_POST['banios'];
    $pisos = $_POST['pisos'];
    $garage = $_POST['garage'];
    $dimensiones = $_POST['dimensiones'];
    $precio = $_POST['precio'];
    $url_galeria = "url";
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $propietario = $_POST['nombre_propietario'];
    $telefono_propietario = $_POST['telefono_propietario'];


    //armamos el query para insertar en la tabla propiedades
    ///S E G U I R A Q U I!!!!!!!!!!!!!!!!!!!!
    $query = "UPDATE propiedades SET
     titulo='$titulo', 
     descripcion='$descripcion', 
     tipo='$tipo', 
     estado='$estado', 
     ubicacion='$ubicacion', 
     habitaciones='$habitaciones', 
     banios='$banios', 
     pisos='$pisos', 
     garage='$garage', 
     dimensiones='$dimensiones', 
     precio='$precio', 
     pais='$pais',
     ciudad='$ciudad',
     propietario='$propietario',
     telefono_propietario='$telefono_propietario'
     WHERE id='$id_propiedad'";

    //insertamos en la tabla propiedades
    if (mysqli_query($conn, $query)) { //Se insertó correctamente

        //Actualizamos la foto principal en caso que la haya cambiado
        if ($_POST['fotoPrincipalActualizada'] == "si") {
            include("actualizar-foto-principal.php");
        }

        if ($_POST['fotosGaleriaActualizada'] == "si") {
            //Agrego las fotos nuevas
            $id_ultima_propiedad = $id_propiedad;
            include("procesar-fotos-galeria.php");
        }

        //Prgunto si se eliminarion fotos
        $idsFotos =  $_POST['fotosAEliminar'];
        if ($idsFotos != "") {
            include("eliminar-fotos-de-galeria.php");
        }

        $mensaje = "La propiedad se actualizó correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_error($conn);
    }
}


/******************************************************* */


?>


<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAPI - ADMIN</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="estilo.css">
    <script>
        function muestraselect(str) {
            var conexion;

            if (str == "") {
                document.getElementById("ciudad").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                conexion = new XMLHttpRequest();
            }

            conexion.onreadystatechange = function() {
                if (conexion.readyState == 4 && conexion.status == 200) {
                    document.getElementById("ciudad").innerHTML = conexion.responseText;
                }
            }

            conexion.open("GET", "ciudad.php?c=" + str, true);
            conexion.send();

        }
    </script>
</head>

<body>

    <?php include("header.php"); ?>

    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            
            <div id="actualizar-propiedad">
                <h2>Actualizar propiedad</h2>
                <hr>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo $propiedad['id'] ?>">
                    <div class="fila-una-columna">
                        <label for="titulo">Título de la Propiedad</label>
                        <input type="text" name="titulo" value="<?php echo $propiedad['titulo'] ?>" required class="input-entrada-texto">
                    </div>

                    <div class="fila-una-columna">
                        <label for="descripcion">Descripción de la Propiedad</label>
                        <textarea name="descripcion" id="" cols="30" rows="10" class="input-entrada-texto"><?php echo $propiedad['descripcion'] ?></textarea>
                    </div>

                    <div class="fila">

                        <div class="box">
                            <label for="tipo">Tipo de propiedad</label>
                            <select name="tipo" id="" class="input-entrada-texto">
                                <?php while ($row = mysqli_fetch_assoc($resultado_tipos)) : ?>
                                    <?php if ($row['id'] == $propiedad['tipo']) : ?>
                                        <option value="<?php echo $row['id'] ?>" selected>
                                            <?php echo $row['nombre_tipo'] ?>
                                        </option>
                                    <?php else : ?>
                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row['nombre_tipo'] ?>
                                        </option>
                                    <?php endif ?>
                                <?php endwhile ?>
                            </select>
                        </div>


                        <div class="box">
                            <label for="estado">Elija estado de la propiedad</label>
                            <select name="estado" id="" class="input-entrada-texto">
                                <option value="venta" <?php if ($propiedad['estado'] == "Venta") {
                                                            echo "selected";
                                                        } ?>>Venta</option>
                                <option value="Alquiler" <?php if ($propiedad['estado'] == "Alquiler") {
                                                                echo "selected";
                                                            } ?>>Alquiler</option>
                            </select>
                        </div>

                        <div class="box">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" name="ubicacion" value="<?php echo $propiedad['ubicacion'] ?>" class="input-entrada-texto">
                        </div>
                    </div>


                    <div class="fila">
                        <div class="box">
                            <label for="habitaciones">Habitaciones</label>
                            <input type="text" name="habitaciones" value="<?php echo $propiedad['habitaciones'] ?>" class="input-entrada-texto">
                        </div>

                        <div class="box">
                            <label for="baños">Baños</label>
                            <input type="text" name="banios" value="<?php echo $propiedad['banios'] ?>" class="input-entrada-texto">
                        </div>

                        <div class="box">
                            <label for="pisos">Pisos</label>
                            <input type="text" name="pisos" value="<?php echo $propiedad['pisos'] ?>" class="input-entrada-texto">
                        </div>

                    </div>


                    <div class="fila">
                        <div class="box">
                            <label for="garage">Garage</label>
                            <select name="garage" id="" class="input-entrada-texto">
                                <option value="No" <?php if ($propiedad['garage'] == "No") {
                                                        echo "selected";
                                                    } ?>>No</option>
                                <option value="Si" <?php if ($propiedad['garage'] == "Si") {
                                                        echo "selected";
                                                    } ?>>Si</option>
                            </select>
                        </div>

                        <div class="box">
                            <label for="dimensiones">Dimensiones</label>
                            <input type="text" name="dimensiones" value="<?php echo $propiedad['dimensiones'] ?>" class="input-entrada-texto">
                        </div>

                        <div class="box">
                            <label for="precio">Precio (Alquiler o Venta)</label>
                            <input type="text" name="precio" value="<?php echo $propiedad['precio'] ?>" class="input-entrada-texto">
                        </div>
                    </div>

                    <h2>Galería de Fotos</h2>
                    <div class="">
                        
                        <p>Foto principal (<label for="foto1" class="btn-cambiar-foto">Cambiar foto</label>)</p>
                        <output id="list" class="contenedor-foto-principal">
                            <img src="<?php echo $propiedad['url_foto_principal'] ?>" alt="">
                        </output>
                        
                        <input type="file" id="foto1" accept="image/*" name="foto1" style="display:none">
                        <input type="hidden" id="fotoPrincipalActualizada" name="fotoPrincipalActualizada">
                    </div>

                    <div>
                        <p>Galería ( <label for="fotos" class="btn-cambiar-foto">Agregar mas Fotos</label>)</p>
                        <input type="hidden" id="fotosAEliminar" name="fotosAEliminar">
                        <div id="contenedor-fotos-publicacion">
                            <?php
                            $galeria = obtenerFotosGaleriaDePropiedad($propiedad['id']);
                            $i = 1; ?>
                            <?php while ($foto = mysqli_fetch_assoc($galeria)) : ?>
                                <output class="contenedor-foto-galeria" id="<?php echo $i ?>">
                                    <img src="fotos/<?php echo $propiedad['id'] . "/" . $foto['nombre_foto'] ?>" class="foto-galeria">

                                    <span class="eliminar" id="<?php echo $foto['id'] ?>" onclick="eliminarFoto(<?php echo $foto['id'] ?>, <?php echo $i ?>)"> Eliminar</i></span>
                                </output>
                            <?php
                                $i++;
                            endwhile
                            ?>
                        </div>

                        <div id="contenedor-fotos-nuevas">
            
                        </div>

                        <input type="file" id="fotos" accept="image/*" name="fotos[]" value="Foto" multiple="" style="display:none">
                        <input type="hidden" id="fotosGaleriaActualizada" name="fotosGaleriaActualizada">

                    </div>


                    <div class="fila">
                        <div class="box">
                            <label for="pais"> País de la Propiedad</label>
                            <select name="pais" id="" onchange="muestraselect(this.value)" class="input-entrada-texto">
                                <?php while ($row = mysqli_fetch_assoc($resultado_paises)) : ?>
                                    <?php if ($row['id'] == $propiedad['pais']) : ?>
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
                        </div>

                        <div class="box">
                            <label for="ciudad">Ciudad de la propiedad</label>
                            <select name="ciudad" id="ciudad" class="input-entrada-texto">
                                <?php while ($row = mysqli_fetch_assoc($resultado_ciudades)) : ?>
                                    <?php if ($row['id'] == $propiedad['ciudad']) : ?>
                                        <option value="<?php echo $row['id'] ?>" selected>
                                            <?php echo $row['nombre_ciudad'] ?>
                                        </option>
                                    <?php else : ?>
                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row['nombre_ciudad'] ?>
                                        </option>
                                    <?php endif ?>
                                <?php endwhile ?>
                            </select>
                        </div>


                        <div class="box">
                            <label for="propietario">Nombre del propietario</label>
                            <input type="text" name="nombre_propietario" value="<?php echo $propiedad['propietario'] ?>" class="input-entrada-texto">
                        </div>


                    </div>

                    <div class="fila">
                        <div class="box">
                            <label for="telefono_propietario">Teléfono del propietario</label>
                            <input type="text" name="telefono_propietario" value="<?php echo $propiedad['telefono_propietario'] ?>"  class="input-entrada-texto">
                        </div>
                    </div>


                    <input type="submit" value="Actualizar Datos" name="actualizar" class="btn-accion">

                </form>
            </div>
        </div>

    </div>


    <?php if (isset($_POST['actualizar'])) : ?>

        <script>
            alert("<?php echo $mensaje ?>");
            window.location.href = 'listado-propiedades.php';
        </script>

    <?php endif ?>

    <script src="script.js"></script>
    <script src="subirFoto.js"></script>
    <script src="scriptFotosNuevas.js"></script>
</body>

</html>