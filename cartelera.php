<?php
include("connect.php");
session_start();
if(!isset($_SESSION['user']))header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="./resources/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="./js/reloj.js"></script>
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
	<div>
		<?php
		$result=mysqli_query($connect, "select id, imgUrl from peliculas");
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				echo "<div class=flayer> <img clas=min id=".$row['id']." src=".$row["imgUrl"]."></div>";
			}
		}
		mysqli_close($connect);
		?>
		<div id=reloj></div>
	</div>
</body>
</html>