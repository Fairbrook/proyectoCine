<?php
session_start();
if(!isset($_SESSION['user']))header("Location: index.php");
include("connect.php");
if(isset($_GET['id'])){	
	$result=mysqli_query($connect,"select ID, status from asientosPelicula where pelicula=$_GET[id]");
	$pelicula=mysqli_fetch_array(mysqli_query($connect,"select*from peliculas where id=$_GET[id]"));
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Seleccionar asientos</title>
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./resources/GlyphIcons/style.css">
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
	<link rel="stylesheet" type="text/css" href="./styles/styleAsientos.css">
	<link rel="stylesheet" type="text/css" href="./styles/confirm.css">
	<link rel="stylesheet" type="text/css" href="./resources/GlyphIcons/style.css">
	<script type="text/javascript" src="./resources/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="./js/cookies.js"></script>
	<script type="text/javascript" src="./js/asientos.js"></script>
	<script type="text/javascript" src="./js/exit.js"></script>
	<script type="text/javascript">
		var select="";
		$(document).ready(function(){
			value=$("#user").val();
			peli=$(".pelicula").attr("id");
			select=setSelect(value, peli);
		});

		$(document).ready(function(){
			$(".estado0").click(function(){
				value=$("#user").val();
				select=changeSelect(select,this,value);

			});
		});

		$(document).ready(function(){
			$("#finalizar").click(function(){
				value=$("#user").val();
				str=getcookie("asientos"+value);
				if(str.search(",")!=-1){
					$.post("boletos.php",{boletos:str},function(data){
						$("#boletos").html(data);
						$("#finalizar").css("display","none");
						$("#confir").attr("class","confirDisplay");
					});
				}else{
					alert("Seleccione al menos un asiento");
				}
			});
		});

		$(document).ready(function(){
			$("#confirmar").click(function(){
				str=getcookie("asientos"+value);
				$.post("compra.php",{compra: str},function(data){
					if(data=="completado"){
						$("#confirmBoletos").html("<h3 class=strong>Operacion realizada con exito</h3>");
						$("#aceptar").css("display","block");
						deletecookie("asientos"+value,"","");
					}
				});
			});
		});

		$(document).ready(function(){
			$("#cancelar").click(function(){
				str=getcookie("asientos"+value);
				$("#confir").attr("class","confirHidden");
				$("#finalizar").css("display","initial");
			});
		});

		$(document).ready(function(){
			$("#aceptar").click(function(){
				str=getcookie("asientos"+value);
				window.location.href="cartelera.php";
			});
		});
	</script>
</head>
<body>

	<nav id="header">
		<div class="nav1">
			<a class="icon-home" id="cartelera" href="cartelera.php"> Cartelera</a>
		</div>
		<div class="nav2">
			<p>Bienvenido: <?php echo $_SESSION['user'];?></p>
			<a class="icon-exit" id="closeSession" href="#"> Exit</a>
		</div>
	</nav>

	<div class="content pelicula" id=<?php echo $_GET['id']?>>
		<input type="hidden" id="user" value=<?php echo $_SESSION['id']?>>
		<div class="row-res">
			<div></div>
			<div id="aux">
				<div id="sala">
					<?php
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_assoc($result)){
							echo "<div class=asiento >
							<span class='icon-event_seat estado".$row["status"]."' id=".$row["ID"]."></span>
							</div>";
						}
					}
					?>
				</div>
			</div>
			<div id="tipo">
				<div class="row">
					<div id="disponible"></div>
					<div class="txt">Disponible</div>
				</div>
				<div class="row">
					<div id="ocupado"></div>
					<div class="txt">Ocupado</div>
				</div>
				<div class="row">
					<div id="seleccionado"></div> 
					<div class="txt">Seleccionado</div>
				</div>
			</div>
		</div>
		<button class="boton1" id="finalizar">Finalizar compra</button>
	</div>

	<div id="confir" class="confirHidden">
		<div class="cont1">
		<div id="confirmBoletos">
			<h3 class="strong">Comprar boletos</h3>
			<div class="row1">
				<div class="flayer">
					<img src=<?php echo $pelicula['imgUrl']?> class="imgFull">
				</div>
				<div class="info">	
					<div class="dat">
						<span class="strong">Nombre: </span>
						<?php echo $pelicula['nombre']?>
					</div>
					<div class="dat">
						<span class="strong">Director: </span>
						<?php echo $pelicula['director']?>
					</div>
					<div class="dat">
						<span class="strong">Duracion: </span>
						<?php echo $pelicula['duracion']?> min
					</div>
					<div class="dat">
						<span class="strong">Hora funcion: </span>
						<?php echo $pelicula['hora']?> 
					</div>
					<div class="dat" id="boletos"></div>
				</div>
			</div>
			<button class="boton1" id="confirmar">Confirmar</button>
			<button class="boton1" id="cancelar">Cancelar</button>
		</div>
		<button class="boton1" id="aceptar" style="display: none;">Aceptar</button>
	</div>
	</div>
</body>
</html>
<?php mysqli_close($connect);?>