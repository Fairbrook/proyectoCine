<?php
session_start();
include("connect.php");
$datos=explode(",", $_POST['compra']);
$maxId=mysqli_fetch_array(mysqli_query($connect,"select max(id) 'max' from compra"));
$precio=mysqli_fetch_array(mysqli_query($connect,"select precio from peliculas where id=$datos[0]"));
$tamano=count($datos);
mysqli_query($connect,"insert into compra values($maxId[max]+1,$tamano*,$datos[0])");
for ($i=1; $i < $tamano; $i++) { 
	mysqli_query($connect,"insert into asientoscompra (asiento,compra) values ($datos[$i], $maxId[max]+1)");
}
echo "completado";
?>