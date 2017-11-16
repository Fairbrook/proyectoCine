<?php 
include("connect.php");
$result=mysqli_fetch_array(mysqli_query($connect,"select hora from peliculas where id=$_POST[id]"));
echo $result['hora'];
 ?>