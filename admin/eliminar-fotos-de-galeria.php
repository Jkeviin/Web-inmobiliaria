<?php
//Convierton el campo string en un arreglo con los ids a eliminar
$idsFotos = explode(',', $idsFotos);


//$directorio = $_SERVER['DOCUMENT_ROOT'].'/imgpublicadas/';

$i=0;

while ($i < count($idsFotos)){
    $id = $idsFotos[$i];
    $query = "SELECT * FROM fotos WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $foto = mysqli_fetch_assoc($result); 
    
    //Eliminimos el archivo del disco
    $directorio = "fotos/".$foto['id_propiedad']."/"; 
    $archivo = $foto['nombre_foto'];
    unlink($directorio.$archivo);
    
    //Eliminamos la foto de la tabla
    $query = "DELETE FROM fotos WHERE id = '$id'";

    $result = mysqli_query($conn, $query);
    
    $i++;
}
?>