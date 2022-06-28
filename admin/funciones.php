<?php
//Función para obtener el registro de la configuración del sitio
function obtenerConfiguracion()
{
    include("conexion.php");
    //Comprobamos si existe el registro 1 que mantiene la configuraciòn
    //Añadimos un alias AS total para identificar mas facil
    $query = "SELECT COUNT(*) AS total FROM configuracion";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    if ($row['total'] == '0') {
        //No existe el registro 1 - DEBO INSERTAR el registro por primera vez
        $query = "INSERT INTO configuracion (id,user,password)
        VALUES (NULL, 'admin', 'admin')";

        if (mysqli_query($conn, $query)) { //Se insertó correctamente

        } else {
            echo "No se pudo insertar en la BD" .mysqli_errno($conn);
        }
    }

    //Selecciono el registro dela configuración
    $query = "SELECT * FROM configuracion  WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $config = mysqli_fetch_assoc($result);
    return $config;
}

//Función que obtiene el total de registros de una tabla
function obtenerTotalRegistros($tabla)
{

    include("conexion.php");
    $query = "SELECT COUNT(*) id FROM $tabla";
    $result = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($result);
    return $fila['id'];
}

//funcion para agrear un nuevo tipo de propiedad a la BD
function agregarNuevoTipoDePropiedad($tipo){
    include("conexion.php");
    //armamos el query para insertar en la tabla tipos
    $query = "INSERT INTO tipos (id, nombre_tipo)
    VALUES (NULL, '$tipo')";

    //insertamos en la tabla tipos
    if (mysqli_query($conn, $query)) { //Se insertó correctamente
        $mensaje = "Tipo de Propiedad agregado correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_errno($conn);
    }
    return $mensaje;
}

//funcion para agrear un nuevo pais a la BD
function agregarNuevoPais($pais){
    include("conexion.php");
    //armamos el query para insertar en la tabla paises
    $query = "INSERT INTO paises (id, nombre_pais)
    VALUES (NULL, '$pais')";

    //insertamos en la tabla paises
    if (mysqli_query($conn, $query)) { //Se insertó correctamente
        $mensaje = "Pais agregado correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_errno($conn);
    }
    return $mensaje;
}
?>