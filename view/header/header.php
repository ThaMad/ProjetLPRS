<?php
session_start();
$_SESSION['page'] = 'index';
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");
$manager = new Manager();
$bdd = $manager->connexion_bdd();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="author" content="themefisher.com">

    <title>Lycée Robert Schuman</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" src="../ProjetLPRS/images/favicon.ico"/>

    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
    <!-- Slick Slider  CSS -->
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">
    <link href="plugins/toastr/css/toastr.min.css" rel="stylesheet" />


    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="scss/templates/_slider.scss">


</head>

<body id="top">
<header>
    <div class="header-top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <ul class="top-bar-info list-inline-item pl-0 mb-0">
                        <li class="list-inline-item"><a href="mailto:support@gmail.com"><i
                                        class="icofont-support-faq mr-2"></i>lyceerobertschuman@lprs.com</a></li>
                        <li class="list-inline-item"><i class="icofont-location-pin mr-2"></i>1 Allée François Rabelais,
                            Dugny
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navigation" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.jpg" alt="" class="img-fluid">
            </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
                    aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icofont-navigation-menu"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarmain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.php">Accueil</a></li>
                    <?php if(!isset($_SESSION['profil']) && !isset($_SESSION['mail'])){ ?>
                    <li class="nav-item"><a class="nav-link" id="connexion" href="#">Connexion</a></li>
                    <?php } else {
                        if ($_SESSION['profil'] == 'admin'){?>
                            <li class="nav-item"><a class="nav-link" href="view/admin/gestionuser.php">Administration</a></li>
                        <?php }
                        if ($_SESSION['profil'] == 'prof'){?>
                            <li class="nav-item"><a class="nav-link" href="view/projet_educatif/projets.php">Projets Educatifs</a></li>
                        <?php }?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="view/profil/profil.php"> Profil <i class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown05">
                                <li><a class="dropdown-item" href="view/profil/profil.php">Mon profil</a></li>
                                <li><a class="dropdown-item" href="view/profil/rendezvous.php">Rendez-vous</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="view/chatbox/chatbox.php">Messagerie</a></li>
                    <?php } ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Etablissement <i class="icofont-thin-down"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown05">
                            <li><a class="dropdown-item" href="view/presentation/about.php">Qui sommes-nous ?</a></li>
                            <li><a class="dropdown-item" href="view/presentation/datecle.php">Dates clés</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="view/formation/lycee.php" id="dropdown05"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Formation <i
                                    class="icofont-thin-down"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown05">
                            <li><a class="dropdown-item" href="view/formation/lycee.php">Parcours Lycée</a></li>
                            <li><a class="dropdown-item" href="view/formation/bts.php">Parcours BTS</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="view/event/event.php">Evenement</a></li>
                    <li class="nav-item"><a class="nav-link" href="view/contact/contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

</header>
