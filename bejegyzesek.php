<?php

	include("csatlakozas.php");
	session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Bejegyzések</title>

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

		$active = 'bejegyzesek';
		include('navbar.php'); ?>

		<div class="tartalom container">
			<div class="container min-vh-100">

				<div class="row">
					<div class="col-12 col-sm-12 text-right">
						<p class="alert alert-link border-top border-bottom" >Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p>
					</div>
				</div>

				<div class="alapszoveg row col-12 py-2">
					<h5 style="text-align: center;">Milyen jellegű bejegyzést keresel?</h5>
				</div>

				<?php

				$jellege_kivalasztas = "SELECT id, jellegenev FROM bejegyzesjellege";
				$jellege_eredmeny = $conn->query($jellege_kivalasztas);

				while ($jellegesor = $jellege_eredmeny->fetch_assoc()) { ?>

					<table class="container col-12">
						<tr>
						<td>
				
							<form class="text-center" method="post" action="bejegyzeskategoriak.php">

								<button class="bejegyzesgomb col-5" type="submit">
									<p><?php echo $jellegesor['jellegenev']; ?> </p>	
								</button>
								<input value="<?php echo $jellegesor['id']; ?>" type="hidden" name="id">

							</form>
					
						</td>
						</tr>
					</table>
				<?php  
				} ?>

			</div>
		</div>

		<?php
	}else { ?>

		<?php 

		$active = 'bejegyzesek';
		include('navbarkijelentkez.php'); ?>

		<div class="container p-4 text-center">
			<h3 class="text-center">Nincs jogosultságod megtekinteni az oldalt, amíg nem vagy bejelentkezve!</h3>
			<p>Kérlek jelentkezz be, vagy ha még nincs fiókod, regisztrálj!</p>
		</div>

		<div class="container text-center min-vh-100">
			<a href="bejelentkezes.php" class="btn btn-light form-group">Bejelentkezés</a>
			<p><a href="regisztralas.php">Regisztráció</p>
		</div>
		
		<?php

		$conn->close();
 
	} ?>

	<footer class="container lablec text-center p-3"  style=" height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>
		
</div>
</body>
</html>