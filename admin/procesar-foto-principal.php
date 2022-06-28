<?php

//variable donde se guardara el id de la ultima propiedad insertada
$id_ultima_propiedad = null;

//Ahora vamos a crear el directorio de la propiedad, para guardar las fotos allí
//armamos el query para obtener el ultim id insertado de la tabla propiedades
$query = "SELECT * FROM propiedades ORDER BY id DESC limit 1";

$resultado = mysqli_query($conn, $query);

if(mysqli_num_rows($resultado)){//obtuvimos el ultimo
    //guardo el resultado en un registro para manejarlo
    $propiedad = mysqli_fetch_assoc($resultado);
    $id_ultima_propiedad = $propiedad['id'];

    //creo un directorio con el id de la ultima propiedad para guardar las imagenes
    //$directorio = $_SERVER['DOCUMENT_ROOT'].'/sapi/admin/fotos/'.$id_ultima_propiedad;
    //echo $directorio;
    $directorio = 'fotos/'.$id_ultima_propiedad;

    if(!file_exists($directorio)){
        //Asegurarse que la carpetas tengan permisos de escritura
        mkdir($directorio,0777, true);
        
    }

    //$_FILES es un array asociativo que contiene los datos de todas las imagenes que se subieron, contiene name, type, tmp_name, error y size.
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
            move_uploaded_file($file['tmp_name'], $directorio.'/'.$nombre);

            //Armamos la ruta para insertar en la base de datos
            $ruta = 'fotos/'.$id_ultima_propiedad;
            $query = "UPDATE propiedades SET url_foto_principal = '$ruta/$nombre' WHERE id='$id_ultima_propiedad'";

            //Actualizamos en la base de datos
            if(mysqli_query($conn, $query)){
                //se actualizó con exito
            }else{
                echo "No se pudo insertar las imagen de la publicación".mysqli_error($conn);
            }
        }

    }


}else{
    $mensaje = "No se pudo seleccionar el última propiedad".mysqli_error($conn);
}


?>