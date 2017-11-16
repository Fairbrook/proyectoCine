<!--link rel='STYLESHEET' type='text/css' href='style1.css'-->
<html>
<head>
	<title>Ingresar</title>
</head>
<body>
	<div>
		<P>INGRESAR</P>
		<p id='mensaje'></p>
		<form action='index.php' method='POST'>
			Username:<input type='text' name='user' class="input1"> <br>
			Contraseña: <input type='password' name='pass' class="input1">
			<input type='submit' value='Log In' class="boton">
		</form>
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
	$auth=mysqli_query($connect,"SELECT * FROM usuario WHERE username='$username' and password=sha($password)");
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