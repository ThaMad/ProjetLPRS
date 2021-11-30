
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/manager.php");
//On déclare la variables $toolsManager de type toolsManager
$Manager = new Manager();
//On déclare la variable $db de type toolsManager en appelant la méthode connexion_bd
$db = $Manager->connexion_bdd();

$classes = $db->prepare('SELECT * FROM classe');
$classes->execute(array());
$classes = $classes-> fetchall();

$mail = $_SESSION['mail'];
$req = $db->prepare('SELECT idUser,nom,prenom FROM user WHERE mail = :mail');
$req->execute(array('mail' => $mail));
$a = $req->fetchall();


?>
<div class="modal fade " id="add_projet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un projet éducatif </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div  style="background-image: url('Design/image/backgroundImage.png');" class="scrolly modal-body">
                <form action="../../traitement/add_project.php" method="POST" enctype="multipart/form-data" id="form_adduser">


                    <div class="text-center mb-4 mt-5">
                        <label for="EventTitle" class="txtForm">Classe</label></br>
                        <select name="classe" class="dropdown-select form-control" id="classe" required>
                            <option value="" selected disabled hidden>
                                Selectionnez une classe
                            </option>
                            <?php
                            foreach($classes as $value){

                                ?>
                                <option value="<?php echo $value['idClasse']; ?>"><?php echo $value['libelle'];?></option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="text-center mb-4 mt-5">
                        <label for="EventTitle" class="txtForm">Nom du projet educatif</label></br>
                        <input type="text" name="libelle" class="formText" maxlength="40" size="30" id="libelle" placeholder="Entrez le nom" required/>
                    </div>
                    <div class="text-center mb-4 mt-5">
                        <label for="EventTitle" class="txtForm">Cours</label></br>
                        <input type="text" name="cours" class="formText" maxlength="40" size="30" id="prenom" placeholder="Entrez le cours concerné" required/>
                    </div>
                    <div class="text-center mb-4 mt-5">
                        <label for="EventTitle" class="txtForm">Professeur</label></br>
                        <input type="text" name="prof" class="formText" maxlength="40" size="30" id="prof" placeholder="<?php echo $a[0]['nom']; echo ' '; echo $a[0]['prenom']; ?>" disabled/>
                        <input type="hidden" name="profid" class="txtForm" value="<?php echo $a[0]['idUser']?>"/>
                    </div>

                    <div class="text-center mb-4 mt-5">
                        <label for="EventTitle" class="txtForm">Date</label></br>
                        <input type="date" name="date" class="formText" maxlength="40" size="30" id="date" value="2021-01-08"
                               min="2018-01-01" max="<?php echo date('Y-m-j') ?>"  required/>
                    </div>

                    <div class="text-center mb-4">
                        <input style="height: 35px; width:220px;" type="submit" class="btnValider" id="envoi_addprojet" value="Ajouter un projet">
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>