<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle();

session_destroy();
header("location: ./");
