<?php

session_start(); //on démarre une session
//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/attentemanager.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/model/user.php");
$manager = new attentemanager();


$idUser = $_GET['idUser'];


$manager->activer($idUser);



?>