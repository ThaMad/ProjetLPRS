<form action="../../traitement/inscription.php" method="post" id="form-inscription">
    <div class="modal fade" id="modal-inscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                            <input type="email" class="form-modal-inscription" id="mail" name="mail" required>
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
                        <div class="col-md-4">
                            <label class="text-center">Date Naissance :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <input type="date" class="form-modal-inscription" id="date" name="date" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="text-center">Profil :</label>
                        </div>
                        <div class="col-md-2 ml-auto">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">Eleve</label>
                            </div>
                        </div>
                        <div class="col-md-4 ml-auto">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Parent</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="inscription-envoi">Inscription</button>
                </div>
            </div>
        </div>
    </div>
</form>