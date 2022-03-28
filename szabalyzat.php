<?php

	include("csatlakozas.php");
	session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Szabályzat</title>

<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Oszvald Renáta" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="formazas.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid col-12 col-lg-10 offset-lg-1 px-lg-5">

	<?php 

	include('fejlec.php');

	if (isset($_SESSION['bejelentkezve'])) {
		
	$active = 'szabalyzat';
	include('navbar.php');

	$conn->close(); ?>


		<div class="tartalom container min-vh-100">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 text-right">
						<p class="alert alert-link border-top border-bottom" >Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-sm-12 text-center py-2">
						<h4>A szabályzat elolvasása minden tag számára ajánlott!</h4><br>
					</div>
				</div>

				<div class="row"> 
					<div class="alapszoveg col-12 col-sm-6 text-center py-2 border-right border-dark">

						<p class="font-weight-bold">Hírdetésre vonatkozóak:</p>

						    <li class="mr-auto" style="list-style-type:square">Mielőtt kiraksz egy hírdetést győződj meg róla, hogy helyes adatokat adtál-e meg, ha nem, javítsd.
						    </li>
						    <li class="mr-auto" style="list-style-type:square">Ne használj illetlen szavakat, megfogalmazásod legyen egyértelmű.
						    </li><br>
					</div>

					<div class="alapszoveg col-12 col-sm-6 text-center py-2 border-left border-dark">
						<p class="font-weight-bold">Blog írásra vonatkozóak:</p>
						<li class="mr-auto" style="list-style-type:square">Kérésed, kérdésed szépen fogalmazd meg.</li>
						<li class="mr-auto" style="list-style-type:square">Itt is érvényesül az illetlen szavak használatának elkerülése, illetve az efyértelmű megfogalmazás!</li>
					</div>

				</div>		
			</div>
		</div>

<?php 
	} else {

		$active = 'szabalyzat';
		include('navbarkijelentkez.php'); ?>
	
		<div class="container p-4 text-center">
			<h3 class="text-center">Nincs jogosultságod megtekinteni az oldalt, amíg nem vagy bejelentkezve!</h3>
			<p class="alapszoveg">Kérlek jelentkezz be, vagy ha még nincs fiókod, regisztrálj!</p>
		</div>

		<div class="container text-center min-vh-100">
			<a href="bejelentkezes.php" class="btn btn-light form-group">Bejelentkezés</a>
			<p><a href="regisztralas.php">Regisztráció</p>
		</div>

	<?php
	} ?>

	<footer class="container lablec text-center p-3"  style=" height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>

</div>
</body>
</html>