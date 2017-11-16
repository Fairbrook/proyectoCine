<?php 
	$sevirdor="localhost";
	$usuario="cineCliente";
	$contra="123";
	$db="conexion";
	$connect=@mysqli_connect($sevirdor,$usuario,$contra);
	if(!$connect){
		die('<strong>Error en la conexion</strong>'.mysqli_error());
	}
	mysqli_select_db($connect, $db)or die(mysqli_error($connect));
 ?>