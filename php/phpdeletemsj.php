<?php
require '../classes/AutoLoad.php';
$db = new DataBase();
$manager = new ManageMensaje($db);
$id = Request::post("id");
$r = $manager->delete($id);
echo $r;
header("Location:../profile.php");