<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");
$manager = new Manager();
$bdd = $manager->connexion_bdd();
include('../header/headerinview.php');
?>
<li class="nav-item"><a class="nav-link" href="about.php">Information</a></li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="../formation/lycee.php" id="dropdown05" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">Formation <i class="icofont-thin-down"></i></a>
    <ul class="dropdown-menu" aria-labelledby="dropdown05">
        <li><a class="dropdown-item" href="../formation/lycee.php">Parcours Lycée</a></li>
        <li><a class="dropdown-item" href="../formation/bts.php">Parcours BTS</a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="../event/event.php">Evenement</a></li>
<li class="nav-item"><a class="nav-link" href="../contact/contact.php">Contact</a></li>
</ul>
</div>
</div>
</nav>
</header>

<?php
if(isset($_SESSION['mailProf'])){
    $mail = $_SESSION['mailProf'];
}
elseif(isset($_SESSION['mailEtudiant'])){
    $mail = $_SESSION['mailEtudiant'];
}
elseif(isset($_SESSION['mailAdmin'])){
    $mail = $_SESSION['mailAdmin'];
}
elseif(isset($_SESSION['mailParent'])){
    $mail = $_SESSION['mailParent'];
}
$req = $bdd->prepare('SELECT nom,prenom,profil,mail,classe FROM user WHERE mail = :mail');
$req->execute(array('mail' => $mail ));
$a = $req->fetchall();

foreach ($a

         as $value){
?>
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg"><?php echo $value['nom'] . ' ' . $value['prenom']; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-primary text-center" id="modifdata" style="margin-top: 10px;">Modifier mes
                        infos
                    </button>
                </div>
                <div class="col-md-4">
                    <button href="#" class="btn btn-primary text-center" style="margin-top: 10px;">Evenement créer et
                        participer
                    </button>
                </div>
                <div class="col-md-2">
                    <button href="#" class="btn btn-primary text-center" style="margin-top: 10px;">Message</button>
                </div>
                <div class="col-md-3">
                    <a href="../../traitement/deconnexion.php" class="btn btn-primary text-center"
                       style="margin-top: 10px;">Déconnexion</a>
                </div>
            </div>
        </div>
    </section>
<section class="section doctors">
    <form action="../../traitement/modification-profil.php" method="post" id="form-modification-profil">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <label class="text-center">Nom :</label>
                    <input type="text" class="form-control" id="nominfodata" name="nom"
                           value="<?php echo $value['nom']; ?>" disabled>
                    </br>
                    <label class="text-center">Prenom :</label>
                    <input type="text" class="form-control" id="prenominfodata" name="prenom"
                           value="<?php echo $value['prenom']; ?>" disabled>
                    </br>
                    <label class="text-center">Mail :</label>
                    <input type="email" class="form-control" id="mailinfodata" name="mail"
                           value="<?php echo $value['mail']; ?>" disabled>
                    </br>
                    <label class="text-center">Profil :</label>
                    <input type="radio" id="etudiantinfodata" name="customRadioInline1"
                           value="etudiant"
                           style="margin-left: 10px;" <?php if ($value['profil'] == 'etudiant') { ?> checked <?php } ?>
                           disabled>
                    <label for="customRadioInline1">Etudiant</label>
                    <input type="radio" id="parentinfodata" name="customRadioInline1"
                           value="parent"
                           style="margin-left: 10px;" <?php if ($value['profil'] == 'parent') { ?> checked <?php } ?>
                           disabled>
                    <label for="customRadioInline2">Parent</label>
                    </br>
                    <label class="text-center">Classe :</label>
                    <input type="text" class="form-control" id="classeinfodata" name="classe"
                           value="<?php echo $value['classe'];
                           } ?>" disabled>

                    </br>
                    <button type="button" class="btn btn-secondary" id="retour" style="margin-right: 2px;" hidden>
                        Retour
                    </button>
                    <button type="button" class="btn btn-primary" id="save-modification" hidden>
                        Modification
                    </button>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </form>
</section>
<?php
include('../page-attente.php');
include('../footer/footerinview.php');
?>
</body>
</html>