<?php

	include("csatlakozas.php");
	session_start(); 

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$_SESSION['markanev_id'] = $_POST['id'];
	} ?>


<!DOCTYPE html>
<html>
<head>
<title>Hirdetések</title>
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

		$active = 'hirdetesek';
		include('navbar.php'); ?>


		<div class="tartalom container min-vh-100">
			<div class="container">

				<div class="row">
					<div class="col-12 col-sm-12 text-right">
						<p class="alert alert-link border-top border-bottom" >Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p>
					</div>
				</div>

		<?php

			$marka_kivalasztas = "SELECT felhasznalok.id, felhasznalok.fnev, hirdetesek.id, hirdetesek.image, hirdetesek.cime, hirdetesek.datum, hirdetesek.allapot,hirdetesek.szine, hirdetesek.termek_ara, hirdetesek.tartalom FROM hirdetesek JOIN felhasznalok ON hirdetesek.felhasznalo_id = felhasznalok.id WHERE marka_id = '{$_SESSION['markanev_id']}' AND felhasznalok.id = hirdetesek.felhasznalo_id";

			$kiiras_kivalasztas = "SELECT markanev FROM telefonmarkak WHERE id = '". $_SESSION['markanev_id'] ."'";
										
			$eredmeny_marka_kivalasztas = $conn->query($marka_kivalasztas);

			$eredmeny_kiiras_kivalasztas = $conn->query($kiiras_kivalasztas);


			$kiiras_sor = $eredmeny_kiiras_kivalasztas->fetch_assoc(); ?>

				<h3 class="mb-3"><?php echo $kiiras_sor['markanev']; ?> készülékek</h3>

		<?php

			if ($eredmeny_marka_kivalasztas->num_rows > 0) {

				while ($marka_sor = $eredmeny_marka_kivalasztas->fetch_assoc()) { ?>

					<div class="hirdetesek container col-12 text-center border border-dark">
						<div class="row py-2">

							<div class="col-12 col-sm-12 col-dm-12 col-lg-4 mt-2 border-right border-dark">

								<div class="hszoveg alapszoveg text-center">
									<p><?php echo $marka_sor['cime'];?><br> </p>
								</div>

								<div>
									<p><img onclick="image(this)" style="height: 180px; width: 180px" src="<?php echo 'images/' . $marka_sor['image']; ?>"></p>
								</div>	

				  			</div>

							<div class="alapszoveg col-12 col-lg-4 col-md-6 col-sm-12 border-right border-dark">

								<p><u>Leírás</u></p>
								<p class="hszoveg"> <?php echo $marka_sor['tartalom'];?><br> </p>
								<p><u>Ár</u></p>
								<p><?php echo number_format($marka_sor['termek_ara'],0,",",".") ?>Ft</p>

							</div>

							<div class="alapszoveg col-12 col-lg-2 col-md-6 col-sm-12 border-right border-dark">

								<p><u>Állapot</u></p>
								<p><?php echo $marka_sor['allapot'];?><br> </p>
								<p><u>Szín</u></p>
								<p><?php echo $marka_sor['szine'];?></p>

							</div>

							<div class="alapszoveg col-12 col-lg-2 col-md-12 col-sm-12 text-center">

								<p><u>Közzétéve</u></p>
								<p><?php echo $marka_sor['datum'];?><br> </p>

								<div>
									<p><u>Közzétevő</u></p>
									<p><?php echo $marka_sor['fnev'];  ?><br> </p>
								</div>

								<div>
									<button class="btnuzenni"><img src="images/email.png" title="Üzenet küldése"> </button>
								</div>

							</div>
						</div>
					</div>

				<script type="text/javascript">

					function image(img) {
				   		var src = img.src;
				    	window.open(src);
					}

				</script>

				<?php
				}

			} else {echo "Nincs egy hirdetés sem ebben a kategóriában.";} ?>
					
			</div>
		</div>

		<?php

	} else {

			$active = 'hirdetesek';
			include('navbarkijelentkez.php'); ?>


			<div class="tartalom container min-vh-100">
				<div class="container">

					<div class="row">
						<div class="col-12 col-sm-12 text-right">
							<p class="alert alert-link border-top border-bottom" >Nincs bejelentkezve</p>
						</div>
					</div>

				<script>

					function uzenetKuldes() {
				  		alert("Ahhoz hogy üzenni tudj, be kell jelentkezz!");
					}

				</script>

				<?php

				$marka_kivalasztas = "SELECT felhasznalok.id, felhasznalok.fnev, hirdetesek.id, hirdetesek.image, hirdetesek.cime, hirdetesek.datum, hirdetesek.allapot,hirdetesek.szine, hirdetesek.termek_ara, hirdetesek.tartalom FROM hirdetesek JOIN felhasznalok ON hirdetesek.felhasznalo_id = felhasznalok.id WHERE marka_id = '{$_SESSION['markanev_id']}' AND felhasznalok.id = hirdetesek.felhasznalo_id";

				$kiiras_kivalasztas = "SELECT markanev FROM telefonmarkak WHERE id = '". $_SESSION['markanev_id'] ."'";

											
				$eredmeny_marka_kivalasztas = $conn->query($marka_kivalasztas);
				$eredmeny_kiiras_kivalasztas = $conn->query($kiiras_kivalasztas);

				$kiiras_sor = $eredmeny_kiiras_kivalasztas->fetch_assoc(); ?>

					<h3 class="mb-3"><?php echo $kiiras_sor['markanev']; ?> készülékek</h3>
				<?php

				if ($eredmeny_marka_kivalasztas->num_rows > 0) {

					while ($marka_sor = $eredmeny_marka_kivalasztas->fetch_assoc()) { ?>

						<div class="hirdetesek container col-12 text-center border border-dark">
							<div class="row py-2">

								<div class="col-12 col-sm-12 col-dm-12 col-lg-4 mt-2 border-right border-dark">

									<div class="text-center">
										<p class="hszoveg font-weight-bold"> <?php echo $marka_sor['cime'];?><br> </p>
									</div>

									<div>
										<p><img onclick="image(this)" style="height: 180px; width: 180px" src="<?php echo 'images/' . $marka_sor['image']; ?>"></p>
									</div>	

					  			</div>

								<div class="col-12 col-lg-4 col-md-6 col-sm-12 border-right border-dark">

									<p><u>Leírás</u></p>
									<p class="hszoveg"><?php echo $marka_sor['tartalom'];?><br></p>
									<p><u>Ár:</u></p>
									<p><?php echo number_format($marka_sor['termek_ara'],0,",",".") ?>Ft</p>

								</div>

								<div class="col-12 col-lg-2 col-md-6 col-sm-12 border-right border-dark">

									<p><u>Állapot</u></p>
									<p><?php echo $marka_sor['allapot'];?><br> </p>
									<p><u>Szín</u></p>
									<p><?php echo $marka_sor['szine'];?></p>

								</div>

								<div class="col-12 col-lg-2 col-md-12 col-sm-12 text-center">

									<p><u>Közzétéve</u></p>
										<p><?php echo $marka_sor['datum'];?><br> </p>

									<div>
										<p><u>Közzétevő</u></p>
										<p><?php echo $marka_sor['fnev'];  ?><br> </p>
									</div>

									<div>
										<button onclick="uzenetKuldes()" class="btnuzenni"><img src="images/email.png" title="Üzenet küldése"> </button>
									</div>
								</div>
							</div>
						</div>
						
					<script type="text/javascript">

						function image(img) {
					   		var src = img.src;
					    	window.open(src);
						}

					</script>
					<?php
					}

				} else {echo "Nincs egy hirdetés sem ebben a kategóriában.";} ?>
			
				</div>
			</div>
		
		<?php
		}

	$conn->close(); ?>

	<footer class="container lablec text-center p-3"  style="height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>

</div>
</body>
</html>