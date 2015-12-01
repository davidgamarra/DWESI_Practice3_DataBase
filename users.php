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

$pagination = false;
if($usuarioManager->count() > 6){
	$page = Request::get("page");
	if($page === null){
		$page = 1;
	}
	$pagination = true;
	$pager = new Pager($usuarioManager->count(), 6, $page);
}

if(!$pagination){
	$usuarios = $usuarioManager->getList(1, "apellidos", $usuarioManager->count());
} else {
	$usuarios = $usuarioManager->getList($page, "apellidos", 6);
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
   		
   		<footer>
   			<h class="left">Copyright by Socializate</h>
   			<h class="right">Designed by David Gamarra</h>
   		</footer>
    </body>
</html>

<?php
$db->close();