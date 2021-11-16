<div class="modal fade" id="modal-add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="../../traitement/addevent.php" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="libelle" name="libelle" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Date Début :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <input type="date" class="form-control" id="dateD" name="dateD" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Date Fin :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <input type="date" class="form-control" id="dateF" name="dateF" required>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Description :</label>
                        </div>
                        <div class="col-md-8 ml-auto">
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-center">Lien Image :</label>
                        </div>
                        <div class="col-md-8 ml-auto ">
                            <input type="file" id="imageUpload" name="imageUpload" value="" accept=".png, .jpeg, .jpg">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4 ml-auto ">
                            <div class="custom-control">
                                <input type="radio" id="lieu" name="lieu" value="0" <?php if (isset($_SESSION['profil'])
                                    && $_SESSION['profil'] == 'etudiant') { ?> checked <?php } ?> required>
                                <label for="customRadioInline1">Interne</label>
                            </div>
                        </div>
                        <div class="col-md-4 ml-auto">
                            <div class="custom-control">
                                <input type="radio" id="lieu" name="lieu" value="1" <?php if (isset($_SESSION['profil'])
                                    && $_SESSION['profil'] == 'etudiant') { ?> disabled <?php } ?> required>
                                <label for="customRadioInline2">Externe</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" id="ajouterEvent">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
