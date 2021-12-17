
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/manager.php");
//On déclare la variables $toolsManager de type toolsManager
$Manager = new Manager();
//On déclare la variable $db de type toolsManager en appelant la méthode connexion_bd
$db = $Manager->connexion_bdd();


if (!isset($_SESSION['mail'])) {
    header('Location: /ProjetLPRS/index.php');
} else {

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="author" content="themefisher.com">

    <title>Lycée Robert Schuman - Messageries</title>

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
    <link rel="stylesheet" href="../../css/chatbox.scss">


</head>


<?php

include('../header/headerinview.php');

$mymail=$_SESSION['mail'];
$myinfo= $db->prepare('SELECT idUser,nom,prenom FROM user WHERE mail = ?');
$myinfo->execute(array($mymail));
$myinfo = $myinfo->fetch();
$myid = $myinfo['idUser'];

$user= $db->prepare("SELECT idUser, nom, prenom, profil, libelle FROM user INNER JOIN classe ON user.classe = classe.idClasse WHERE (profil != 'admin') AND idUser != ?");
$user->execute(array($myid));
$user = $user->fetchall();
?>


<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <h1 class="text-capitalize mb-5 text-lg">Messagerie</h1>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CHAT BOX -->
<section class="section service-2">
    <div class="containerchat">

        <div id="container">
            <aside class="asidechat">
                <header>
                    <input type="text" placeholder="search">
                </header>

                <ul id="userul">
                    <?php
                    foreach ($user as $value){

                    ?>
                        <form method="get" action="chatbox.php?idUser=<?= (isset($_GET['destinataire'])) ? $_GET['destinataire']  : ""?>">
<button type="submit" class="btn btn-outline-secondary btn-lg btn-block">
                    <li>
                        <div>
                            <input id="destinataire" name="destinataire" type="hidden" value="<?php echo $value['idUser'];?>">
                            <h2 name="prenom"><?php echo $value['prenom'];?> </h2><h2 name="nom"> <?php echo $value['nom'];?> </h2>
                            <h3>
                                <?php if ($value['profil']=='etudiant'){echo $value['libelle'];}
                                else if ($value['profil']=='prof'){
                                    echo 'Professeur';
                                }
                                else if ($value['profil']=='parent'){
                                    echo 'Parent';
                                }?>
                            </h3>
                        </div>
                    </li>
</button></form>

                    <?php } ?>
                </ul>
            </aside>
            <main class="mainchat" id="chatmain">
                <header>
                    <?php
                    if (empty($_GET['destinataire'])) { ?>
                    <div>
                        <h2>Bonjour <?php echo $myinfo['prenom']; echo ' '; echo $myinfo['nom']; ?></h2>
                        <br><h3>Selectionnez un destinataire</h3>
                    </div>
                    <?php }
                    else if (isset($_GET['destinataire'])){
                        $destinataireid = $_GET['destinataire'];
                    $destinfo= $db->prepare("SELECT nom, prenom FROM user WHERE idUser = ? ");
                    $destinfo->execute(array($destinataireid));
                    $destinfo = $destinfo->fetch(); ?>
                    <div>
                        <h2>Conversation avec  <?php
                         echo $destinfo['prenom']; echo " "; echo $destinfo['nom']; ?></h2>
                    </div>

                </header>
                <?php
                $messages = $db ->prepare("SELECT * FROM messages WHERE (userExp = $destinataireid AND userDest= $myid) OR  (userExp = $myid AND userDest = $destinataireid) ORDER BY idMessage");
                $messages->execute(array());
                $messages=$messages->fetchall();

                if (empty($messages)){ ?>

                <ul id="chat">
                <footer>
                    <form action="../../traitement/newconversation.php" method="post" id="testForm2">
                        <input name="userExp" type="hidden" value="<?php echo $myid;?>">
                        <input name="userDest" type="hidden" value="<?php echo $destinataireid;?>">
                        <textarea name="message" placeholder="Commencez la conversation, envoyez le premier message !"> </textarea>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_picture.png" alt="">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_file.png" alt="">
                        <input type="submit" class="btn btn-secondary">
                        </form>
                </footer>
            </main>
        </div>
    </ul>
        <script id="message-template" type="text/x-handlebars-template">
            <li class="clearfix">
                <div class="message-data align-right">
                    <span class="message-data-time" >{{time}}, Today</span> &nbsp; &nbsp;
                    <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
                </div>
                <div class="message other-message float-right">
                    {{messageOutput}}
                </div>
            </li>
        </script>

        <script id="message-response-template" type="text/x-handlebars-template">
            <li>
                <div class="message-data">
                    <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                    <span class="message-data-time">{{time}}, Today</span>
                </div>
                <div class="message my-message">
                    {{response}}
                </div>
            </li>
        </script>

                    <?php
                }

                else{
?>
        <ul id="chat">
        <?php
                    foreach ($messages as $value){
                        if ($value['userExp']==$destinataireid) {
                ?>
                    <li class="you">
                        <div class="entete">
                            <span class="status green"></span>
                            <h2> <?php echo $destinfo['prenom']; echo ' '; echo $destinfo['nom'];?></h2>
                            <h3><?php echo $value['date']?></h3>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            <?php echo $value['message']; ?>
                        </div>
                    </li>
            <?php }
                        else if ($value['userExp']==$myid) {
            ?>
                    <li class="me">
                        <div class="entete">
                            <h3><?php echo $value['date'] ?></h3>
                            <h2>Moi</h2>
                            <span class="status blue"></span>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            <?php echo $value['message'];?>
                        </div>
                    </li>
            <?php } }?>
                </ul>
        <footer>
            <form action="../../traitement/newconversation.php" method="post" id="testForm">
                <input name="userExp" type="hidden" value="<?php echo $myid;?>">
                <input name="userDest" type="hidden" value="<?php echo $destinataireid;?>">
                <textarea name="message" placeholder="Saisissez votre message"> </textarea>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_picture.png" alt="">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_file.png" alt="">
                <input type="submit" class="btn btn-secondary">
                </form>
        </footer>
            </main>
        </div>

        <script id="message-template" type="text/x-handlebars-template">
            <li class="clearfix">
                <div class="message-data align-right">
                    <span class="message-data-time" >{{time}}, Today</span> &nbsp; &nbsp;
                    <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
                </div>
                <div class="message other-message float-right">
                    {{messageOutput}}
                </div>
            </li>
        </script>

        <script id="message-response-template" type="text/x-handlebars-template">
            <li>
                <div class="message-data">
                    <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                    <span class="message-data-time">{{time}}, Today</span>
                </div>
                <div class="message my-message">
                    {{response}}
                </div>
            </li>
        </script>
        <?php }} ?>

    </div>

    </div>
</section>
<?php
include('../footer/footerinview.php');
?>

<script>
    $(document).ready(function(){
        $("#userul").click(function(){
            $("#chatmain").load("chatboxmessages.php?<?php echo $value["idUser"] ?>")
            }

        )
    });

</script>


</body>
</html>
<?php }?>