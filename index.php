<?php
require './classes/AutoLoad.php';
$db = new DataBase();
$usuarioManager = new ManageUsuario($db);
$mensajeManager = new ManageMensaje($db);
$comentarioManager = new ManageComentario($db);

$usuario;

$sesion = new Session();
if($sesion->isLogged()){
	$usuario = $usuarioManager->get($sesion->getUser());
} else {
	$sesion->sendRedirect("login.php");
}

$mensajes = $mensajeManager->getList(1, "fecha", 2);
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
   		
   		<div class="index">
			<div class="usuario">
				<h class="user"><?php echo $usuario->getLogin(); ?></h>
				<img src="images/<?php echo $usuario->getLogin(); ?>.jpg"/>
				<h>Nombre: <span><?php echo $usuario->getNombre(); ?></span></h>
				<h>Apellidos: <span><?php echo $usuario->getApellidos(); ?></span></h>
				<h>Correo: <span><?php echo $usuario->getEmail(); ?></span></h>
				<h>Cumpleaños: <span><?php echo $usuario->getBday(); ?></span></h>
			</div>
  			<div class="content">
  				<form action="phpmensaje.php" method="post" id="formmensaje">
  					<input type="text" name="mensaje" placeholder="¿Qué estas pensando?" id="inputmensaje"/>
   					<input type="submit" value="Enviar" id="submitmensaje"/>
  				</form>
  				
  				<div class="mensajes">
  					<?php foreach($mensajes as $index => $mensaje) { ?>
					<div class="mensaje">
						<img src="images/<?php echo $mensaje->getLogin(); ?>.jpg"/>
						<h class="login"><?php echo $mensaje->getLogin(); ?></h>
						<h class="texto"><?php echo $mensaje->getTexto(); ?></h>
						<h class="fecha"><?php echo $mensaje->getFecha(); ?></h>
						<div class="clear"></div>
					</div>
	
					<div class="comentario">
					<?php
						$comentarios = $comentarioManager->getList($mensaje->getId());
						foreach($comentarios as $index => $comentario) { 
					?>
						<div class="coment">
							<h class="login"><?php echo $comentario->getLogin(); ?></h>
							<h class="texto"><?php echo $comentario->getTexto(); ?></h>
							<h class="fecha"><?php echo $comentario->getFecha(); ?></h>
						</div>
					<?php } ?>
						<form action="phpcomentario.php" method="post" class="formcomentario">
							<input type="text" name="mensaje" placeholder="Deja tu comentario..."/>
							<input type="hidden" name="id" value="<?php echo $mensaje->getId(); ?>"/>
							<input type="submit" value="Enviar"/>
						</form>
					</div>
					<?php } ?>
  				</div>
  			</div>
   		</div>
   		
   		<footer>
   			<h class="left">Copyright by Socializate</h>
   			<h class="right">Designed by David Gamarra</h>
   		</footer>
    </body>
</html>

<?php
$db->close();