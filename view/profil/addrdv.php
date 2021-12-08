<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/manager.php");
//On déclare la variables $toolsManager de type toolsManager
$Manager = new Manager();
//On déclare la variable $db de type toolsManager en appelant la méthode connexion_bd
$db = $Manager->connexion_bdd();


$mail = $_SESSION['mail'];

$myid= $db->prepare('SELECT idUser FROM user WHERE mail = ?');
$myid->execute(array($mail));
$myid = $myid->fetch();
$myid = $myid['idUser'];

$professeurs=$db->prepare("SELECT * FROM user WHERE profil = 'prof'");
$professeurs->execute(array());
$professeurs = $professeurs->fetchall();

$parents=$db->prepare("SELECT * FROM user WHERE profil ='parent'");
$parents->execute(array());
$parents = $parents->fetchall();


if($_SESSION['profil']=='parent'){
?>
<div class="modal fade " id="add_rdv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="parentid" value="<?php echo $myid; ?>">
                        <label for="EventTitle" class="txtForm">Professeurs</label></br>
                        <select name="profid" class="dropdown-select form-control" id="prof" required>
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
                        <input type="date" name="jour" class="formText" maxlength="40" size="30" id="jourparent" placeholder="Entrez le jour" required/>
                        <input type="time" min="08:00" max="12:30" name="heure" class="formText" maxlength="40" size="30" id="heure" placeholder="Entrez l'horaire" required/>
                        <br><small>Les rendez-vous sont le samedi de 8h a 12h30.</small>
                    </div>

                    <div class="text-center mb-4">
                        <input style="height: 35px; width:220px;" type="submit" class="btnValider" id="envoi_adduser" value="Planifier un rendez-vous">
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
<?php }
else if($_SESSION['profil']=='prof'){

    ?>
    <div class="modal fade " id="add_rdv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Planifier un rendez-vous avec un parent </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div  style="background-image: url('Design/image/backgroundImage.png');" class="scrolly modal-body">
                    <form action="../../traitement/addrdv.php" method="POST" enctype="multipart/form-data" id="form_addrdv">

                        <div class="text-center mb-4 mt-5">
                            <input type="hidden" name="profid" value="<?php echo $myid; ?>">
                            <label for="EventTitle" class="txtForm">Parent</label></br>
                            <select name="parentid" class="dropdown-select form-control" id="parent" required>
                                <?php

                                foreach($parents as $value){ ?>
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
                            <input type="date" name="jour" class="formText" maxlength="40" size="30" id="jourprof" placeholder="Entrez le jour" required/>
                            <input type="time" min="07:00" max="20:30" name="heure" class="formText" maxlength="40" size="30" id="heure" placeholder="Entrez l'horaire" required/>
                            <br><small>Les rendez-vous sont à placer de 7h a 20h30 du lundi au samedi après discussion avec un parent</small>
                        </div>

                        <div class="text-center mb-4">
                            <input style="height: 35px; width:220px;" type="submit" class="btnValider" id="envoi_adduser" value="Planifier un rendez-vous">
                        </div>


                    </form>
                </div>


            </div>
        </div>
    </div>


    <?php
}
?>

<script>
    const pickerparent = document.getElementById('jourparent');
    pickerparent.addEventListener('input', function(e){
        var day = new Date(this.value).getUTCDay();
        if([1,2,3,4,5,0].includes(day)){
            e.preventDefault();
            this.value = '';
            alert('Les professeurs sont disponibles seulement le samedi pour un rendez-vous.');
        }
    });

    const pickerprof = document.getElementById('jourprof');
    pickerprof.addEventListener('input', function(e){
        var day = new Date(this.value).getUTCDay();
        if([0].includes(day)){
            e.preventDefault();
            this.value = '';
            alert('Vous ne pouvez pas prendre rendez-vous un dimanche.');
        }
    });
</script>
