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
	<title>Descripcion</title>
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
	<link rel="stylesheet" type="text/css" href="./styles/styleDesc.css">
	<link rel="stylesheet" type="text/css" href="./resources/GlyphIcons/style.css">
	<script type="text/javascript" src="./resources/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="./js/exit.js"></script>
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
		<nav id="header">
			<div class="nav1">
				<a class="icon-home" id="cartelera" href="cartelera.php"> Cartelera</a>
			</div>
			<div class="nav2">
				<p>Bienvenido: <?php echo $_SESSION['user'];?></p>
				<a class="icon-exit" id="closeSession" href="#"> Exit</a>
			</div>
		</nav>
		<div class="content2">
			<div class="row">
				<div class="flayer">
					<img src="<?php echo $result["imgUrl"]?>" class="imgFull">
				</div>
				<div class="info">	
					<div class="dat"><span class="strong">Nombre: </span><?php echo $result['nombre']?> </div>
					<div class="dat"><span class="strong">Director: </span><?php echo $result['director']?> </div>
					<div class="dat"><span class="strong">Duracion: </span><?php echo $result['duracion']?> min </div>
					<div class="dat"><span class="strong">Hora funcion: </span><?php echo $result['hora']?> </div>
					<div class="desc">	
						<span class="strong">Descripción: </span>
						<?php echo $result['descripcion']?> 
					</div>
<div style="text-align: center;">
			<button class="boton1 comprar icon-ticket" id=<?php echo $_GET['id']; ?> > Comprar boletos</button>
		</div>
				</div>
			</div>

			<div id="video">
				<iframe width="560" height="315" src=<?php echo $result['videoUrl']?> frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</body>
</html>
