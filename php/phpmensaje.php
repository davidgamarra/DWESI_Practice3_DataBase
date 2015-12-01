<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$mensajeManager = new ManageMensaje($db);
$sesion = new Session();

$texto = Request::post("mensaje");
$usuario = $sesion->getUser();
$date = date('Y-m-d H:i:s', time());

$mensaje = new Mensaje(0, $usuario, $texto, $date);

$mensajeManager->insert($mensaje);
$sesion->sendRedirect("../index.php");