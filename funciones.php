<?php
function obtenerConfiguracion()
{
    include("admin/conexion.php");
    //Comprobamos si existe el registro 1 que mantiene la configuraciòn
    //Añadimos un alias AS total para identificar mas facil
    $query = "SELECT COUNT(*) AS total FROM configuracion";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    if ($row['total'] == '0') {
        echo "Valor" . $row['total'];
        //No existe el registro 1 - DEBO INSERTAR el registro por primera vez
        $query = "INSERT INTO configuracion (id,user,password)
        VALUES (NULL, 'admin', 'admin')";

        if (mysqli_query($conn, $query)) { //Se insertó correctamente

        } else {
            echo "No se pudo insertar en la BD" . mysqli_error($conn);
        }
    }

    //El regist
    $query = "SELECT * FROM configuracion  WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $config = mysqli_fetch_assoc($result);
    return $config;
}

function obtenerTodasLasCiudades()
{
    include("admin/conexion.php");
    $query = "SELECT * FROM ciudades";
    $result = mysqli_query($conn, $query);
    return $result;
}

function obtenerTodosLosTipos()
{
    include("admin/conexion.php");
    $query = "SELECT * FROM tipos";
    $result = mysqli_query($conn, $query);
    return $result;
}

function cargarPropiedades($limInferior){
    include("admin/conexion.php");
    $config = obtenerConfiguracion();
    if($config['tipo_visualizacion_propiedades']=="f"){ //Visualizamos por fecha de carga
        $query = "SELECT * FROM propiedades  ORDER BY fecha_alta DESC LIMIT 50";
        $result = mysqli_query($conn, $query);
        return $result;
    } else {//visualizamos las primeras prop. de forma personalizada
        $query = "SELECT * FROM propiedades where 
                id='$config[propiedad1]' or 
                id='$config[propiedad2]' or 
                id='$config[propiedad3]' or 
                id='$config[propiedad4]' or 
                id='$config[propiedad5]' or 
                id='$config[propiedad6]'
            UNION
            SELECT * FROM propiedades where 
                id!='$config[propiedad1]' and 
                id!='$config[propiedad2]' and
                id!='$config[propiedad3]' and
                id!='$config[propiedad4]' and
                id!='$config[propiedad5]' and
                id!='$config[propiedad6]' LIMIT $limInferior,6";
        $result = mysqli_query($conn, $query);
        return $result;
    }
}

function obtenerPropiedadPorId($id_propiedad)
{
    //Obtenemos la propiedad en base al id que recibimos por GET
    include("admin/conexion.php");

    //Armamos el query para seleccionar la propiedad
    $query = "SELECT * FROM propiedades WHERE id='$id_propiedad'";

    //Ejecutamos la consulta
    $resultado_propiedad = mysqli_query($conn, $query);
    $propiedad = mysqli_fetch_assoc($resultado_propiedad);
    return $propiedad;
}

function obtenerCiudad($id_ciudad)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM ciudades WHERE id='$id_ciudad'";

    //Ejecutamos la consulta
    $resultado_ciudad = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_ciudad);
    if($row['id']==""){
        return "";
    } else {
        return $row['nombre_ciudad'];
    }
}

function obtenerPais($id_pais)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM paises WHERE id='$id_pais'";

    //Ejecutamos la consulta
    $resultado_pais = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_pais);
    
    return $row['nombre_pais'];
}

function obtenerFotosGaleria($id_propiedad)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM fotos WHERE id_propiedad='$id_propiedad'";

    //Ejecutamos la consulta
    $resultado_fotos = mysqli_query($conn, $query);

    return $resultado_fotos;
}

function obtenerTipo($id_tipo)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM tipos WHERE id='$id_tipo'";

    //Ejecutamos la consulta
    $resultado_tipo = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_tipo);
    if($row['id']==""){
        return "";
    } else {
        return $row['nombre_tipo'];
    }
}

function realizarBusqueda($id_ciudad, $id_tipo, $estado, $precio_minimo, $precio_maximo, $habitaciones_b) {
    include("admin/conexion.php");

    $id_ciudad !== "" ? $id_ciudad = "AND ciudad='$id_ciudad'" : $id_ciudad = "";
    $id_tipo !== "" ? $id_tipo = "AND tipo='$id_tipo'" : $id_tipo = "";
    $estado !== "" ? $estado = "AND estado='$estado'" : $estado = "";
    $precio_minimo !== "" ? $precio_minimo = "AND precio>='$precio_minimo'" : $precio_minimo = "";
    $precio_maximo !== "" ? $precio_maximo = "AND precio<='$precio_maximo'" : $precio_maximo = "";
    $habitaciones_b !== "" ? $habitaciones_b = "AND habitaciones>='$habitaciones_b'" : $habitaciones_b = "";

    $query = "SELECT * FROM propiedades WHERE 1=1 $id_ciudad $id_tipo $estado $precio_minimo $precio_maximo $habitaciones_b";

    //Ejecutamos la consulta
    $resultado_propiedades = mysqli_query($conn, $query);
    return $resultado_propiedades;
}
?>