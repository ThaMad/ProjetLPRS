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

<body id="top">

<?php
include('../header/headerinview.php');
?>


<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/manager.php");
//On déclare la variables $toolsManager de type toolsManager
$Manager = new Manager();
//On déclare la variable $db de type toolsManager en appelant la méthode connexion_bd
$db = $Manager->connexion_bdd();

$user= $db->prepare("SELECT idUser, nom, prenom, profil, libelle FROM user INNER JOIN classe ON user.classe = classe.idClasse WHERE profil = 'etudiant' OR profil = 'professeur' or profil = 'parent' ");
$user->execute(array());
$user = $user->fetchall();
$myid= "2"
?>


<li class="nav-item"><a class="nav-link" href="about.php">Information</a></li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="../formation/lycee.php" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Formation <i class="icofont-thin-down"></i></a>
    <ul class="dropdown-menu" aria-labelledby="dropdown05">
        <li><a class="dropdown-item" href="../formation/lycee.php">Parcours Lycée</a></li>
        <li><a class="dropdown-item" href="../formation/bts.php">Parcours BTS</a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="../profil/profil.php">Profil</a></li>
<li class="nav-item"><a class="nav-link" href="../event/event.php">Evenement</a></li>
<li class="nav-item"><a class="nav-link" href="../contact/contact.php">Contact</a></li>
</ul>
</div>
</div>
</nav>
</header>




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
                        <form method="get" action="chatbox.php?idUser=<?php echo $_GET['destinataire'];?>">
<button type="submit" class="btn btn-outline-secondary btn-lg btn-block">
                    <li>
                        <div>
                            <input id="destinataire" name="destinataire" type="hidden" value="<?php echo $value['idUser'];?>">
                            <h2 name="prenom"><?php echo $value['prenom'];?> </h2><h2 name="nom"> <?php echo $value['nom'];?> </h2>
                            <h3>
                                <?php echo $value['libelle']; ?>
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
                        <h2>Selectionnez un destinataire</h2>
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
                $conversation = $db ->prepare("SELECT * from conversation WHERE userA = $destinataireid or userA = $myid AND userB = $destinataireid or userB = $myid");
                $conversation->execute(array());
                $conversation=$conversation->fetch();
                if (empty($conversation)){ ?>

                <ul id="chat">
                <footer>
                    <form action="../../traitement/newconversation.php" method="post">
                        <input name="userA" type="hidden" value="<?php echo $myid;?>">
                        <input name="userB" type="hidden" value="<?php echo $destinataireid;?>">
                        <textarea name="message" placeholder="Commencez la conversation, envoyez le premier message !"> </textarea>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_picture.png" alt="">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_file.png" alt="">
                        <button type="submit" class="btn btn-secondary">SEND</button>
                        <form>
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

                    <?php
                }

                else{

                ?>

                <ul id="chat">
                    <li class="you">
                        <div class="entete">
                            <span class="status green"></span>
                            <h2>Vincent</h2>
                            <h3>10:12AM, Today</h3>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                        </div>
                    </li>
                    <li class="me">
                        <div class="entete">
                            <h3>10:12AM, Today</h3>
                            <h2>Vincent</h2>
                            <span class="status blue"></span>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                        </div>
                    </li>
                    <li class="me">
                        <div class="entete">
                            <h3>10:12AM, Today</h3>
                            <h2>Vincent</h2>
                            <span class="status blue"></span>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            OK
                        </div>
                    </li>
                    <li class="you">
                        <div class="entete">
                            <span class="status green"></span>
                            <h2>Vincent</h2>
                            <h3>10:12AM, Today</h3>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                        </div>
                    </li>
                    <li class="me">
                        <div class="entete">
                            <h3>10:12AM, Today</h3>
                            <h2>Vincent</h2>
                            <span class="status blue"></span>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                        </div>
                    </li>
                    <li class="me">
                        <div class="entete">
                            <h3>10:12AM, Today</h3>
                            <h2>Vincent</h2>
                            <span class="status blue"></span>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            OK
                        </div>
                    </li>
                </ul>
                <footer>
                    <textarea placeholder="Type your message"></textarea>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_picture.png" alt="">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_file.png" alt="">
                    <a href="#">Send</a>
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
    $(document).ready(function()){
        $("#userul").click(function(){
            $("#chatmain").load("chatboxmessages.php?<?php echo $value["idUser"] ?>")
            }

        )
    });

</script>
<script src="js/add_user.js"></script>

</body>
</html>
