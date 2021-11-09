<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");
$manager = new Manager();
$bdd = $manager->connexion_bdd();
?>
<div class="modal fade" id="modal-add-orga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="../../traitement/addOrga.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'un organisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="text-center">Profil :</label>
                        </div>
                    </div>
                    <div class="row" id="choixProfil">
                        <div class="col-md-4 ml-auto ">
                            <div class="custom-control">
                                <input type="radio" id="eleveradio" name="customRadioInline1" value="etudiant">
                                <label for="customRadioInline1">Etudiant</label>
                            </div>
                        </div>
                        <div class="col-md-4 ml-auto">
                            <div class="custom-control">
                                <input type="radio" id="parentradio" name="customRadioInline1" value="parent">
                                <label for="customRadioInline2">Parent</label>
                            </div>
                        </div>
                        <div class="col-md-4 ml-auto">
                            <div class="custom-control">
                                <input type="radio" id="profradio" name="customRadioInline1" value="prof">
                                <label for="customRadioInline2">Professeur</label>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="row" id="listeEtudiant" hidden>
                        <div class="col-md-3">
                            <label class="text-center">Liste :</label>
                        </div>
                        <?php
                        $req = $bdd->prepare('SELECT * FROM user WHERE profil = :profil');
                        $req->execute(array('profil' => 'etudiant'));
                        $a = $req->fetchall();
                        ?>
                        <div class="col-md-4 ml-auto">
                            <select class=form-control>
                                <?php
                                foreach ($a as $value) {
                                ?>
                                <option value="<?php echo $value['mail']; ?>"><?php echo $value['nom'].' '.$value['prenom']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="listeParent" hidden>
                        <div class="col-md-3">
                            <label class="text-center">Liste :</label>
                        </div>
                        <?php
                        $req = $bdd->prepare('SELECT * FROM user WHERE profil = :profil');
                        $req->execute(array('profil' => 'parent'));
                        $a = $req->fetchall();
                        ?>
                        <div class="col-md-9 ml-auto">
                            <select class=form-control>
                                <?php
                                foreach ($a as $value) {
                                    ?>
                                    <option value="<?php echo $value['mail']; ?>"><?php echo $value['nom'].' '.$value['prenom']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="listeProf" hidden>
                        <div class="col-md-3">
                            <label class="text-center">Liste :</label>
                        </div>
                        <?php
                        $req = $bdd->prepare('SELECT * FROM user WHERE profil = :profil');
                        $req->execute(array('profil' => 'prof'));
                        $a = $req->fetchall();
                        ?>
                        <div class="col-md-4 ml-auto">
                            <select class=form-control>
                                <?php
                                foreach ($a as $value) {
                                    ?>
                                    <option value="<?php echo $value['mail']; ?>"><?php echo $value['nom'].' '.$value['prenom']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    </br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" id="ajouterEvent">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>