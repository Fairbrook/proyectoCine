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
	<title></title>
	<link rel="stylesheet" type="text/css" href="./resources/GlyphIcons/style.css">
	<link rel="stylesheet" type="text/css" href="./styles/confirm.css">
	<script type="text/javascript" src="./resources/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="./js/cookies.js"></script>
	<script type="text/javascript" src="./js/asientos.js"></script>
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
				$.post("boletos.php",{boletos:str},function(data){
					if(data!=""){
						$("#boletos").html(data);
						$("#confir").attr("class","confirDisplay");
					}else{
						alert("Seleccione al menos un asiento");
					}
				});
			});
		});

		$(document).ready(function(){
			$("#confirmar").click(function(){
				str=getcookie("asientos"+value);
				$.post("compra.php",{compra: str},function(data){
					if(data=="completado"){
						$("#confirmBoletos").html("Operacion realizada con exito");
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
	<div class="content pelicula" id=<?php echo $_GET['id']?>>
		<input type="hidden" id="user" value=<?php echo $_SESSION['id']?>>
		<?php
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				echo "<div class=asiento >
				<span class='icon-event_seat estado".$row["status"]."' id=".$row["ID"]."></span>
				</div>";
			}
		}
		?>
		<button id="finalizar">Finalizar compra</button>
	</div>
	<div id="confir" class="confirHidden">
		<div id="confirmBoletos">
			<h3>Comprar boletos</h3>
			<div class="flayer">
				<img src=<?php echo $pelicula['imgUrl']?> class="imgFull">
			</div>
			<div class="info">	
				<div class="dat"><span class="strong">Nombre: </span><?php echo $pelicula['nombre']?> </div>
				<div class="dat"><span class="strong">Director: </span><?php echo $pelicula['director']?> </div>
				<div class="dat"><span class="strong">Duracion: </span><?php echo $pelicula['duracion']?> </div>
				<div class="dat"><span class="strong">Hora funcion: </span><?php echo $pelicula['hora']?> </div>
				<div class="dat"><span class="strong">Boletos: </span> <span id="boletos"></span></div>
			</div>
			<button id="confirmar">Aceptar</button>
			<button id="cancelar">Cancelar</button>
		</div>
		<button id="aceptar" style="display: none;">Aceptar</button>
	</div>
</body>
</html>