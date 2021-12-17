<div class="modal fade" id="modifMdp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="<?php if ($_SESSION['page'] == 'pageInView') {
            echo '../../traitement/newMdp.php';
        } else {
            echo 'traitement/newMdp.php';
        } ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto">
                            <label class="text-center">Nouveau mot de passe :</label>
                        </div>
                        <div class="col-sm-2 ml-auto"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 ml-auto">
                            <input type="password" class="form-modal-inscription" id="newMdp" name="newMdp" required>
                        </div>
                        <div class="col-sm-1 ml-auto"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </form>
    </div>
</div>