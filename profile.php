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

$pagination = false;
if($mensajeManager->count("login = :login", array("login"=>$usuario->getLogin())) > Constant::NRPP){
	$page = Request::get("page");
	if($page === null){
		$page = 1;
	}
	$pagination = true;
	$pager = new Pager($mensajeManager->count("login = :login", array("login"=>$usuario->getLogin())), Constant::NRPP, $page);
}

if(!$pagination){
	$mensajes = $mensajeManager->getList(1, "fecha desc", $mensajeManager->count("login = :login", array("login"=>$usuario->getLogin())), 
									 "login = :login", array("login"=>$usuario->getLogin()));
} else {
	$mensajes = $mensajeManager->getList($page, "fecha desc", 10, "login = :login", array("login"=>$usuario->getLogin()));
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
			<a href="index.php"><img src="resources/logo.png" class="logo"/></a>
			<a href="php/phplogout.php" class="link">Logout</a>
			<a href="profile.php" class="link">Perfil</a>
			<a href="users.php" class="link">Usuarios</a>
		</nav>
   		
   		<div class="index">
			<div class="usuario">
				<h class="user"><?php echo $usuario->getLogin(); ?></h>
				<img src="images/<?php echo $usuario->getLogin(); ?>.jpg"/>
				<form action="php/phpeditprofile.php" method="post" id="formprof" enctype="multipart/form-data">
					<input type="file" name="photo" class="file"/>
					<h>Nombre: <input type="text" name="nombre" value="<?php echo $usuario->getNombre(); ?>"/></h>
					<h>Apellidos: <input type="text" name="apellidos" value="<?php echo $usuario->getApellidos(); ?>"/></h>
					<h>Correo: <input type="text" name="email" value="<?php echo $usuario->getEmail(); ?>"/></h>
					<h>Cumpleaños: <input type="text" name="bday" value="<?php echo $usuario->getFecha(); ?>"/></h>
					<input type="submit" value="Guardar" id="guardarperfil"/>
					<div class="clear"></div>
				</form>
			</div>
  			<div class="content">  				
  				<div class="mensajes">
  					<?php foreach($mensajes as $index => $mensaje) { ?>
					<div class="mensaje">
						<img src="images/<?php echo $mensaje->getLogin(); ?>.jpg"/>
						<h class="login"><?php echo $mensaje->getLogin(); ?></h>
						<h class="texto"><?php echo $mensaje->getTexto(); ?></h>
						<h class="fecha"><?php echo $mensaje->getFecha(); ?></h>
						<form action="php/phpdeletemsj.php" method="post">
							<input type="hidden" name="id" value="<?php echo $mensaje->getId(); ?>"/>
							<input type="submit" value="Eliminar" id="eliminarmensaje"/>
						</form>
						<div class="clear"></div>
					</div>
					
						<?php $comentarios = $comentarioManager->getList($mensaje->getId()); ?>
						<?php if(count($comentarios)>0) { ?>
						<div class="comentario">
							<?php foreach($comentarios as $index => $comentario) { ?>
							<div class="coment">
								<h class="login"><?php echo $comentario->getLogin(); ?></h>
								<h class="texto"><?php echo $comentario->getTexto(); ?></h>
								<h class="fecha"><?php echo $comentario->getFecha(); ?></h>
							</div>
							<?php } ?>
						</div>
						<?php } ?>
					<?php } ?>
  				</div>
  				
  				<div class="clear"></div>
   			
				<?php if($pagination){ ?>
				<div class="pagination">
					<a href="?page=<?= $pager->getFirst() ?>">&lt;&lt; </a>
					<a href="?page=<?= $pager->getPrevious() ?>">&lt; </a>
					<a href="?page=<?= $pager->getLast() ?>">&gt;&gt; </a>
					<a href="?page=<?= $pager->getNext() ?>">&gt; </a>
				</div>
				<?php } ?>
				<div class="clear"></div>
				
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