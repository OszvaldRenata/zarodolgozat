<?php

	include("csatlakozas.php");
	session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Kezdőlap</title>

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

	include('fejlec.php'); ?>

	<?php

	if (isset($_SESSION['bejelentkezve'])) {

		$active = 'fooldal';
		include('navbar.php'); ?>


		<div class="tartalom container">
			<div class="container">

				<div class="row">
					<div class="col-12 col-sm-12 text-right">
						<p class="alert alert-link border-top border-bottom" >Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p> 
					</div>
				</div>
					
				<div class="row min-vh-100">
					<div class="col-12 col-sm-6 col-md-8 text-center">
						<h4 class="alert alert-link" >Kedves <?php echo($_SESSION['fnev']); ?>!</h4> 
						<h4>Üdvözöllek a TeleFoGás weboldalon!</h4><br>

							<p class="cimszoveg font-weight-bold text-center">Most hogy bejelentkeztél:</p>
							     
								<div class="alapszoveg text-center">
							    	<p> Adhatsz fel hirdetést! ✓<br>
							    		Megnézheted mások hirdetéseit! ✓<br>
							      		Hozzáférhetsz a bloghoz! ✓<br>
							     		Írhatsz blog bejegyzést! ✓</p>
							    	<p>Illetve módosíthatod saját bejegyzéseid / apróhirdetéseid. ✓</p>	 
					      		</div>	      		
					</div>
							  	
					<div class="col-12 col-sm-6 col-md-4 text-center">

						<a class="my-3 btn btn-success font-weight-bold form-control text-light" href="hirdetesfeladas.php">Hirdetésfeladás</a>
			            <a class="btn btn-info font-weight-bold form-control form-group text-light" href="bejegyzesiras.php">Bejegyzés létrehozása</a>
			            <a class="my-3 btn btn-warning font-weight-bold form-control" href="sajathirdetes.php">Saját hirdetések</a>
			            <a class="btn btn-warning font-weight-bold form-control form-group" href="sajatblog.php">Saját bejegyzések</a>

					</div>
				</div>
			</div>
		</div>

		<?php

	}else { ?>

		<?php 

		$active = 'kezdooldal';
		include('navbarkijelentkez.php'); ?>

		<div class="tartalom container min-vh-100">
			<div class="container">
				
				<div class="row">
					<div class="col-12 col-sm-12 text-right">
						<p class="alert alert-link border-top border-bottom" >Nincs bejelentkezve</p>
					</div>
				</div>

				<div class="row min-vh-100">
					<div class="col-12 col-sm-12 col-lg-12 col-md-12 text-center py-2 form-group text-justify">
						<h2>Üdvözöllek a TeleFoGás weboldalán!</h2><br>
						<p class="alapszoveg">Ez a weboldal mobiltelefon adás-vételre készült.</p>
						<p class="alapszoveg">Csináld meg apróhirdetésed gyorsan, egyszerűen, és add el készüléked!</p>
						<p class="alapszoveg">Nincs más dolgod mint regisztrálnod,<br> majd egyszerűen belépni a megadott felhasználónévvel, és jelszóval.</p>	   	
					</div>
				</div>
			</div>
		</div>
				
	<?php 	
	} ?>

	<footer class="container lablec text-center p-3"  style="height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>

</div>
</body>
</html>