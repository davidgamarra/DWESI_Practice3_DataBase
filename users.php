<?php
require './classes/AutoLoad.php';
$db = new DataBase();
$usuarioManager = new ManageUsuario($db);

$user;

$sesion = new Session();
if($sesion->isLogged()){
	$user = $usuarioManager->get($sesion->getUser());
} else {
	$sesion->sendRedirect("login.php");
}

$usuarios = $usuarioManager->getList(1, "apellidos", $usuarioManager->count());
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
			<a href="index.php"><img src="resources/logo.png" class="logo"/></a>
			<a href="phplogout.php" class="link">Logout</a>
			<a href="profile.php" class="link">Perfil</a>
			<a href="users.php" class="link">Usuarios</a>
		</nav>
   		
   		<div class="users">
   			<?php foreach($usuarios as $index => $usuario) { ?>
			<div class="usuario">
				<h class="user"><?php echo $usuario->getLogin(); ?></h>
				<img src="images/<?php echo $usuario->getLogin(); ?>.jpg"/>
				<h>Nombre: <span><?php echo $usuario->getNombre(); ?></span></h>
				<h>Apellidos: <span><?php echo $usuario->getApellidos(); ?></span></h>
				<h>Correo: <span><?php echo $usuario->getEmail(); ?></span></h>
				<h>Cumpleaños: <span><?php echo $usuario->getBday(); ?></span></h>
			</div>
  			<?php } ?>
  			<h><?php var_dump($db->getQueryError()); ?></h>
   			<h><?php var_dump($db->getConectionError()); ?></h>
   		</div>
   		
   		<footer>
   			<h class="left">Copyright by Socializate</h>
   			<h class="right">Designed by David Gamarra</h>
   		</footer>
    </body>
</html>

<?php
$db->close();