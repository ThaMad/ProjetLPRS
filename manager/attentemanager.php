<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");

class attentemanager extends Manager
{

    /*
    function mail(string $subject,string $body,string $select_idUser,string $toMail){


        // Load Composer's autoloader
        require '../../Tools/vendor/autoload.php';
        //header("Location:../../index.php?key=4xfq26NPP");
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {

            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            //$mail->Username   = 'sullivan.sextius@gmail.com';                     // SMTP username
            //$mail->Password   = 'mk8yi7eaqM';

            $mail->Username   = 'dev@lprs.fr';                     // SMTP username
            $mail->Password   = 'Maj04641';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            $mail->CharSet = 'text/html; charset=UTF-8;';
            //Recipients
            $mail->setFrom("dev@lprs.fr","Lycée et UFA Robert Schuman");
            $mail->addAddress($toMail);
            // Add a recipient
            if(isset($toMail)){
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $body;

                // "<p>Un nouveau ticket de la part de : ".$select_idUser." </br>Avec comme desription : ".$body."</p>";
                $mail->AltBody =  strip_tags($body);
                $mail->send();

            }
        }



        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";


        }

    }
*/

    public function suppressionUser($idUser)
    {
        $bdd = parent::connexion_bdd();
        #ON SUPPRIME TOUT CE QUI EST LIÉ A L'ID USER
        $delete_messages = $bdd->prepare("DELETE FROM messages WHERE userExp = $idUser OR userDest = $idUser");
        $delete_messages = $delete_messages->execute(array());

        $delete_lien = $bdd->prepare("DELETE FROM lien WHERE parent = $idUser OR eleve = $idUser");
        $delete_lien = $delete_lien->execute(array());

        $delete_creation = $bdd->prepare("DELETE FROM creation WHERE user = $idUser");
        $delete_creation = $delete_creation->execute(array());

        $delete_rdv = $bdd->prepare("DELETE FROM rdv WHERE parent = $idUser or professeur = $idUser");
        $delete_rdv = $delete_rdv->execute(array());

        $delete_projet = $bdd->prepare("DELETE FROM projet_ed WHERE prof = $idUser");
        $delete_projet = $delete_projet->execute(array());

        $delete_user = $bdd->prepare("DELETE FROM user WHERE idUser = ?");
        #PUIS ON SUPPRIME L'USER.
        $delete_user = $delete_user->execute(array($idUser));
        if ($delete_user != null) {
            header('Location:/ProjetLPRS/view/admin/gestionuser.php');
        } else {
            echo 'error';
        }
    }

    public function ajoutUser($user)
    {


        $db = parent::connexion_bdd();
        $testmail = $user->getMail();
        $requestcheck = $db->prepare('SELECT mail FROM user WHERE mail = ?');
        $requestcheck->execute(array($testmail));
        $requestcheck = $requestcheck->fetch();
        if ($requestcheck) {

            header("Location:/ProjetLPRS/view/Admin/gestionuser.php?erreur_mail_user=cQfTjWnZ");
        } else {
            $request = $db->prepare('INSERT INTO user (nom,prenom,mail,profil,classe,valide,mdp) VALUES (?, ?, LCASE(?), ?, ?, ?,?)');
            //$encrypteddefaultmdp = $this->encrypt($this->genererChaineAleatoire(), '1f4276388ad3214c873428dbef42243f');
            $request->execute(array(
                $user->getNom(),
                $user->getPrenom(),
                $user->getMail(),
                $user->getProfil(),
                $user->getClasse(),
                "0",
                "test"
            ));
            if (isset($request)) {
                /*
                $requestid=$db->prepare('SELECT nom,prenom,idUser,mdp from user WHERE mail = ?');
                $requestid->execute(array($user->getMail()));
                $info = $requestid->fetch();
                //$decryptedmdp=$this->decrypt($info['mdp'],'1f4276388ad3214c873428dbef42243f');
                $mdpuser=$info['mdp'];
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
                  <a href="https://snacklprs.fr" style="color: #ec0867; text-decoration: underline;"><img src="https://i.ibb.co/n6h0RDr/image-2.png" height="100" alt="snacklprs" style="border: none; -ms-interpolation-mode: bicubic; max-width: 100%;"></a>
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
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Bienvenue sur le lycée et UFA Robert Schuman, '.$preuser.' '.$nomuser. ' !</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Vous venez d etre inscrit au Snack par les incroyables administrateurs(trices) du site 😌</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">

</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"> Votre mot de passe : '.$mdpuser.' </p>
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
                    <span class="apple-link" style="color: #9a9ea6; font-size: 12px; text-align: center;">Snack LPRS, Lyc&#233;e et UFA Robert Schuman</span>
                
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;" valign="top" align="center">
                    Powered by <a href="https://snacklprs.fr" style="color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;">by Snack LPRS Admin</a>.
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
                $toMail=$user->getMail();
                $a=$this->mail($subject,$body,$iduser,$toMail);
*/
                header("Location:/ProjetLPRS/view/Admin/gestionuser.php?new_user=Y7Z3i7aEm");
            } else {
                header("Location:/ProjetLPRS/view/Admin/gestionuser.php?erreur_new_user=K7YJ4pkp9");
            }
        }

    }

