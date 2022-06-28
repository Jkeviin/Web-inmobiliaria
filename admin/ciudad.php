<?php

include("conexion.php");
$pais = $_GET['c'];
echo 

//Armamos el query para seleccionar las ciudades
$query = "SELECT * FROM ciudades WHERE id_pais='$pais'";

//Ejecutamos la consulta
$resultado_ciudades = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($resultado_ciudades)){
    echo '<option value="'.$row['id'].'">';
    echo $row['nombre_ciudad'];
    echo '</option>';
}

?>