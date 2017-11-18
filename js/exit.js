$(document).ready(function(){
			$("#closeSession").click(function(){
				$.post("cerrarSesion.php",function(){
					window.location.href="index.php";
				});
			});
		});