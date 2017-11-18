<?php
include("connect.php");
session_start();
if(!isset($_SESSION['user']))header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cartelera</title>
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
	<link rel="stylesheet" type="text/css" href="./styles/styleCartelera.css">
	<link rel="stylesheet" type="text/css" href="./resources/GlyphIcons/style.css">
	<script type="text/javascript" src="./resources/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="./js/reloj.js"></script>
	<script type="text/javascript" src="./js/exit.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("img").click(function(){
				a=$(this).attr("id");
				$.post("horaPelicula.php",{id: a},function(data){
					if(compReloj(data)==false) alert("La función ya pasó");
					else window.location.href="./descripcion.php?id="+a;
				});
			});
		});
		$(document).ready(function(){
			setInterval(printReloj,1000);
		});
	</script>
</head>
<body>
	<div class="content">

		<nav id="header">
			<div class="nav1">
				<a class="icon-home" id="cartelera" href="cartelera.php"> Cartelera</a>
			</div>
			<div class="nav2">
				<p>Bienvenido: <?php echo $_SESSION['user'];?></p>
				<a class="icon-exit" id="closeSession" href="#"> Exit</a>
			</div>
		</nav>

		<div style="width: 100%;">
			<div class="peliculas">
				<?php
				$result=mysqli_query($connect, "select id, imgUrl from peliculas");
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
						echo "<div class=flayer> <img clas=min id=".$row['id']." src=".$row["imgUrl"]."></div>";
					}
				}
				mysqli_close($connect);
				?>
			</div>
		</div>
		<div class="reloj">
			<div id="contreloj">
				Hora Actual: <span id=reloj></span>
			</div>
		</div>
	</div>
</body>
</html>