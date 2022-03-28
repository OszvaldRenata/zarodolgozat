<?php 

	include("csatlakozas.php");
	session_start(); 

	$_SESSION['hiba'] = '';
	$_SESSION['bekuldott'] = '';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['id'])) {
			$_SESSION['jellegenev_id'] = $_POST['id'];
		}

		if (isset($_POST['bekuldesgomb'])) {

			$bejegy_id = $_POST['bekuldesgomb'];

		 	$nemures = true;

			if (isset($_POST['hozzaszolas'])) {

				if (empty($_POST['hozzaszolas'])) {
					$_SESSION['komment'] = "Üresen nem küldheted be!";

					$nemures = false;
				}
			}

			if (isset($_POST['hozzaszolas']) && $nemures) {

				$komment_insert = "INSERT INTO hozzaszolas (hozzaszolas, bejegyzes_id, felhasznalo_id) 
					VALUES ('" . $_POST['hozzaszolas'] . "', '$bejegy_id', '". $_SESSION['id'] ."' ) ";

				if ($conn->query($komment_insert) === TRUE) {

					$_SESSION['bekuldott'] = "Sikeresen hozzászoltál";

				} else {
				  	$_SESSION['hiba'] = "Hiba lépett fel: " . $komment_insert . "<br>" . $conn->error; }
			}
		}
	} ?>

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

		<div class="tartalom container min-vh-100">
			<div class="container">

					<div class="row">
						<div class="col-12 col-sm-12 text-right">
							<p class="alert alert-link border-top border-bottom" >Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p>
						</div>
					</div>

			<?php

			$jellege_kivalasztas = "SELECT felhasznalok.id, felhasznalok.fnev, bejegyzesek.id, bejegyzesek.cime, bejegyzesek.tartalom, bejegyzesek.datum FROM bejegyzesek JOIN felhasznalok ON bejegyzesek.felhasznalo_id = felhasznalok.id WHERE jellege_id = '{$_SESSION['jellegenev_id']}' AND felhasznalok.id = bejegyzesek.felhasznalo_id";
												
			$kiiras_kivalasztas = "SELECT jellegenev FROM bejegyzesjellege WHERE id = '". $_SESSION['jellegenev_id'] ."'";

			$eredmeny_jellege_kivalasztas = $conn->query($jellege_kivalasztas);
			$eredmeny_kiiras_kivalasztas = $conn->query($kiiras_kivalasztas);

			$kiiras_sor = $eredmeny_kiiras_kivalasztas->fetch_assoc(); ?>

				<h3 class="mb-3"><?php echo($kiiras_sor['jellegenev']); ?> kategória</h3>
						
			<?php

			if ($eredmeny_jellege_kivalasztas->num_rows > 0) {
						
				while ($jellege_sor = $eredmeny_jellege_kivalasztas->fetch_assoc()) { ?>

					<div class="alapszoveg bejegyzesek container text-center border border-dark">
						<div class="row py-2">

							<div class="col-12 col-sm-12 col-md-6 col-lg-4 border-right border-dark">
								<p><u>Cím</u></p>
								<p class="hszoveg font-weight-bold"><?php echo $jellege_sor['cime'];?></p>
							</div>

							<div class="col-12 col-sm-12 col-md-6 col-lg-4 border-right border-dark">
								<p><u>Leírás</u></p>
								<p class="hszoveg font-weight-bold"> <?php echo $jellege_sor['tartalom'];?></p>
							</div>

							<div class="col-12 col-sm-12 col-md-6 col-lg-2 border-right border-dark">
								<p><u>Közzétéve</u></p>
								<p> <?php echo $jellege_sor['datum'];?></p>
							</div>

							<div class="col-12 col-sm-12 col-md-6 col-lg-2">
								<p><u>Közzétevő</u></p>
								<?php echo $jellege_sor['fnev'];?> </p>
							</div>
										
					<?php

					$komment_kiir = "SELECT hozzaszolas.hozzaszolas, hozzaszolas.datum, felhasznalok.fnev FROM hozzaszolas JOIN felhasznalok ON felhasznalok.id = hozzaszolas.felhasznalo_id WHERE bejegyzes_id = '{$jellege_sor["id"]}'";

					$komment_kiir_eredmeny = $conn->query($komment_kiir);
													
					if ($komment_kiir_eredmeny->num_rows > 0) {
														
						while ($kiiras_komment = $komment_kiir_eredmeny->fetch_assoc()) {?>
															
							<div class="container hozzaszolas text-left col-6 col-sm-6 col-md-8 col-lg-9 border-top border-dark border-right">
								<p style="text-decoration: underline; color: #E49030; font-weight: bold;"><?php echo $kiiras_komment['fnev'];?><br></p>
								<?php echo $kiiras_komment['hozzaszolas']; ?>	
							</div>

							<div class="container hozzaszolas text-left col-4 col-sm-4 col-md-4 col-lg-3 border-top border-dark">Közzététel ideje: <br><?php echo $kiiras_komment['datum']; ?>
							</div>

						<?php

						} 
					} else {echo "<i>Még nincsenek hozzászólások</i>";} ?>

						<div class="alert alert-link text-light"><?php echo($_SESSION['hiba']); ?></div>
													
						<div id="id" class="col-12 col-sm-12 col-md-12 col-lg-12">
							<button name="hozzaszolasgomb" type="submit" id="<?php echo 'show'.$jellege_sor['id']; ?>" class="btnuzenni my-2">Hozzászólok</button><br>
							<div class="row">

							<form method="POST">

								<textarea placeholder="Hozzászólás írása" rows="5" cols="50" id="<?php echo 'area'.$jellege_sor['id']; ?>" name="hozzaszolas" style="display: none;"></textarea><br>
								<button name="bekuldesgomb" value="<?php echo $jellege_sor['id']; ?>" type="submit" id="<?php echo 'button'.$jellege_sor['id']; ?>" style="display: none;">Beküldés</button>

							</form>

							</div>
						</div>
		
				<script type="text/javascript">
					
					$(document).ready(function(){
						var textarea = $('#<?php echo 'area'.$jellege_sor['id']; ?>');
						var button = $('#<?php echo 'button'.$jellege_sor['id']; ?>');

						$("#<?php echo 'show'.$jellege_sor['id'];?>").click(function(){
							textarea.show();
							button.show();
						});
					});

				</script>

				<?php

				} ?>

			<?php 
			} else {echo "Nincs egy bejegyzés sem ebben a kategóriában.";} ?>

			</div>
		</div>

		<?php

	} else {

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
		
<?php }

	$conn->close(); ?>

	<footer class="container lablec text-center p-3"  style=" height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>

</div>
</body>
</html>