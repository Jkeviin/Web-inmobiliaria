<?php    
//controlamos que haya enviado imagen
if(isset($_FILES["foto1"])){
    $reporte = null;
    $file = $_FILES["foto1"];
    $nombre = $file['name'];
    $tipo = $file['type'];
    $ruta_provisional = $file["tmp_name"];

    if($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif'){
        $reporte = "El archivo no es una imagen";
    }else{
        //muevo la imagen desde el directorio temporal a nuestra ruta indicada
        $ruta = 'fotos/'.$id_propiedad;

        move_uploaded_file($file['tmp_name'], $ruta.'/'.$nombre);

        //OBtengo el nombre de la foto que esta guardada antes de actualizar para eliminar
        //luego el archivo del servidor
        $propiedad = obtenerPropiedadPorId($id_propiedad);
        $foto_a_borrar = $propiedad['url_foto_principal'];

        //Armamos la ruta para actualizar en la base de datos
        $query = "UPDATE propiedades SET url_foto_principal = '$ruta/$nombre' WHERE id='$id_propiedad'";

        //Actualizamos en la base de datos
        if(mysqli_query($conn, $query)){
            //se actualizó con exito
            //borro el archivo de foto anterior del servidor
            echo "foto:".$foto_a_borrar;
            unlink($foto_a_borrar);
        }else{
            echo "No se pudo insertar las imagen de la publicación".mysqli_error($conn);
        }
    }
}
?>