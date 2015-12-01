<?php
require '../classes/AutoLoad.php';

$sesion = new Session();
$sesion->destroy();
$sesion->sendRedirect("../login.php");