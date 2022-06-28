<?php
//chequeamos que haya enviado imagenes
echo "entramos al archivo procesar-foto-galeria";
if (isset($_FILES["fotos"]))
{
    $reporte = null;
        for($x=0; $x<count($_FILES["fotos"]["name"]); $x++)
        {
            $file = $_FILES["fotos"];
            $nombre = $file["name"][$x];
            $nombre = hash('ripemd160', $nombre);
            $tipo = $file["type"][$x];
            $ruta_provisional = $file["tmp_name"][$x];
            $size = $file["size"][$x];

            //$directorio = $_SERVER['DOCUMENT_ROOT'].'/imgpublicadas/';
            $directorio = 'fotos/'.$id_ultima_propiedad."/";

            if ($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif')
            {
                $reporte .= "<p style='color: red'>Error $nombre, el archivo no es una imagen.</p>";
            }
            else
            {
                if($tipo="image/jpeg"){
                    $nombre = $nombre . ".jpg";
                } else if($tipo="image/png"){
                    $nombre = $nombre . ".png";
                } else if($tipo = "image/gif"){
                    $nombre = $nombre . ".gif";
                }
                //Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
                move_uploaded_file($file['tmp_name'][$x], $directorio.$nombre);

                //Codigo para insertar imagenes a tu Base de datos.
                //Sentencia SQL
                $query = "INSERT INTO fotos (id, id_propiedad, nombre_foto) VALUES (NULL, '$id_ultima_propiedad', '$nombre')";

                //Insertamos en la tabla fotos
                if(mysqli_query($conn, $query)){//Se insertó correctamente
                //Se insertó correctamente en la base de datos de fotos.
                }else{
                    echo "No se pudo insertar la imagen de la publicacion" . mysqli_error($conn) ;
                }
            }
    }
}

?>