<div class="modal fade" id="modal-connexion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php if($_SESSION['page'] == 'pageInView'){echo '../../traitement/connexion.php'; } else { echo 'traitement/connexion.php'; }?>" method="post" id="form-connexion">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            <label class="text-center">Mail :</label>
                        </div>
                        <div class="col-sm-2 ml-auto"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 ml-auto">
                            <input type="email" class="form-control" id="mail_connexion" name="mail" required="true">
                        </div>
                        <div class="col-sm-1 ml-auto"></div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4 ml-auto">
                            <label class="text-center">Mot de passe :</label>
                        </div>
                        <div class="col-sm-2 ml-auto"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 ml-auto">
                            <input type="password" class="form-control " id="password" name="mdp" required="true">
                        </div>
                        <div class="col-sm-1 ml-auto"></div>
                    </div>
                    </br>
                    <p>Vous avez oubliez votre mot de passe : <a href="#" id="mdp-oublier">Mot de passe oubli??</a>
                    </p>
                    <p>Si vous n'avez pas encore de compte: <a href="#" id="inscription">Inscrivez-vous !</a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="connexion-envoi">Connexion</button>
                </div>
            </div>
        </form>
    </div>

</div>