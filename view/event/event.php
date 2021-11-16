<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");
$manager = new Manager();
$bdd = $manager->connexion_bdd();
include('../header/headerinview.php');
include('addevent.php');
?>

<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <h1 class="text-capitalize mb-5 text-lg">Evenement</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_SESSION['mail']) && ($_SESSION['profil'] === 'etudiant' || $_SESSION['profil'] === 'admin' || $_SESSION['profil'] === 'prof')) {
    ?>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <button class="btn btn-primary text-center" id="addEvent" style="margin-top: 10px;">Ajouter un
                        évenement
                    </button>
                </div>
            </div>
        </div>
    </section>
<?php }
?>
<?php
$req = $bdd->prepare('SELECT libelle,dateDebut,dateFin,description,image,valide FROM evenement');
$req->execute();
$a = $req->fetchall();


foreach ($a
         as $value) {
    if ($value['valide'] !== '0') {
        ?>
        <section class="section service-2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center">
                        <div class="section-title">
                            <h2><?php echo $value['libelle']; ?></h2>
                            <div class="divider mx-auto my-4"></div>
                            <p><?php echo 'Date début: ' . $value['dateDebut'] . '/ Date fin: ' . $value['dateFin']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ">
                        <img src="../../images/event/<?php echo $value['image']; ?>" class="align-left event"
                             alt="image">
                    </div>
                    <div class="col-md-2 "></div>
                    <div class="col-md-4 ">
                        <p><?php echo $value['description']; ?></p>
                        <?php date_default_timezone_set('Europe/Paris');
                        $curDateTime = date("Y-m-d");
                        $myDate = $value['dateDebut'];
                        if ($myDate > $curDateTime && (isset($_SESSION['profil']) && ($_SESSION['profil'] === 'etudiant' || $_SESSION['profil'] === 'prof' || $_SESSION['profil'] === 'parent'))) {
                            ?>
                            <form action="../../traitement/partEvent.php" method="post">
                                <button class="btn btn-primary text-center" style="margin-top: 10px;"
                                        name="event" value="<?php echo $value['libelle']; ?>">Je Participe !
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }
} ?>
<?php
include('../footer/footerinview.php');
if(isset($_SESSION['erreur']) && $_SESSION['erreur'] !=''){ ?>
    <script type="text/javascript">
        app.displayErrorNotification('<?php echo $_SESSION['erreur']; ?>');
    </script>
<?php $_SESSION['erreur']=''; } elseif(isset($_SESSION['success']) && $_SESSION['success'] !=''){ ?>
<script type="text/javascript">
        app.displaySuccessNotification('<?php echo $_SESSION['success']; ?>');
    </script>
<?php $_SESSION['success']=''; } ?>
</body>
</html>