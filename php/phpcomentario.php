<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$comentarioManager = new ManageComentario($db);
$sesion = new Session();

$texto = Request::post("mensaje");
$id = Request::post("id");
$usuario = $sesion->getUser();
$date = date('Y-m-d H:i:s', time());

$comentario = new Comentario(0, $usuario, $id, $texto, $date);

$comentarioManager->insert($comentario);
$sesion->sendRedirect("../index.php");