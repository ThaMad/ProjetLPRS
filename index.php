<?php
include('view/header/header.php');
?>
<!-- Slider Start -->
<section class="banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-xl-7">
				<div class="block">
					<div class="divider mb-3"></div>
					<h1 class="mb-3 mt-3">LYCÉE PRIVÉ ET UFA - ROBERT SCHUMAN</h1>
					
					<p class="mb-4 pr-5">Enseignement catholique sous contrat avec l'état.</p>
                    <?php if(!isset($_SESSION['mail'])){ ?>
					<div class="btn-container ">
						<a href="#" id="connexion" class="btn btn-main-2 btn-icon btn-round-full">Connectez-vous <i class="icofont-simple-right ml-2  "></i></a>
					</div>
                    <?php } ?>
                </div>
			</div>
		</div>
	</div>
</section>
<section class="features">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="feature-block d-lg-flex">
                    <?php if(!isset($_SESSION['mail'])){ ?>
                    <div class="feature-item mb-5 mb-lg-0">
						<div class="feature-icon mb-4">
							<i class="icofont-connection"></i>
						</div>
						<h4 class="mb-3">Inscrivez-vous</h4>
						<p class="mb-4">Si vous n'avez pas encore de compte ? Inscrivez-vous !</p>
						<a href="#" id="inscription" class="btn btn-main btn-round-full">Inscription</a>
					</div>
                    <?php } else {?>
                    <div class="feature-item mb-5 mb-lg-0">
                        <div class="feature-icon mb-4">
                            <i class="icofont-connection"></i>
                        </div>
                        <h4 class="mb-3">Mon profil</h4>
                        <p class="mb-4">Maintenant que vous êtes connecté jetez un oeil sur votre profil !</p>
                        <a href="view/profil/profil.php" id="inscription" class="btn btn-main btn-round-full">Mon Profil</a>
                    </div>
                    <?php }?>


                    <div class="feature-item mb-5 mb-lg-0">
						<div class="feature-icon mb-4">
							<i class="icofont-building-alt"></i>
						</div>
						<h4 class="mb-3">L'Établissement</h4>
                        <p class="mb-4">Qui sommes-nous ? Découvrez notre historique et nos projets.</p>
                        <a href="./view/presentation/about.php" class="btn btn-main btn-round-full">Etablissement</a>
					</div>
				
					<div class="feature-item mb-5 mb-lg-0">
						<div class="feature-icon mb-4">
							<i class="icofont-support"></i>
						</div>
						<h4 class="mb-3">Dates clés</h4>
						<p>Les dates à retenir concernant l'établissement Robert Schuman et l'élève.</p>
                        <a href="./view/presentation/about.php" class="btn btn-main btn-round-full">Date</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="section about">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-4 col-sm-6">
				<div class="about-img">
					<img src="images/about/event1.jpg" alt="" class="img-fluid">
					<img src="images/about/event2.jpg" alt="" class="img-fluid mt-4">
				</div>
			</div>
			<div class="col-lg-4 col-sm-6">
				<div class="about-img mt-4 mt-lg-0">
					<img src="images/about/event3.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="about-content pl-4 mt-4 mt-lg-0">
					<h2 class="title-color">Evenement</h2>
					<p class="mt-4 mb-5">L'établissement organise plusieurs évenements que vous pouvez découvrir en cliquant sur le lien ci-dessous.</p>

					<a href="view/event/event.php" class="btn btn-main-2 btn-round-full btn-icon">Evenement<i class="icofont-simple-right ml-3"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
include('view/footer/footer.php');
?>
<?php if(isset($_SESSION['mailModif']) && $_SESSION['mailModif'] != '' ){ ?>
    <script type="text/javascript">
        $('#modifMdp').modal('show');
    </script>
    <?php } ?>
<?php if(isset($_SESSION['erreur']) && $_SESSION['erreur'] !=''){ ?>
    <script type="text/javascript">
        app.displayErrorNotification('<?php echo $_SESSION['erreur']; ?>');
    </script>
    <?php $_SESSION['erreur']=''; } elseif(isset($_SESSION['success']) && $_SESSION['success'] !=''){ ?>
    <script type="text/javascript">
        app.displaySuccessNotification('<?php echo $_SESSION['success']; ?>');
    </script>
    <?php $_SESSION['success'] = '';} ?>

</body>
</html>
   