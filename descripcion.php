<?php 
session_start();
if(!isset($_SESSION['user']))header("Location: index.php");
include("connect.php");
$consulta=mysqli_query($connect, "select*from peliculas where id=$_GET[id]");
if(mysqli_num_rows($consulta)>0){
	$result=mysqli_fetch_array($consulta);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>	</title>
	<script type="text/javascript" src="./resources/jquery-3.2.1.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("button").click(function(){
				a=$(this).attr("id");
				window.location.href="./asientos.php?id="+a;
			});
		});
	</script>
</head>
<body>
		<div class="conent">
			<div class="flayer">
				<img src="<?php echo $result["imgUrl"]?>" class="imgFull">
			</div>
			<div class="info">	
				<div class="dat"><span class="strong">Nombre: </span><?php echo $result['nombre']?> </div>
				<div class="dat"><span class="strong">Director: </span><?php echo $result['director']?> </div>
				<div class="dat"><span class="strong">Duracion: </span><?php echo $result['duracion']?> </div>
				<div class="dat"><span class="strong">Hora funcion: </span><?php echo $result['hora']?> </div>
			</div>
			<div class="desc">	
				<span class="strong">Descripción </span><br>
				<?php echo $result['descripcion']?> 
			</div>
			<button id=<?php echo $_GET['id']; ?> >Comprar asientos</button>
		</div>
</body>
</html>
