<?php
require './classes/AutoLoad.php';
$sesion = new Session();
if($sesion->isLogged()){
	$sesion->sendRedirect();
} 
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Socializate</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
		<nav>
			<img src="resources/logo.png" class="logo"/>
		</nav>
   		
   		<div class="login">
   			<img src="resources/bg_login.jpg" class="background"/>
   			<form action="php/phplogin.php" method="post" id="formlogin">
   				<label for="user">Usuario</label>
   				<input type="text" name="user" id="user"/>
   				<label for="psw">Contraseña</label>
   				<input type="password" name="psw" id="psw"/>
   				<input type="submit" value="Login" id="log"/>
   				<div class="clear"></div>
   			</form>
   			
   			<form action="php/phpregister.php" method="post" id="formregister">
   				<label for="ruser">Usuario</label>
   				<input type="text" name="user" id="ruser"/>
   				<label for="email">Correo</label>
   				<input type="email" name="email" id="email"/>
   				<label for="psw1">Contraseña</label>
   				<input type="password" name="psw1" id="psw1"/>
   				<label for="psw2">Repetir</label>
   				<input type="password" name="psw2" id="psw2"/>
   				<input type="submit" value="Register" id="reg"/>
   				<div class="clear"></div>
   			</form>
			
   		</div>
   		
   		<footer>
   			<h class="left">Copyright by Socializate</h>
   			<h class="right">Designed by David Gamarra</h>
   		</footer>
    </body>
</html>