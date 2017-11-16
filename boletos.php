<?php 
include("connect.php");
$datos=explode(",", $_POST['boletos']);
$tamano=count($datos);
for ($i=1; $i < $tamano; $i++) { 
	$nom=mysqli_fetch_array(
		mysqli_query($connect,"select nombre from asientospelicula 
					where pelicula=$datos[0] and id=$datos[$i]"));
	echo $nom['nombre']." ";
}
mysqli_close($connect);
 ?>