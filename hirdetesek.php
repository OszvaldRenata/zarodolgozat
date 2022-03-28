<?php

	include("csatlakozas.php");
	session_start(); ?>

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

		include('fejlec.php'); ?>
	
	<?php

	if (isset($_SESSION['bejelentkezve'])) {

		$active = 'hirdetesek';
		include('navbar.php'); ?>


		<div class="tartalom container">
			<div class="container min-vh-100">

				<div class="row">
					<div class="col-12 col-sm-12 text-right">
						<p class="alert alert-link border-top border-bottom" >Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p>
					</div>
				</div>

				<div class="alapszoveg row col-12 py-2">
					<h5 style="text-align: center;">Milyen készüléket keresel?</h5>
				</div>

				<?php

				$kategoria_kivalasztas = "SELECT id, markanev FROM telefonmarkak";
				$kategoria_eredmeny = $conn->query($kategoria_kivalasztas); ?>

				<div class="container">
					<div class="row">
						<table class="container col-12">
							<tr>
							<td>

				  				<?php  

								while ($sor = $kategoria_eredmeny->fetch_assoc()) { ?>

					
									<form class="text-center" method="post" action="kategoriak.php">
													
										<button class="katgomb col-5" type="submit">
											<p><?php echo $sor['markanev']; ?> </p>	
										</button>
										<input value="<?php echo $sor['id']; ?>" type="hidden" name="id">

									</form>
						
								<?php   
								} ?>
					
							</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

					
		<?php

	}	else {

			$active = 'hirdetesek';
			include('navbarkijelentkez.php'); ?>

			<div class="tartalom container">
				<div class="container min-vh-100">

					<div class="row">
						<div class="col-12 col-sm-12 text-right">
							<p class="alert alert-link border-top border-bottom" >Nincs bejelentkezve</p>
						</div>
					</div>

					<div class="alapszoveg row col-12 py-2">
						<h5 style="text-align: center;">Milyen készüléket keresel?</h5>
					</div>

				<?php

				$kategoria_kivalasztas = "SELECT id, markanev FROM telefonmarkak";
				$kategoria_eredmeny = $conn->query($kategoria_kivalasztas);?>

				<div class="container">
				  	<div class="row">
						<table class="container col-12">
							<tr>
							<td>

							  	<?php  

								while ($sor = $kategoria_eredmeny->fetch_assoc()) { ?>

									<form class="text-center" method="post" action="kategoriak.php">
														
										<button class="katgomb col-5" type="submit">
											<p><?php echo $sor['markanev']; ?> </p>	
										</button>		
										<input value="<?php echo $sor['id']; ?>" type="hidden" name="id">
													
									</form>
								<?php  
								} ?>
					
							</td>
							</tr>
						</table>
					</div>
				</div>
				</div>
			</div>

			<?php

			$conn->close();
 
		} ?>

	<footer class="container lablec text-center p-3"  style="height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>

</div>
</body>
</html>