<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");
$manager = new Manager();
$bdd = $manager->connexion_bdd();
include('../header/headerinview.php');
include('addevent.php');
?>
<li class="nav-item"><a class="nav-link" href="../presentation/about.php">Information</a></li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="../formation/lycee.php" id="dropdown05" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">Formation <i class="icofont-thin-down"></i></a>
    <ul class="dropdown-menu" aria-labelledby="dropdown05">
        <li><a class="dropdown-item" href="../formation/lycee.php">Parcours Lycée</a></li>
        <li><a class="dropdown-item" href="../formation/bts.php">Parcours BTS</a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="event.php">Evenement</a></li>
<li class="nav-item"><a class="nav-link" href="../contact/contact.php">Contact</a></li>
</ul>
</div>
</div>
</nav>
</header>

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
if(isset($_SESSION['mail']) && ($_SESSION['profil']=== 'etudiant' || $_SESSION['profil']=== 'admin' || $_SESSION['profil']=== 'prof')){
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
    if($value['valide'] !== '0'){
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
                    <img src="../../images/event/<?php echo $value['image']; ?>" class="align-left event" alt="image">
                </div>
                <div class="col-md-2 "></div>
                <div class="col-md-4 ">
                    <p><?php echo $value['description']; ?></p>
                    <?php date_default_timezone_set('Europe/Paris');
                    $curDateTime = date("Y-m-d");
                    $myDate = $value['dateDebut'];
                    if($myDate > $curDateTime && ($_SESSION['profil'] === 'etudiant' || $_SESSION['profil'] === 'prof' || $_SESSION['profil'] === 'parent')){?>
                            <button class="btn btn-primary text-center" id="ParticipeEvent" style="margin-top: 10px;">Je Participe !</button>
                        <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php }} ?>
<?php
include('../footer/footerinview.php');
?>

</body>
</html>