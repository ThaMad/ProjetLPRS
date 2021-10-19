<div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="traitement/addevent.php" method="post" id="form-add-event">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'un évenement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Libelle :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <input type="text" class="form-modal-inscription" id="libelle" name="libelle" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Date Début :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <input type="date" class="form-modal-inscription" id="dateD" name="dateD" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Date Fin :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <input type="date" class="form-modal-inscription" id="dateF" name="dateF" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Description :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <textarea class="form-modal-inscription" id="description" name="description" required></textarea>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Lien Image :</label>
                        </div>
                        <div class="col-md-8 ml-auto ">
                                <input type="file" id="inputImage" name="image" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="inscription-envoi">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>