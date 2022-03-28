<?php 

	include("csatlakozas.php");
	session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Bejegyzés létrehozás</title>

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
    include('fejlec.php'); ?>

<?php

	if (isset($_SESSION['bejelentkezve'])) {

		$_SESSION['leirasat'] = '';
		$_SESSION['cimet'] = '';
		$_SESSION['bekuldve'] = '';
		$_SESSION['hibabekuldesuzi'] = '';
 
		if (isset($_SESSION['id'])) {

			$bejegy_felhaszn_id = $_SESSION['id'];
		}?>

<?php

	$kitoltve = true;

	if (isset($_POST['tartalom'])) {

		if (empty($_POST['tartalom'])) {
			$_SESSION['leirasat'] = "Adjon leírást a bejegyzésnek.";

			$kitoltve = false;
		}

	}

	if (isset($_POST['cime'])) {
		if (empty($_POST['cime'])) {
			$_SESSION['cimet'] = "Adjon meg tágyat a bejegyzésnek.";

			$kitoltve = false;
		}
			
	}


	if (isset($_POST['tartalom']) && $kitoltve && isset($_POST['cime']) && $kitoltve) {

		$sql_insert = "INSERT INTO bejegyzesek (felhasznalo_id, cime, tartalom, jellege_id) VALUES (
		'$bejegy_felhaszn_id',
		'" . $_POST['cime'] . "',
		'" . $_POST['tartalom'] . "',
		'" . $_POST['jellege_id'] . "')";

		if ($conn->query($sql_insert) === TRUE) {
			$_SESSION['bekuldve'] = "A bejegyzést sikeresen beküldted!";
		} else {
			$_SESSION['hibabekuldesuzi'] = "Hiba a bejegyzés elküldése során: " . $sql_insert . "<br>" . $conn->error;
			}
	}

	$conn->close(); ?>

<?php

	$active = 'bejegyzesiras';
	include('navbar.php'); ?>

	<div class="tartalom container">
		<div class="container">

			<div class="row">
				<div class="col-12 col-sm-12 text-right">
					<p class="alert alert-link border-bottom" >Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p>
				</div>
			</div>

			<div class="row">
				<div class="alapszoveg container col-12 text-center form-group">

					<h3>Bejegyzésed létrehozása</h3>
					<p class="pt-2">Hozz létre bejegyzést amiben megosztod másokkal tapasztalataid,</p>
					<p class="">vagy tegyél fel kérdést bármelyik készülékkel kapcsolatban.</p>

				</div> 
			</div>

			<form class="" method="post" action="#">
				<div class="alert alert-link text-light">

					<div class="row"><?php echo($_SESSION['cimet']); ?></div>
					<div class="row"><?php echo($_SESSION['leirasat']); ?></div>
					<div class="row"><?php echo($_SESSION['hibabekuldesuzi']); ?></div> 	
							
				</div>

				<div class="alert alert-link text-dark col-sm-12">
					<?php echo($_SESSION['bekuldve']); ?>
				</div>

				<div class="alapszoveg container col-10">
					<div>
						<p class="mr-auto text-center font-weight-bold">Bejegyzés tárgya:</p>
							<textarea class="form-control" type="text" cols="10" rows="1" name="cime" minlength="10" maxlength="50" wrap="hard"></textarea><br/>
						<p class="py-3 text-center font-weight-bold">Bejegyzés tartalma:</p> 
							<textarea class="form-control" name="tartalom"  rows="10" cols="50" minlength="50" maxlength="250" placeholder="Fejtsd ki a panaszod, kérdésed, tanácsod."></textarea><br/><br>
					</div>
				</div>
							
				<div class="alapszoveg container text-center">
					<div class="col-12">
						<label class="font-weight-bold" for="jellege_id">Milyen jellegű a bejegyzésed?</label>
					</div>

						<div>
							<select name="jellege_id" id="jelleg">
								<option value="1">Segítségkérés</option>
								<option value="2">Tanácsadás</option>
								<option value="3">Vélemény írás</option>
							</select>
						</div>
				</div>
					
				<div class="row">
					<div class="container col-5 text-center form-group">
						<input class="my-5 btn btn-info form-group form-control" type="submit" value="Bejegyzés beküldése">
					</div>	
				</div>
			</form>
		</div>	
	</div>



	
<?php } else { ?>

<?php

	$active = 'bejegyzesiras';
	include('navbarkijelentkez.php'); ?>

	<div class="container p-4 text-center">
		<h3 class="text-center">Nincs jogosultságod megtekinteni az oldalt, amíg nem vagy bejelentkezve!</h3>
		<p>Kérlek jelentkezz be, vagy ha még nincs fiókod, regisztrálj!</p>
	</div>

	<div class="container text-center min-vh-100">

		<a href="bejelentkezes.php" class="btn btn-light form-group">Bejelentkezés</a>
		<p><a href="regisztralas.php">Regisztráció</p>

	</div>
		
<?php } ?>

	<footer class="container lablec text-center p-3"  style="height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>	
		
</div>
</body>
</html>