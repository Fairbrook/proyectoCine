<html>
<head>
	<title>Ingresar</title>
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
	<link rel="stylesheet" type="text/css" href="./styles/styleIndex.css">
	<link rel="stylesheet" type="text/css" href="./resources/GlyphIcons/style.css">
</head>
<body>
	<div class="content">
		<div id="ingresar">
			<div id="tIndex"><P>INGRESAR</P></div>
			<p id='mensaje'></p>
			<form action='index.php' method='POST'>
				<div class="datos">
					<div class="inLabel">Nombre de usuario: </div> <div class="inTxt"><input type='text' name='user' class="input1 icon-user" placeholder="&#xe902; User Name"></div>
				</div>
				<div class="datos">
					<div class="inLabel">Contraseña:</div>
					<div class="inTxt"><input type='password' name='pass' class="input1 icon-key" placeholder="&#xe903; Password"></div>
				</div>
				<input type='submit' value='Log In' class="botonLogIn">
			</form>
		</div>
	</div>
</body>
</html>

<?php
include("connect.php");
session_start();
if(isset($_SESSION['user']))header("Location: cartelera.php");
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$username=mysqli_real_escape_string($connect, $_POST['user']);
		$password=mysqli_real_escape_string($connect, $_POST['pass']);
		$auth=mysqli_query($connect,"SELECT * FROM usuario WHERE username='$username' and password=sha('$password')");
		if(mysqli_num_rows($auth)==1){
			$result=mysqli_fetch_array($auth);
			$_SESSION['user']=$username;
			$_SESSION['id']=$result['ID'];
			header("Location: cartelera.php");
		}else{
			echo "<script Language='JavaScript'>document.getElementById('mensaje').innerHTML='Usuario o contraseña incorrecta';</script>";
		}
	}
	mysqli_close($connect);
	?>