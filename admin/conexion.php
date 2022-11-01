<?php
//datos del servidor
$server		="sql207.epizy.com";
$username	="epiz_32901060";
$password	="qPccoOGJpnfwEk";
$bd			="epiz_32901060_bd_inmobiliaria";

//creamos una conexión
$conn = mysqli_connect($server, $username, $password, $bd);

//Chequeamos la conexión
if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
}
?>

