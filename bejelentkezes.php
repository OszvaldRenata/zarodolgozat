<?php

	include("csatlakozas.php");
	session_start(); 

	if (isset($_SESSION['fnev'])) {
		session_unset();
		session_destroy();
	}?>

<!DOCTYPE html>
<html>
<head>
<title>Bejelentkezés</title>

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
<body class="h-100">

<div class="container-fluid col-12 col-lg-10 offset-lg-1 px-lg-5">

<?php
 
	$_SESSION['uzi'] = '';
	$_SESSION['uresnev'] = '';
	$_SESSION['uresjelszo'] = '';
	


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		
		$fnev = $conn->real_escape_string($_POST['fnev']);
		$jelszo = md5($_POST['jelszo']);
		$jelszo_ellenorzes = "SELECT * FROM felhasznalok WHERE fnev = '$fnev' && jelszo = '$jelszo'"; 
		$helyes = $conn->query($jelszo_ellenorzes);
		$kitoltve = true;

		if ($helyes->num_rows > 0) {
			$sor = $helyes->fetch_assoc();

			$_SESSION['id'] = $sor['id'];
			$_SESSION['fnev'] = $sor['fnev'];
			$_SESSION['jelszo'] = $sor['jelszo'];

			$_SESSION['bejelentkezve'] = true;

			header("location: kezdooldal.php");
		}

		if (!empty($_POST['fnev']) && !empty($_POST['jelszo']) && $kitoltve == true) {

			if (isset($_POST['fnev']) && isset($_POST['jelszo'])) {

					$_SESSION['uzi'] = "Hibás felhasználónév vagy jelszó!";
			}
		}
			if (empty($_POST['fnev'])) {
					$_SESSION['uresnev'] = "Adja meg a felhasználónevét!";

					$kitoltve = false;
			}

			if (empty($_POST['jelszo'])) {
					$_SESSION['uresjelszo'] = "Adja meg a jelszavát!";

					$kitoltve = false;
			}
	}?>

<?php

	include('fejlec.php'); ?>

<?php
	
	$active = 'bejelentkezes';
	include('navbarkijelentkez.php'); ?>


	<div class="tartalom container">
		<div class="container">
			
			<div class="row">
				<div class="col-12 col-sm-12 text-black text-right">
					<p class="alert alert-link border-top border-bottom" >Nincs bejelentkezve</p>
				</div>
			</div>

			<div class="cimszoveg container text-center">
	            <h2>Bejelentkezés</h2>
	        </div>

			<div class="row min-vh-100">
				<div class="col-12 col-sm-12 text-center form-group">
					<p class="alapszoveg">Bejelentkezéshez használd a már meglévő felhasználóneved, és jelszavad!</p>
					<p class="alapszoveg">Ha még nincs fiókod, regisztrálj <a class="text-warning" type="button" href="regisztralas.php">ide kattintva.</a></p>
					 <p class="alapszoveg">Ha van fiókod lépj be egyszerűen, és kezdheted is a böngészést!</p>

				<form  class="form-inline" method = "post">
					<div class="alert alert-link text-light col-sm-12" ><?php echo($_SESSION['uzi']); ?>   
						<br>
						<?php echo($_SESSION['uresnev']); ?> <br>
						<?php echo($_SESSION['uresjelszo']); ?> <br>
					    <input class="form-control form-group" type="text" name="fnev" placeholder="Felhasználónév"> 
	                 	<input class="form-control form-group" type="password" name="jelszo" placeholder="Jelszó">
	                  	<button class="form-control form-group btn btn-outline-warning" type="submit" name="bejelentkezes" href="kezdooldal.php">Belépés</button>
	               	</div>
	            </form>

				</div> 
			</div>
		</div>
	</div>

	<footer class="container lablec text-center p-3"  style="height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>	
	
</div>
</body>
</html>