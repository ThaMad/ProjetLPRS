<!-- footer Start -->
<footer class="footer section gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mr-auto col-sm-6">
                <div class="widget mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">LYCÉE PRIVÉ ET UFA ROBERT SCHUMAN</h4>
                    <div class="divider mb-4"></div>
                    <p>Enseignement catholique sous contrat d'association avec l'Etat
                        Etablissement habilité à percevoir la taxe d'apprentissage
                        5 avenue du Général de Gaulle - 93440 Dugny
                        01 48 37 74 26 01 48 35 48 14
                        administration@lyceerobertschuman.com</p>
                  <?php  if(isset($_SESSION['mail'])){ ?>
                    <a href="traitement/deconnexion.php"><i class="fas fa-power-off"> Deconnexion </i></a> <?php } ?>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="widget widget-contact mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Accès</h4>
                    <div class="divider mb-4"></div>
                    <p>RER B (Le Bourget) et Bus 133 (Albert Chardavoine) RER B (La Courneuve) et Bus 249 (Albert Chardavoine) Tramway T11: arrêt Dugny-La Courneuve</p>

                    <div class="footer-contact-block mb-4">
                        <div class="icon d-flex align-items-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-btm py-4 mt-5">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                    <div class="copyright">
                        &copy; Copyright Reserved to <span class="text-color">Novena</span> by <a href="https://themefisher.com/" target="_blank">Themefisher</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



<!--
Essential Scripts
=====================================-->


<!-- Main jQuery -->
<script src="plugins/jquery/jquery.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!-- Bootstrap 4.3.2 -->
<script src="plugins/bootstrap/js/popper.js"></script>
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/counterup/jquery.easing.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Slick Slider -->
<script src="plugins/slick-carousel/slick/slick.min.js"></script>
<!-- Counterup -->
<script src="plugins/counterup/jquery.waypoints.min.js"></script>

<script src="plugins/shuffle/shuffle.min.js"></script>
<script src="plugins/counterup/jquery.counterup.min.js"></script>
<!-- Google Map -->
<script src="plugins/google-map/map.js"></script>
<script src="plugins/toastr/js/toastr.min.js"></script>

<script src="js/script.js"></script>
<script src="js/contact.js"></script>
<script src="js/connexion.js"></script>
<script src="js/app.js"></script>

<?php
include('view/connexion/connexion-modal.php');
include('view/connexion/inscription-modal.php');
include('view/connexion/mdp-oublier-modal.php');
include('view/connexion/modifmdp.php');


?>