<!-- DATA TABLE -->
<section class="section service-2">
    <div class="container">

        <center>
        <div class="table-responsive" style="width:100%;">
            <table id="table" class="display dt-responsive" style="width:100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Classe</th>
                    <th>E-mail</th>
                    <th>Profil</th>
                    <th>Statut</th>

                    <th>Supprimer</th>
                    <th>Restrictions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($user as $value){
                    ?>
                    <tr>
                        <td><?php echo $value['idUser'];?></td>
                        <td id><?php echo $value['nom'];?></td>
                        <td><?php echo $value['prenom'];?></td>
                        <td><?php echo $value['libelle'];?></td>
                        <td><?php echo $value['mail'];?></td>
                        <td><?php echo $value['profil'];?></td>
                        <td><?php if($value['valide']==1){
                            echo 'Validé';
                            }
                            else if($value['valide']==0){
                                echo 'Non validé';
                            }?></td>
                        <td>
                            <a class="d-block mx-auto btn btn-danger text-white" href="../../traitement/Admin/delete_user.php?idUser=<?php echo $value['idUser'];?>"><i class="fas fa-times" onclick="DeleteUser(this.id)"> Supprimer</i></a>
                        </td>
                        <td>
                            <?php
                            if($value['valide']=="0"){?>
                                <a style="background:#000;" class="d-block mx-auto btn btn-answer text-white" href="../../traitement/admin/activer.php?idUser=<?php echo $value['idUser']; ?>"><i class="fas fa-unlock"></i> Activer </a>
                            <?php }
                            if ($value['valide']=="1"){?>
                                <a style="background:#000;" class="d-block mx-auto btn btn-answer text-white" href="../../traitement/admin/desactiver.php?idUser=<?php echo $value['idUser']; ?>"><i class="fas fa-ban"></i> Desactiver </a>
                            <?php }?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
            <div style="padding-left: 100px;" >
                <div class="btnEvent"><button class="btn btn-info add-new" data-toggle="modal" data-target="#add_user" data-whatever="@getbootstrap" id="add_user"><i class="fa fa-plus"></i> Ajouter un utilisateur</button></div>
            </div>
        </center>
    </div>
    </div>
</section>