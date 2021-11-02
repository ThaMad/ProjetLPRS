<?php
require_once '../model/evenement.php';
require_once '../manager/manager.php';

if (isset($_POST["libelle"])) {
    $file = $_FILES['imageUpload']['name'];
    try {
        $event = new evenement(array(
            "libelle" => $_POST["libelle"],
            "dateDebut" => $_POST['dateD'],
            "dateFin" => $_POST['dateF'],
            "description" => $_POST['description'],
            "image" => $file,
        ));
        $man = new manager();
        $man->addevent($event);
        $sortie = false;
        $extensions_ok = array('jpg', 'jpeg', 'png');
        $typeimages_ok = array(2, 3);
        $taille_ko = 3072;
        $taille_max = $taille_ko * 3072;
        $dest_dossier = $_SERVER['DOCUMENT_ROOT'] . '/ProjetLPRS/images/event/'; //nom du dossier ou vous allez stocké vos images
        $dest_fichier = "";
        $dest_fichier = basename($_FILES['imageUpload']['name']);
        $dest_fichier = strtr($dest_fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
        $dossier = $dest_dossier;
        while (file_exists($dossier . $dest_fichier)) {
            $dest_fichier = rand() . $dest_fichier;
        }
        if (move_uploaded_file($_FILES['imageUpload']['tmp_name'], $dossier . $dest_fichier)) {
            $valid[] = "Image uploadé avec succés (<a href='" . $dossier . $dest_fichier . "'>Voir</a>)";
        } else {
            $erreurs[] = "Impossible d'uploader le fichier.<br />Veuillez vérifier que le dossier " . $dossier;
        }
    } catch
    (Exception $e) {
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}
?>