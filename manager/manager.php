<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Manager
{
    // Methode qui permet la connexion à la BDD
    public function connexion_bdd()
    {
        //Informations database Hôte
        $env_host = "localhost";
        putenv("$env_host=localhost:8889");

        //Informations database Name
        $env_name = "DB_NAME";
        putenv("$env_name=projet_lprs");

        //Informations database User
        $env_user = "DB_USER";
        putenv("$env_user=root");

        //Informations database Pass
        $env_pass = "DB_PASS";
        putenv("$env_pass=root");

        try {
            $bdd = new PDO('mysql:host=' . getenv($env_host) . ';dbname=' . getenv($env_name) . ';charset=utf8', getenv($env_user), getenv($env_pass));
        } catch (Exception $e) {
            die('ERREUR:' . $e->getMessage());
        }
        return $bdd;
    }

    public function inscription($user, $mdp)
    {
        session_start();
        $bdd = self::connexion_bdd();
        $req = $bdd->prepare('SELECT * from user where mail=:mail ');
        $req->execute(array(
            'mail' => $user->getMail(),
        ));
        $res = $req->fetch();
        if ($res) {
            throw new Exception("Error utilisateur deja existant");
            $_SESSION['erreur'] = "Error utilisateur deja existant";
            return $_SESSION['erreur'];
        }
        if ($user->getNom() != '' and $user->getPrenom() != '' and $user->getMail() != '' and $user->getProfil() != '' and $user->getMdp() != '') {
            $req = $bdd->prepare('INSERT INTO user(nom,prenom,mail,profil,mdp) values (:nom,:prenom,:mail,:profil,:mdp)');
            $req->execute(array(
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'mail' => $user->getMail(),
                'profil' => $user->getProfil(),
                'mdp' => $user->getMdp(),
            ));
            if (isset($req)) {
                $requestid = $bdd->prepare('SELECT nom,prenom,idUser,mdp from user WHERE mail = ?');
                $requestid->execute(array($user->getMail()));
                $info = $requestid->fetch();
                //$decryptedmdp=$this->decrypt($info['mdp'],'1f4276388ad3214c873428dbef42243f');
                $mdpuser = $mdp;
                $iduser = $info['idUser'];
                $preuser = $info['prenom'];
                $nomuser = $info['nom'];
                $subject = 'Bienvenue sur le Lycée & UFA Robert Schuman !';
                $body = '<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
  <style>
@media only screen and (max-width: 620px) {
  table[class=body] h1 {
    font-size: 28px !important;
    margin-bottom: 10px !important;
  }

  table[class=body] p,
table[class=body] ul,
table[class=body] ol,
table[class=body] td,
table[class=body] span,
table[class=body] a {
    font-size: 16px !important;
  }

  table[class=body] .wrapper,
table[class=body] .article {
    padding: 10px !important;
  }

  table[class=body] .content {
    padding: 0 !important;
  }

  table[class=body] .container {
    padding: 0 !important;
    width: 100% !important;
  }

  table[class=body] .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
  }

  table[class=body] .btn table {
    width: 100% !important;
  }

  table[class=body] .btn a {
    width: 100% !important;
  }

  table[class=body] .img-responsive {
    height: auto !important;
    max-width: 100% !important;
    width: auto !important;
  }
}
@media all {
  .ExternalClass {
    width: 100%;
  }

  .ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
    line-height: 100%;
  }

  .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
  }

  .btn-primary table td:hover {
    background-color: #d5075d !important;
  }

  .btn-primary a:hover {
    background-color: #d5075d !important;
    border-color: #d5075d !important;
  }
}
</style></head>
  <body class style="background-color: #eaebed; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #eaebed; width: 100%;" width="100%" bgcolor="#eaebed">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; Margin: 0 auto;" width="580" valign="top">
          <div class="header" style="padding: 20px 0;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
              <tr>
                <td class="align-center" style="font-family: sans-serif; font-size: 14px; vertical-align: top; text-align: center;" valign="top" align="center">
                </td>
              </tr>
            </table>
          </div>
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Bienvenue sur le site du Lycée Robert Schuman, voici votre mot de passe</span>
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Bienvenue sur le lycée et UFA Robert Schuman, ' . $preuser . ' ' . $nomuser . ' !</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Vous venez d etre inscrit par les incroyables administrateurs(trices) du site 😌</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">

</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"> Votre mot de passe : ' . $mdpuser . ' </p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;" width="100%">
                          <tbody>
                            <tr>
                              <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;">
                                  <tbody>
                                    <tr>
                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #ec0867;" valign="top" align="center" bgcolor="#ec0867"> <a href="#" target="_blank" style="border: solid 1px #ec0867; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #ec0867; border-color: #ec0867; color: #ffffff;">Se connecter</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #9a9ea6; font-size: 12px; text-align: center;">Lyc&#233;e et UFA Robert Schuman</span>
                
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;" valign="top" align="center">
                    Powered by <a style="color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;">LPRS Admin</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
';
                $toMail = $user->getMail();
                $a = $this->mail($subject, $body, $toMail);
                die($a);
                $_SESSION['success'] = "Bravo !! Vous êtes un nouveau utilisateur";
                return $_SESSION['success'];
            }
        } else {
            $_SESSION['erreur'] = 'erreur dans l inscription';
            return $_SESSION['erreur'];

        }
    }

    public function connexion($user)
    {
        session_start();
        $bdd = self::connexion_bdd();
        if ($user->getMail() == '' and $user->getMdp() == '') {
            throw new Exception("toutecasevide", 1);
        }
        if ($user->getMail() == '') {
            throw new Exception("uservide", 1);
        }
        if ($user->getMdp() == '') {
            throw new Exception("passwordvide", 1);
        }
        $req = $bdd->prepare("SELECT mdp,mail,profil,valide FROM user WHERE mail=:mail");
        $req->execute(array(
            'mail' => $user->getMail()
        ));
        $res = $req->fetch();

        if (password_verify($user->getMdp(), $res['mdp']) && $res['valide'] == 1) {
            $_SESSION['profil'] = $res['profil'];
            $_SESSION['mail'] = $res['mail'];
            $_SESSION['success'] = "Bravo !! Vous êtes connecté";
            return $_SESSION['success'];
            header("Location: ../index.php");
        } else if (password_verify($user->getMdp(), $res['mdp']) && $res['valide'] == 0) {
            $_SESSION['erreur'] = "Error ton compte est en cours de validation";
            return $_SESSION['erreur'];
            header("Location: ../index.php");
        } else {
            $_SESSION['erreur'] = "Error pendant la connexion";
            return $_SESSION['erreur'];
            header("Location: ../index.php");
        }
    }


    public function deconnexion()
    {
        session_start();
        session_destroy();
        header("Location: ../index.php");
    }

    public function modificationProfil($user)
    {
        session_start();
        $bdd = self::connexion_bdd();
        $req = $bdd->prepare('UPDATE user SET nom=:nom,prenom=:prenom,mail =:mail,profil= :profil, classe=:classe WHERE mail=:session');
        $req->execute(array(
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'mail' => $user->getMail(),
            'profil' => $user->getProfil(),
            'classe' => $user->getClasse(),
            'session' => $_SESSION['mail'],
        ));

        if ($req) {
            $_SESSION['success'] = "Votre compte a été modifier";
            return $_SESSION['success'];
            header("Location: ../view/profil/profil.php");
        } else {
            $_SESSION['erreur'] = "Votre compte n'a pas pu être modifier";
            return $_SESSION['erreur'];
            header("Location: ../view/profil/profil.php");
        }
    }

    public function addevent($event)
    {
        session_start();
        if ($_SESSION['profil'] == 'prof') {
            $valide = 1;
        } else {
            $valide = 0;
        }
        $bdd = self::connexion_bdd();
        $req = $bdd->prepare('SELECT * from evenement where libelle=:libelle ');
        $req->execute(array(
            'libelle' => $event->getLibelle(),
        ));
        $res = $req->fetch();
        if ($res) {
            $_SESSION['erreur'] = "Error evenement deja existant";
            header("Location: ../view/event/event.php");
        } elseif ($event->getLibelle() != '' and $event->getDateDebut() != '' and $event->getDateFin() != '' and $event->getDescription() != '' and $event->getLieu() != '') {
            $req = $bdd->prepare('INSERT INTO evenement(libelle,dateDebut,dateFin,description,image,valide,lieu) values (:libelle,:dateDebut,:dateFin,:description,:image,:valide,:lieu)');
            $req->execute(array(
                'libelle' => $event->getLibelle(),
                'dateDebut' => $event->getDateDebut(),
                'dateFin' => $event->getDateFin(),
                'description' => $event->getDescription(),
                'image' => $event->getImage(),
                'valide' => $valide,
                'lieu' => $event->getLieu(),
            ));
            if (isset($_SESSION['mail'])) {
                $mail = $_SESSION['mail'];
            }
            $request = $bdd->prepare('SELECT * from user where mail= :mail ');
            $request->execute(array(
                'mail' => $mail,
            ));
            $result = $request->fetchall();
            $req2 = $bdd->prepare('SELECT * from evenement where libelle= :libelle ');
            $req2->execute(array(
                'libelle' => $event->getLibelle(),
            ));
            $res2 = $req2->fetchall();
            $idUser = intval($result[0]['idUser']);
            $idEvent = intval($res2[0]['idEvent']);
            $request2 = $bdd->prepare('INSERT INTO creation(user,event,creation,organisateur) values (:user,:event,:creation,:organisateur)');
            $request2->execute(array(
                'user' => $idUser,
                'event' => $idEvent,
                'creation' => '1',
                'organisateur' => '1'
            ));
            if ($_SESSION['profil'] == 'prof') {
                $_SESSION['success'] = "L'event est bien ajouté";
            } else {
                $_SESSION['success'] = "L'event est bien ajouté en attente de validation";
            }
            header("Location: ../view/event/event.php");

        } else {
            $_SESSION['erreur'] = "Error il manque un élément";
            header("Location: ../view/event/event.php");
        }
    }

    function participerEvent($event, $mail)
    {
        $bdd = self::connexion_bdd();
        $req = $bdd->prepare('SELECT * from creation INNER JOIN evenement ON creation.event = evenement.idEvent INNER JOIN user ON creation.user = user.idUser where libelle=:libelle and mail=:mail');
        $req->execute(array(
            'libelle' => $event,
            'mail' => $mail,
        ));
        $res = $req->fetch();
        if (!empty($res)) {
            $_SESSION['erreur'] = 'vous participez deja';
            header("Location: ../view/event/event.php");
        } else {
            $request = $bdd->prepare('SELECT * from user where mail= :mail ');
            $request->execute(array(
                'mail' => $mail,
            ));
            $result = $request->fetchall();
            $req2 = $bdd->prepare('SELECT * from evenement where libelle= :libelle ');
            $req2->execute(array(
                'libelle' => $event,
            ));
            $res2 = $req2->fetchall();
            $idUser = intval($result[0]['idUser']);
            $idEvent = intval($res2[0]['idEvent']);
            $request2 = $bdd->prepare('INSERT INTO creation(user,event) values (:user,:event)');
            $request2->execute(array(
                'user' => $idUser,
                'event' => $idEvent,
            ));
            $_SESSION['success'] = 'vous participez à l évenement';
            header("Location: ../view/event/event.php");

        }

    }

    function addOrganisateur($event, $mail)
    {
        $bdd = self::connexion_bdd();
        $req = $bdd->prepare('SELECT * from creation INNER JOIN evenement ON creation.event = evenement.idEvent INNER JOIN user ON creation.user = user.idUser where libelle=:libelle and mail=:mail');
        $req->execute(array(
            'libelle' => $event,
            'mail' => $mail,
        ));
        $res = $req->fetch();
        if (isset($res) && $res['organisateur'] == '1') {
            $_SESSION['erreur'] = 'Cette utilisateur est déjà organisateur';
            header("Location: ../view/profil/profil.php");
        } else if (isset($res) && $res['organisateur'] == '0') {
            $request = $bdd->prepare('UPDATE creation INNER JOIN evenement ON creation.event = evenement.idEvent INNER JOIN user ON creation.user = user.idUser SET organisateur=:organisateur where libelle=:libelle and mail=:mail');
            $request->execute(array(
                'libelle' => $event,
                'mail' => $mail,
                'organisateur' => '1',
            ));
            $_SESSION['success'] = 'Cette utilisateur est un organisateur de cette evenement';
            header("Location: ../view/profil/profil.php");
        } else {
            $request = $bdd->prepare('SELECT * from user where mail= :mail ');
            $request->execute(array(
                'mail' => $mail,
            ));
            $result = $request->fetchall();
            $req2 = $bdd->prepare('SELECT * from evenement where libelle= :libelle ');
            $req2->execute(array(
                'libelle' => $event,
            ));
            $res2 = $req2->fetchall();
            $idUser = intval($result[0]['idUser']);
            $idEvent = intval($res2[0]['idEvent']);
            $request2 = $bdd->prepare('INSERT INTO creation(user,event,organisateur) values (:user,:event,:organisateur)');
            $request2->execute(array(
                'user' => $idUser,
                'event' => $idEvent,
                'organisateur' => '1',
            ));
            $_SESSION['success'] = 'Cette utilisateur est un organisateur de cette evenement';
            header("Location: ../view/profil/profil.php");

        }

    }

    function annuleEvent($event)
    {
        session_start();
        $bdd = self::connexion_bdd();
        $req = $bdd->prepare('SELECT idEvent from evenement where libelle= :libelle');
        $req->execute(array(
            'libelle' => $event->getLibelle(),
        ));
        $res = $req->fetch();
        $req2 = $bdd->prepare('delete from creation  where event=:event');
        $req2->execute(array(
            'event' => $res['idEvent'],
        ));
        $req3 = $bdd->prepare('delete from evenement where libelle=:libelle');
        $req3->execute(array(
            'libelle' => $event->getLibelle(),
        ));
        $_SESSION['success'] = 'vous avez supprimer l évenement';
        header("Location: ../view/event/event.php");
    }

    function annulePart($event,$mail)
    {
        session_start();
        $bdd = self::connexion_bdd();
        $req = $bdd->prepare('SELECT idEvent from evenement where libelle= :libelle');
        $req->execute(array(
            'libelle' => $event->getLibelle(),
        ));
        $res = $req->fetch();
        $req1 = $bdd->prepare('SELECT idUser from user where mail= :mail');
        $req1->execute(array(
            'mail' => $mail,
        ));
        $res1 = $req1->fetch();
        $req = $bdd->prepare('DELETE from creation where event=:event and user=:user');
        $req->execute(array(
            'event' => $res['idEvent'],
            'user' => $res1['idUser'],
        ));
        $_SESSION['success'] = 'vous ne participez plus à l évenement';
        header("Location: ../view/event/event.php");
    }

    public function mdpOublier($user)
    {
        session_start();
        $bdd = self::connexion_bdd();
        $requestid = $bdd->prepare('SELECT nom,prenom,idUser,mdp from user WHERE mail = ?');
        $requestid->execute(array($user->getMail()));
        if (!isset($requestid)) {
            throw new Exception("Error utilisateur n'existe pas");
            $_SESSION['erreur'] = "Error utilisateur inexistant";
            return $_SESSION['erreur'];
        } else {
            $info = $requestid->fetch();
//            $_SERVER['argv'];
//            $list = explode("\r\n", file_get_contents($argv[1])); # change \n to \r\n if you're using windows
//
//            $hash = $info['mdp']; # hash here, NB: use single quote (') , don't use double quote (")
//
//            if(isset($argv[1])) {
//                foreach($list as $wordlist) {
//                    print " [+]"; print (password_verify($wordlist, $hash)) ? "$hash -> $wordlist (OK)\n" : "$hash -> $wordlist (SALAH)\n";
//                }
//            } else {
//                print "usage: php ".$argv[0]." wordlist.txt\n";
//            }
            $mdpuser = $info['mdp'];
            $iduser = $info['idUser'];
            $preuser = $info['prenom'];
            $nomuser = $info['nom'];
            $subject = 'Bienvenue sur le Lycée & UFA Robert Schuman !';
            $body = '<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
  <style>
@media only screen and (max-width: 620px) {
  table[class=body] h1 {
    font-size: 28px !important;
    margin-bottom: 10px !important;
  }

  table[class=body] p,
table[class=body] ul,
table[class=body] ol,
table[class=body] td,
table[class=body] span,
table[class=body] a {
    font-size: 16px !important;
  }

  table[class=body] .wrapper,
table[class=body] .article {
    padding: 10px !important;
  }

  table[class=body] .content {
    padding: 0 !important;
  }

  table[class=body] .container {
    padding: 0 !important;
    width: 100% !important;
  }

  table[class=body] .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
  }

  table[class=body] .btn table {
    width: 100% !important;
  }

  table[class=body] .btn a {
    width: 100% !important;
  }

  table[class=body] .img-responsive {
    height: auto !important;
    max-width: 100% !important;
    width: auto !important;
  }
}
@media all {
  .ExternalClass {
    width: 100%;
  }

  .ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
    line-height: 100%;
  }

  .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
  }

  .btn-primary table td:hover {
    background-color: #d5075d !important;
  }

  .btn-primary a:hover {
    background-color: #d5075d !important;
    border-color: #d5075d !important;
  }
}
</style></head>
  <body class style="background-color: #eaebed; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #eaebed; width: 100%;" width="100%" bgcolor="#eaebed">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; Margin: 0 auto;" width="580" valign="top">
          <div class="header" style="padding: 20px 0;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
              <tr>
                <td class="align-center" style="font-family: sans-serif; font-size: 14px; vertical-align: top; text-align: center;" valign="top" align="center">
                </td>
              </tr>
            </table>
          </div>
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Bienvenue sur le site du Lycée Robert Schuman, voici votre mot de passe</span>
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Bonjour, ' . $preuser . ' ' . $nomuser . ' !</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Vous avez oublie votre mot de passe pour le site du Lycee Robert Schuman</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">