    public function activer($idUser)
    {
        //on appelle la méthode connexion_bd depuis le parent de la classe boite_ideeManager
        $bdd = parent::connexion_bdd();
        //on prépare la requête SQL
        $activer = $bdd->prepare("UPDATE user SET valide='1' WHERE idUser = ?");
        //on déclare la variable pour supprie l'idees
        $activer = $activer->execute(array($idUser));
        if ($activer != null) {
            header('Location:/ProjetLPRS/view/Admin/gestionuser.php?user_valide=Y7Z3i7aEm');
        } else {
            header('Location:/ProjetLPRS/view/Admin/gestionuser.php?erreur_valide=K7YJ4pkp9');
        }


    }

    public function desactiver($idUser)
    {
        //on appelle la méthode connexion_bd depuis le parent de la classe boite_ideeManager
        $bdd = parent::connexion_bdd();
        //on prépare la requête SQL
        $desactiver = $bdd->prepare("UPDATE user SET valide='0' WHERE idUser = ?");
        //on déclare la variable pour supprie l'idees
        $desactiver = $desactiver->execute(array($idUser));
        if ($desactiver != null) {
            header('Location:/ProjetLPRS/view/Admin/gestionuser.php?user_desactive=Y7Z3i7aEm');
        } else {
            header('Location:/ProjetLPRS/view/Admin/gestionuser.php?erreur_desactive=K7YJ4pkp9');
        }


    }

    public function newConversation($messages)
    {
        $db = parent::connexion_bdd();
        $request = $db->prepare('INSERT INTO messages(userExp,userDest,message,date) VALUES (?,?,?,?)');

        $request->execute(array(
            $messages->getUserExp(), $messages->getUserDest(), $messages->getMessage(), $messages->getDate()
        ));
        if (isset($request)) {
            header("Location:/ProjetLPRS/view/chatbox/chatbox.php?new_conv=Y7Z3i7aEm");
        } else {
            header("Location:/ProjetLPRS/view/chatbox/chatbox.php?errornewconv=K7YJ4pkp9");
        }
    }


    public function ajoutProjet($projeted)
    {


        $db = parent::connexion_bdd();
            $request = $db->prepare('INSERT INTO projet_ed (libelle,cours,classe,prof,date) VALUES (?,?,?,?,?)');
            $res= $request->execute(array(
                $projeted->getLibelle(),
                $projeted->getCours(),
                (int)$projeted->getClasse(),
                (int)$projeted->getProf(),
                $projeted->getDate(),
            ));

            if ($res== true) {
                header("Location:/ProjetLPRS/view/projet_educatif/projets.php?new_projet=Y7Z3i7aEm");
            } else {
                header("Location:/ProjetLPRS/view/projet_educatif/projets.php?erreur_new_projet=K7YJ4pkp9");
            }
        }



    public function suppressionProjet($idProjet)
    {
        $bdd = parent::connexion_bdd();
        $delete_projet = $bdd->prepare("DELETE FROM projet_ed WHERE idProjet = ?");
        $delete_projet = $delete_projet->execute(array($idProjet));
        if ($delete_projet != null) {
            header('Location:/ProjetLPRS/view/projet_educatif/projets.php?erreur_delete_projet=K7YJ4pkp9');
        } else {
            echo 'error';
        }
    }
    public function addRdv($rdv)
    {


        $db = parent::connexion_bdd();
        $request = $db->prepare('INSERT INTO rdv (professeur,parent,libelle,horaire) VALUES (?,?,?,?)');
        $res= $request->execute(array(
            $rdv->getProfesseur(),
            $rdv->getParent(),
            $rdv->getLibelle(),
            $rdv->getHoraire()
        ));

        if ($res== true) {
            header("Location:/ProjetLPRS/view/profil/rendezvous.php?new_projet=Y7Z3i7aEm");
        } else {
            header("Location:/ProjetLPRS/view/profil/rendezvous.php?erreur_new_projet=K7YJ4pkp9");
        }
    }

    public function addCompteRendu($rdv)
    {
        $db=parent::connexion_bdd();
        $request = $db->prepare('UPDATE rdv SET compterendu= ? WHERE idRdv = ?');
        $res = $request->execute(array($rdv->getCompterendu(),
            $rdv->getIdrdv()));

        if ($res==true){
            header("Location:/ProjetLPRS/view/profil/rendezvous.php?new_compterendu=Y7Z3i7aEm");
        }
        else {
            header("Location:/ProjetLPRS/view/profil/rendezvous.php?erreur_compterendu=K7YJ4pkp9");
        }


    }

    public function suppressionCompteRendu($idRdv){
        $db=parent::connexion_bdd();
        $request = $db->prepare('DELETE FROM rdv WHERE idRdv = ?');
        $res = $request->execute(array($idRdv));


        if ($res==true){
            header("Location:/ProjetLPRS/view/profil/rendezvous.php?delete_rdv=Y7Z3i7aEm");
        }
        else {
            header("Location:/ProjetLPRS/view/profil/rendezvous.php?erreur_deleterdv=K7YJ4pkp9");
        }


    }



}
