<?php

require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/manager.php");
//On déclare la variables $toolsManager de type toolsManager
$Manager = new Manager();
//On déclare la variable $db de type toolsManager en appelant@ la méthode connexion_bd
$db = $Manager->connexion_bdd();


include('../header/headerinview.php');

$mail = $_SESSION['mail'];

$myinfo= $db->prepare('SELECT * FROM user WHERE mail = ?');
$myinfo->execute(array($mail));
$myinfo = $myinfo->fetch();
$myid = $myinfo['idUser'];

$rdv = $_GET['idRdv'];

$rdvprof= $db->prepare("SELECT idRdv, nom, prenom, libelle, horaire, compterendu FROM rdv INNER JOIN user ON rdv.parent = user.idUser WHERE professeur = $myid AND idRdv = $rdv");
$rdvprof->execute(array());
$rdvprof = $rdvprof->fetch();



?>

    <!DOCTYPE html>
    <html lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
        <meta name="author" content="themefisher.com">

        <title>Lycée Robert Schuman - Ajout compte-rendu </title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

        <!-- DATA TABLE -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

        <!-- bootstrap.min css -->
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
        <!-- Icon Font Css -->
        <link rel="stylesheet" href="../../plugins/icofont/icofont.min.css">
        <!-- Slick Slider  CSS -->
        <link rel="stylesheet" href="../../plugins/slick-carousel/slick/slick.css">
        <link rel="stylesheet" href="../../plugins/slick-carousel/slick/slick-theme.css">

        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="../../css/style.css">


    </head>

<body id="top">

<?php
if (!isset($_SESSION['mail']) ){
    header('Location: /ProjetLPRS/index.php');
}
else if ($_SESSION['profil']!== 'prof'){
    header('Location: /ProjetLPRS/index.php');
}
else {
    ?>




    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg">Ajout compte-rendu</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section about-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="title-color">Rendez-vous concerné </h2>
                </div>
                <div class="col-md-4">
                    <br>
                    <p>
                        <b>Intitulé du rendez-vous : </b> <?php echo $rdvprof['libelle']; ?><br>
                        <b>Professeur : </b> <?php echo $myinfo['nom']; echo ' '; echo $myinfo['prenom']; ?><br>
                        <b>Parent : </b> <?php echo $rdvprof['nom']; echo ' '; echo $rdvprof['prenom']; ?><br>
                        <b>Horaire : </b> <?php echo $rdvprof['horaire']; ?>
                    </p>

                </div>
            </div>
            <div class ="row">
                <div class="col-lg-12">
                    <center>
                        <form method="POST" action="../../traitement/addcompterendu.php">
                        <br> <br>
                        <h3 class="title-color">Ajouter un compte-rendu du rendez-vous </h3>
                        <br>
                            <input type="hidden" name="idRdv" value="<?php echo $rdv; ?>">
                        <textarea name="compterendu" class="form-control" placeholder="Saisissez le compte-rendu" style="width:500px; height: 200px"></textarea>
                        <br>
                        <input class="btn btn-primary text-center" style="margin-top: 10px" type="submit" value="Ajouter">
                        </form>
                    </center>
                </div>

            </div>
        </div>
    </section>


<?php

include('../footer/footerinview.php');
?>


    </script>
    <script src="js/add_user.js"></script>

    </body>
    </html>
<?php } ?>