</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"> Votre mot de passe est : ' . $mdpuser . ' </p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;" width="100%">
                          <tbody>
                            <tr>
                              <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;">
                                  <tbody>
                                    <tr>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #9a9ea6; font-size: 12px; text-align: center;">Lyc&#233;e et UFA Robert Schuman</span>
                
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;" valign="top" align="center">
                    Powered by <a style="color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;">LPRS Admin</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
';
            $toMail = $user->getMail();
            $a = $this->mail($subject, $body, $toMail);
            $_SESSION['success'] = "Bravo !! Vous êtes un nouveau utilisateur";
            return $_SESSION['success'];
        }
    }

    function mail($subject, $body, $toMail)
    {

        require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/PHPMailer/PHPMailer.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/PHPMailer/SMTP.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/PHPMailer/Exception.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/PHPMailer/POP3.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/PHPMailer/OAuth.php");
        $mail = new PHPMailer();

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'projet.php.lprs@gmail.com';                     // SMTP username
            $mail->Password = 'ProjetLPRS';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            $mail->CharSet = 'text/html; charset=UTF-8;';
            //Recipients
            $mail->setFrom("projet.lprs.dev@gmail.com", "Lycée et UFA Robert Schuman");
            $mail->addAddress($toMail);
            // Add a recipient
            if (isset($toMail)) {
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AltBody = strip_tags($body);
                $mail->send();
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}