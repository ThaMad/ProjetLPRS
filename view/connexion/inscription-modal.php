<div class="modal fade" id="modal-inscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php if($_SESSION['page'] = 'pageInView'){echo '../../traitement/inscription.php'; } else { echo 'traitement/inscription.php'; }?>" method="post" id="form-inscription">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="text-center">Nom :</label>
                        </div>
                        <div class="col-md-10 ml-auto">
                            <input type="text" class="form-modal-inscription" id="nom" name="nom" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="text-center">Prenom :</label>
                        </div>
                        <div class="col-md-9 ml-auto">
                            <input type="text" class="form-modal-inscription" id="prenom" name="prenom" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="text-center">Mail :</label>
                        </div>
                        <div class="col-md-10 ml-auto">
                            <input type="email"  class="form-modal-inscription" id="mail_inscript" name="mail" required="true">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Mot de passe :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <input type="password" class="form-modal-inscription" id="mdp" name="mdp" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="text-center">Profil :</label>
                        </div>
                        <div class="col-md-4 ml-auto ">
                            <div class="custom-control">
                                <input type="radio" id="eleveradio" name="customRadioInline1" value="etudiant">
                                <label for="customRadioInline1">Eleve</label>
                            </div>
                        </div>
                        <div class="col-md-4 ml-auto">
                            <div class="custom-control">
                                <input type="radio" id="parentradio" name="customRadioInline1" value="parent">
                                <label for="customRadioInline2">Parent</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="inscription-envoi">Inscription</button>
            </div>
        </div>
        </form>
    </div>
</div>
