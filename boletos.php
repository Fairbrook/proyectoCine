<?php 
include("connect.php");
$datos=explode(",", $_POST['boletos']);
$tamano=count($datos);
$boletos="";
for ($i=1; $i < $tamano; $i++) { 
	$nom=mysqli_fetch_array(
		mysqli_query($connect,"select nombre from asientospelicula 
					where pelicula=$datos[0] and id=$datos[$i]"));
	$boletos= $boletos.$nom['nombre']." ";
}
$precio=mysqli_fetch_array(mysqli_query($connect,"select precio from peliculas where id=$datos[0]"));
$total=$precio["precio"]*($tamano-1);
echo "<div>";
echo "<span class=strong>Boletos: </span>";
echo $boletos;
echo "</div>";
echo "<div>";
echo "<span class=strong>Total: </span>$";
echo $total;
echo "</div>";				

mysqli_close($connect);
 ?>