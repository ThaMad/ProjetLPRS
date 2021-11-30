<?php

require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/manager.php");
//On déclare la variables $toolsManager de type toolsManager
$Manager = new Manager();
//On déclare la variable $db de type toolsManager en appelant@ la méthode connexion_bd
$db = $Manager->connexion_bdd();

$projets= $db->prepare("SELECT idProjet, projet_ed.libelle, cours, classe.libelle AS libelleclasse, nom, prenom, date FROM projet_ed INNER JOIN user ON projet_ed.prof = user.idUser INNER JOIN classe ON user.classe = classe.idClasse ");
$projets->execute(array());
$projets = $projets->fetchall();

$classes = $db->prepare('SELECT * FROM classe');
$classes->execute(array());
$classes = $classes-> fetchall();

include('../header/headerinview.php');
include('add_projet.php');
?>

    <!DOCTYPE html>
    <html lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
        <meta name="author" content="themefisher.com">

        <title>Lycée Robert Schuman - Projets éducatifs</title>

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
    ?>




    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg">Projets éducatifs</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- DATA TABLE -->
    <section class="section service-2">
        <div class="container">

            <center>
                <div class="table-responsive" style="width:100%;">
                    <table id="table" class="display dt-responsive" style="width:100%;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Libellé</th>
                            <th>Cours</th>
                            <th>Classe</th>
                            <th>Professeur</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($projets as $value){



                            ?>


                            <tr>
                                <td><?php echo $value['idProjet'];?></td>
                                <td id><?php echo $value['libelle'];?>
                                </td>
                                <td><?php echo $value['cours'];?></td>
                                <td><?php echo $value['libelleclasse'];?></td>
                                <td><?php echo $value['nom']; echo ' '; echo $value['prenom'];?></td>
                                <td><?php echo $value['date'];?></td>
                                <td><a class="d-block mx-auto btn btn-danger text-white" href="../../traitement/delete_project.php?idProjet=<?php echo $value['idProjet'];?>"><i class="fas fa-times"> Supprimer</i></a></td>

                            </tr>



                        <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div style="padding-left: 100px;" >
                    <div class="btnEvent"><button class="btn btn-info add-new" data-toggle="modal" data-target="#add_projet" data-whatever="@getbootstrap" id="add_projet"><i class="fa fa-plus"></i> Ajouter un projet educatif</button></div>
                </div>

            </center>
        </div>

        </div>
    </section>
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
