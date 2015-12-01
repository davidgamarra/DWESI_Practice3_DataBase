<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUsuario($db);

$user = Request::post("user");
$pass = Request::post("psw");

$usuario = $userManager->get($user);
$sesion = new Session();

if($usuario !== null && $usuario->getPsw() === $pass){
	$sesion->setUser($user);
}
$sesion->sendRedirect("../index.php");