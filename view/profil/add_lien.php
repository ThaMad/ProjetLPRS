<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");
//On déclare la variables $toolsManager de type toolsManager
$Manager = new Manager();
//On déclare la variable $db de type toolsManager en appelant@ la méthode connexion_bd
$db = $Manager->connexion_bdd();


if (!isset($_SESSION['mail'])) {
    header('Location: /ProjetLPRS/index.php');
} else if ($_SESSION['profil'] != 'parent') {
    header('Location: /ProjetLPRS/index.php');
}
else {




include('../header/headerinview.php');

$mail = $_SESSION['mail'];


$myid= $db->prepare('SELECT idUser FROM user WHERE mail = ?');
$myid->execute(array($mail));
$myid = $myid->fetch();
$myid = $myid['idUser'];

$user = $db->prepare("SELECT idUser, nom, prenom, libelle FROM user INNER JOIN classe ON classe.idClasse = user.classe WHERE profil= 'etudiant' AND idUser NOT IN (SELECT idUser FROM user INNER JOIN lien ON user.idUser = lien.eleve WHERE parent=$myid)");
$user->execute(array());
$user = $user->fetchall();
?>
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <h1 class="text-capitalize mb-5 text-lg">Se lier à des étudiants</h1>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- DATA TABLE -->
<form method="POST" action="../../traitement/add_lien.php">

    <section class="section service-2">
        <div class="container">
            <h2 style="text-align: center">Liens</h2>
            <center>
                <div class="table-responsive" style="width:100%;">
                    <table id="table" class="display dt-responsive" style="width:100%;">
                        <thead>
                        <tr>
                            <th>Lien</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Classe</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($user as $value) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="idUser" value="<?php echo $value['idUser'];?>">
                                <input type="hidden" name="parentid" value="<?php echo $myid; ?>"> </td>
                                <td><?php echo $value['nom']; ?></td>
                                <td><?php echo $value['prenom']; ?></td>
                                <td><?php echo $value['libelle']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
            </center>
        </div>
        </div>
    </section>
    </div>
    <center>
    <input class="btn btn-primary text-center" style="margin-top: 10px" type="submit">
    </center>
    </form>

<?php
include('../footer/footerinview.php');
?>

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

</body>
</html>

<?php } ?>