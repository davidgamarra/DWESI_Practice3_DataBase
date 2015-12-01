<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUsuario($db);
$sesion = new Session();

$user = Request::post("user");
$email = Request::post("email");
$pass1 = Request::post("psw1");
$pass2 = Request::post("psw2");

$disponible = $userManager->get($user);

if($pass1 === $pass2 && $disponible->getLogin() === null){
	$usuario = new Usuario($user, $pass1, $email);
	$userManager->insert($usuario);
	
	$sesion->setUser($user);
	$sesion->sendRedirect("../profile.php");
} else {
	$sesion->sendRedirect("../login.php");	
}
