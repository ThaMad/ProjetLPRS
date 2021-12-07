<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/manager.php");
//On déclare la variables $toolsManager de type toolsManager
$Manager = new Manager();
//On déclare la variable $db de type toolsManager en appelant la méthode connexion_bd
$db = $Manager->connexion_bdd();

$professeurs=$db->prepare("SELECT * FROM user WHERE profil = 'prof'");
$professeurs->execute(array());
$professeurs = $professeurs->fetchall();

$parents=$db->prepare("SELECT * FROM user WHERE profil ='parent'");

if($_SESSION['profil']=='parent'){
?>
<div class="modal fade " id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Planifier un rendez-vous avec un professeur </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div  style="background-image: url('Design/image/backgroundImage.png');" class="scrolly modal-body">
                <form action="../../traitement/addrdv.php" method="POST" enctype="multipart/form-data" id="form_addrdv">

                    <div class="text-center mb-4 mt-5">
                        <label for="EventTitle" class="txtForm">Professeurs</label></br>
                        <select name="prof" class="dropdown-select form-control" id="prof" required>
                            <?php

                            foreach($professeurs as $value){ ?>
                            <option value="<?php echo $value['idUser'] ?>">
                                <?php echo $value['nom'];echo ' '; echo $value['prenom']; ?>
                            </option>
        <?php } ?>
                        </select>
                    </div>

                    <div class="text-center mb-4 mt-5">
                        <label for="EventTitle" class="txtForm">Raison du rendez-vous</label></br>
                        <input type="text" name="libelle" class="formText" maxlength="40" size="30" id="nom" placeholder="Entrez le titre du rendez-vous" required/>
                    </div>
                    <div class="text-center mb-4 mt-5">
                        <label for="EventTitle" class="txtForm">Horaire</label></br>
                        <input type="datetime" name="horaire" class="formText" maxlength="40" size="30" id="horaire" placeholder="Entrez l'horaire'" required/>
                    </div>

                    <div class="text-center mb-4">
                        <input style="height: 35px; width:220px;" type="submit" class="btnValider" id="envoi_adduser" value="Ajouter un utilisateur">
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
<?php }
else if($_SESSION['profil']=='prof'){

    ?>
    <div class="modal fade " id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Planifier un rendez-vous avec un parent d'élève </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div  style="background-image: url('Design/image/backgroundImage.png');" class="scrolly modal-body">
                    <form action="../../traitement/admin/add_user.php" method="POST" enctype="multipart/form-data" id="form_adduser">

                        <div class="text-center mb-4 mt-5">
                            <label for="EventTitle" class="txtForm">Profil</label></br>
                            <select name="profil" class="dropdown-select form-control" id="profil" required>
                                <option value="" selected disabled hidden>
                                    Selectionnez un profil
                                </option>
                                <option value="admin">Admin</option>
                                <option value="etudiant">Etudiant</option>
                                <option value="professeur">Professeur</option>
                                <option value="parent">Parent</option>

                            </select>
                        </div>

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
                            <label for="EventTitle" class="txtForm">Nom</label></br>
                            <input type="text" name="nom" class="formText" maxlength="40" size="30" id="nom" placeholder="Entrez le nom" required/>
                        </div>
                        <div class="text-center mb-4 mt-5">
                            <label for="EventTitle" class="txtForm">Prenom</label></br>
                            <input type="text" name="prenom" class="formText" maxlength="40" size="30" id="prenom" placeholder="Entrez le prenom" required/>
                        </div>
                        <div class="text-center mb-4 mt-5">
                            <label for="EventTitle" class="txtForm">Email</label></br>
                            <input type="email" name="mail" class="formText" maxlength="40" size="30" id="mail" placeholder="Entrez un email" required/>
                        </div>

                        <div class="text-center mb-4">
                            <input style="height: 35px; width:220px;" type="submit" class="btnValider" id="envoi_adduser" value="Ajouter un utilisateur">
                        </div>


                    </form>
                </div>


            </div>
        </div>
    </div>


    <?php
}
?>