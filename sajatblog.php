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

	include('fejlec.php');

	if (isset($_SESSION['bejelentkezve'])) {

		if (isset($_SESSION['id'])) {
			$sajatnev = $_SESSION['id'];
		}
	  
		$active = 'sajatblog';
		include('navbar.php'); ?>


	<div class="tartalom container">
		<div class="container min-vh-100">

			<div class="row">
				<div class="col-12 col-sm-12 text-right">
					<p class="alert alert-link border-top border-bottom">Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p>
				</div>
			</div>
				
			<div>
				<h5>Itt tudod kezelni a bejegyzéseidet.</h5>
			</div>

		<?php 

	    if (isset($_POST['submitdelete'])) {
	    	 	
	    $key = $_POST['torles'];

	    $sor_torles = "DELETE FROM bejegyzesek WHERE id = '$key' ";

	    $torles_eredmeny = $conn->query($sor_torles);
	    	echo "Adat törölve.<br>";

	   	}

	   	if (isset($_POST['update'])) {

	   	$key = $_POST['azon'];

	   	$sor_update = "UPDATE bejegyzesek SET cime = '".$_POST['cim']."', tartalom = '".$_POST['tartalma']."' WHERE id = '$key' ";

	   		
	   	if ($conn->query($sor_update) == true) {
	   			echo "Adat frissítve!<br>";
	   		} else {echo "hiba lépett fel: " . $conn->error;}
	   		
	   	}

		$kivalasztas = "SELECT * FROM bejegyzesek WHERE felhasznalo_id = '$sajatnev' ";

	    	$eredmeny = $conn->query($kivalasztas);

	    	if ($eredmeny->num_rows > 0) {

	        	while ($sor = $eredmeny->fetch_assoc()) { ?>
	        	
		        	<div class="container sajathirdetesek text-center border border-dark">

						<div class="row py-2">
							<div class="col-12 col-sm-12 col-md-2 col-lg-1">

								<form method="post">

									<p><u>Tevékenység</u></p>
									<input type="hidden" name="torles" value="<?php echo $sor['id']; ?>">
									<button onclick="return confirm('Biztosan törölni szeretnéd?')" class="mb-2" type="submit" name="submitdelete">Törlés</button>
								
								</form>
									<button id="<?php echo 'show'.$sor['id'];?>" type="button">Szerkesztés</button>
							</div>

							<div class="col-12 col-sm-12 col-md-4 col-lg-4">
								<p><u>Cím</u></p>
								<p class="hszoveg"><?php echo $sor['cime'];?></p>
							</div>

							<div class="col-12 col-sm-12 col-md-4 col-lg-4">
								<p><u>Leírás</u></p>
								<p class="hszoveg"><?php echo $sor['tartalom'];?></p>
							</div>

							<div class="col-12 col-sm-12 col-md-2 col-lg-3">
								<p><u>Közzétéve</u></p>
								<p><?php echo $sor['datum'];?></p>
							</div>

		          		</div>
		          		<div>
		          			<div>
		          			<form method="post">

		          				<input type="hidden" name="azon" value="<?php echo $sor['id'];?>">
			          			<textarea required name="cim" minlength="10" maxlength="50" class="col-8" cols="30" rows="3" style="display: none;" id="<?php echo 'texta'.$sor['id']; ?>"><?php echo $sor['cime'];?></textarea>
			          			<textarea required name="tartalma" minlength="50" maxlength="250" class="col-8" cols="30" rows="3" style="display: none;" id="<?php echo 'texti'.$sor['id']; ?>"><?php echo $sor['tartalom'];?></textarea><br>
			          			<button name="update" value="<?php echo $sor['id']; ?>" style="display: none;" id="<?php echo 'gombi'.$sor['id']; ?>">Frissít</button>

							</form>
							</div>
						</div>

		       		</div>

					<script type="text/javascript">
					
						$(document).ready(function(){
							var textarea = $('#<?php echo 'texta'.$sor['id']; ?>');
							var textarea1 = $('#<?php echo 'texti'.$sor['id']; ?>');
							var button = $('#<?php echo 'gombi'.$sor['id']; ?>');

							$("#<?php echo 'show'.$sor['id'];?>").click(function(){
								textarea.show();
								textarea1.show();
								button.show();
							});
						});

						</script>

					<?php 
				}
				
			} else { echo "Még nincsen megjelenítendő hirdetésed.";} ?>

		</div>
	</div>

	<?php

	$conn->close();

	} else { ?>

		<?php  

			$active = 'sajatblog';
			include('navbarkijelentkez.php'); ?>

	<div class="container p-4 text-center">
		<h3 class="text-center">Nincs jogosultságod megtekinteni az oldalt, amíg nem vagy bejelentkezve!</h3>
		<p>Kérlek jelentkezz be, vagy ha még nincs fiókod, regisztrálj!</p>
	</div>

	<div class="container text-center min-vh-100">
		<a href="bejelentkezes.php" class="btn btn-light form-group">Bejelentkezés</a>
	<p><a href="regisztralas.php">Regisztráció</p>
	</div>
		
<?php }	?>

	<footer class="container lablec text-center p-3"  style=" height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>

</div>
</body>
</html>