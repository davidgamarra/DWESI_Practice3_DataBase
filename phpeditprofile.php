<?php

require './classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUsuario($db);
$sesion = new Session();

$nombre = Request::post("nombre");
$apellidos = Request::post("apellidos");
$email = Request::post("email");
$bday = Request::post("bday");

$usuario = $userManager->get($sesion->getUser());
$usuario->setNombre($nombre);
$usuario->setApellidos($apellidos);
$usuario->setEmail($email);
$usuario->setBday($bday);

$photo = new FileUpload("photo");
$photo->setDestination("./images/");
$photo->setName($usuario->getLogin());
$photo->upload();

$userManager->set($usuario);
$sesion->sendRedirect();