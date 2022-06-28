<?php

    include("conexion.php");
    $id = $_GET['idPropiedad'];

    //determino la cantidad de fotos que tiene la publicacion
    $query = "SELECT * FROM fotos WHERE id_propiedad = '$id'";
    $result = mysqli_query($conn, $query);

    $directorio = 'fotos/'.$id."/";
 
    //elimino cada uno de los archivos de las fotos de galeria de la propiedad
    while ($foto = mysqli_fetch_assoc($result)){
        $archivo = $foto['nombre_foto'];
        unlink($directorio.$archivo);
    }

    //eliminar la foto principal de la propiedad de la carpeta
    $query = "SELECT * FROM propiedades WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $foto = mysqli_fetch_assoc($result);
    $archivo = $foto['url_foto_principal'];
    unlink($archivo);

    //eliminamos la carpeta (la cual ya esta vacía)
    rmdir($directorio);

    //Primero eliminamos todas los registros del las fotos de la BD
    $query = "DELETE FROM fotos WHERE id_propiedad = '$id'";

    $result = mysqli_query($conn, $query);

    //Ahora elimino el registro de la propiedad
    $query = "DELETE FROM propiedades WHERE id = '$id'";
    mysqli_query($conn, $query);
?>
<script>
    alert("La propiedad se eliminó");
    window.location.href = 'listado-propiedades.php';
</script>