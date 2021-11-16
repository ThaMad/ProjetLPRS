<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");
$manager = new Manager();
$bdd = $manager->connexion_bdd();
include('../header/headerinview.php');
?>
<?php
$mail = $_SESSION['mail'];
$req = $bdd->prepare('SELECT nom,prenom,profil,mail,classe FROM user WHERE mail = :mail');
$req->execute(array('mail' => $mail));
$a = $req->fetchall();

$myid= $bdd->prepare('SELECT idUser FROM user WHERE mail = ?');
$myid->execute(array($mail));
$myid = $myid->fetch();
$myid = $myid['idUser'];

$user= $bdd->prepare("SELECT idLien, nom, prenom, profil, libelle FROM lien INNER JOIN user ON lien.parent = user.idUser INNER JOIN classe ON user.classe = classe.idClasse WHERE (eleve= $myid) OR (parent= $myid) AND (idUser != $myid)");
$user->execute(array());
$user = $user->fetchall();

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
                    <button class="btn btn-primary text-center" style="margin-top: 10px;" id="tableauEvent">Evenement
                        créer et
                        participer
                    </button>
                </div>
                <?php
                if (isset($_SESSION["profil"]) && $_SESSION["profil"] == 'parent') {
                    ?>
                    <div class="col-md-3">
                        <button id="lienParent" class="btn btn-primary text-center"
                                style="margin-top: 10px">Ajouter un lien
                        </button>
                    </div>
                <?php } ?>
                <div class="col-md-2">
                    <a href="../../traitement/deconnexion.php" class="btn btn-primary text-center"
                       style="margin-top: 10px;">Déconnexion</a>
                </div>
            </div>
        </div>
    </section>
<section class="section doctors">
    <form action="../../traitement/modification-profil.php" method="post" id="form-modification-profil">
        <div class="container" id="containerProfil">
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
        <div>
            <!-- DATA TABLE -->
            <section class="section service-2">
                <div class="container">
                    <h2 style="text-align: center">Liens</h2>
                    <center>
                        <div class="table-responsive" style="width:100%;">
                            <table id="table" class="display dt-responsive" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Classe</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($user as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['nom']; ?></td>
                                        <td><?php echo $value['prenom']; ?></td>
                                        <td><?php echo $value['libelle']; ?></td>
                                        <td>
                                            <a class="d-block mx-auto btn btn-danger text-white"
                                               href="../../traitement/delete_lien.php?idUser=<?php echo $value['idLien']; ?>"><i
                                                        class="fas fa-times">
                                                    Supprimer</i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div style="padding-left: 100px;">
                            <div class="btnEvent">
                                <button class="btn btn-info add-new" data-toggle="modal" data-target="#add_user"
                                        data-whatever="@getbootstrap" id="add_user"><i class="fa fa-plus"></i> Ajouter
                                    un lien
                                </button>
                            </div>
                        </div>
                    </center>
                </div>
        </div>
</section>
</div>
</form>
<?php
$mail = $_SESSION['mail'];
$req = $bdd->prepare('SELECT * FROM creation INNER JOIN evenement ON evenement.idEvent = creation.event INNER JOIN user ON creation.user= user.idUser WHERE mail = :mail');
$req->execute(array('mail' => $mail));
$a = $req->fetchall();
?>
<div class="container" id="containerTableau" hidden>
    <div class="table-responsive" style="width:100%;">
        <table id="table" class="display dt-responsive" style="width:100%;">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Libelle</th>
                <th class="text-center">Date Debut</th>
                <th class="text-center">Date Fin</th>
                <th class="text-center">Createur</th>
                <th class="text-center">Organisateur</th>
                <th class="text-center">Ajout organisateur</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($a as $value) {
                date_default_timezone_set('Europe/Paris');
                $curDateTime = date("Y-m-d");
                $myDate = $value['dateDebut'];
                ?>
                <tr>
                    <td class="text-center"><?php echo $value['idEvent']; ?></td>
                    <td class="text-center"><?php echo $value['libelle']; ?></td>
                    <td class="text-center"><?php echo $value['dateDebut']; ?></td>
                    <td class="text-center"><?php echo $value['dateFin']; ?></td>
                    <td class="text-center"><?php if ($value['creation'] == '0') {
                            echo 'non';
                        } else {
                            echo 'oui';
                        } ?></td>
                    <td class="text-center"><?php if ($value['organisateur'] == '0') {
                            echo 'non';
                        } else {
                            echo 'oui';
                        } ?></td>
                    <?php if ($value['creation'] == '1' && $myDate > $curDateTime) { ?>
                        <td class="text-center">
                            <button style="background:#000;" class="d-block mx-auto btn btn-answer text-white"
                                    id="addOrga" value="<?php echo $value['libelle']; ?>">
                                <i class="fas fa-unlock"></i> Ajouter Organisateur
                            </button>
                        </td>
                    <?php } else if ($value['creation'] == '1' && $myDate <= $curDateTime) { ?>
                        <td class="text-center">Evenement fini</td>
                    <?php } else { ?>
                        <td class="text-center">Tu n'es pas le créateur</td>
                    <?php } ?>
                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</section>
<?php
include('../page-attente.php');
include('addOrga.php');
include('../footer/footerinview.php');
if (isset($_SESSION['erreur']) && $_SESSION['erreur'] != '') { ?>
    <script type="text/javascript">
        app.displayErrorNotification('<?php echo $_SESSION['erreur']; ?>');
    </script>
    <?php $_SESSION['erreur'] = '';
} elseif (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>
    <script type="text/javascript">
        app.displaySuccessNotification('<?php echo $_SESSION['success']; ?>');
    </script>
    <?php $_SESSION['success'] = '';
} ?>
</body>
<script>

    $(document).ready( function () {
        $('#table').DataTable({
            "sScrollY": "300px",
            "bScrollCollapse": true,
            "bPaginate": false,
            "bJQueryUI": true,
            paging : false,
            responsive: true,
            "language": {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            },
            "aoColumnDefs": [
                { "sWidth": "10%", "aTargets": [ -1 ] }
            ]
        });

        $("#table").css("width","100%")
    } );


</script>
</html>