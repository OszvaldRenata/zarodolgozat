<?php

	include("csatlakozas.php");
	session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Hírdetésfeladás</title>

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
		$_SESSION['hibabekuldes'] = '';
		$_SESSION['ar'] = '';
		$_SESSION['meret'] = '';
		$_SESSION['kiterjesztes'] = '';


		if (isset($_SESSION['id'])) {

			$felhaszn_id = $_SESSION['id'];
		}

	  	if(isset($_FILES['image'])){
	    	$errors= array();
	    	$file_name = $_FILES['image']['name'];
	    	$file_size =$_FILES['image']['size'];
	    	$file_tmp =$_FILES['image']['tmp_name'];
	    	$file_type=$_FILES['image']['type'];

	    	$tmp = explode('.',$_FILES['image']['name']);
			$file_ext = end($tmp);
		
	    	# var_dump(end(explode('.',$_FILES['image']['name'])));
	    	$extensions = array("jpeg","jpg","png");
	      
	    	if(in_array($file_ext,$extensions) === false){

	     		$_SESSION['kiterjesztes'] = "A fájl kiterjesztése nem megfelelő! Kérlek válassz JPG, vagy PNG fájlt.";

	    	}
	      
	    	if($file_size > 6097152){

	      		$_SESSION['meret'] = "Fálj mérete maximum 6MB lehet.";
	    	}
	      
	    	if(empty($errors) == true){

	        	move_uploaded_file($file_tmp,"images/".$file_name);

	    	}else { print_r($errors); }
		} ?>

		<?php

			$kitoltve = true;

			if (isset($_POST['tartalom'])) {

				if (empty($_POST['tartalom'])) {
					$_SESSION['leirasat'] = "Adj leírást a hirdetésnek.";

					$kitoltve = false;
				}

			}

			if (isset($_POST['cime'])) {
				if (empty($_POST['cime'])) {
					$_SESSION['cimet'] = "Adj címet a hirdetésnek.";

					$kitoltve = false;
				}
				
			}

			if (isset($_POST['termek_ara'])) {
				if (empty($_POST['termek_ara'])) {
					$_SESSION['ar'] = "Adj meg egy árat.";

					$kitoltve = false;
				}

			}
			

			if (isset($_POST['tartalom']) && $kitoltve && isset($_POST['cime']) && $kitoltve) {

				$sql_insert = "INSERT INTO hirdetesek (felhasznalo_id, image, cime, tartalom, marka_id, termek_ara, szine, allapot) 
				VALUES
				('$felhaszn_id',
				'$file_name',
				'" . $_POST['cime'] . "',
				'" . $_POST['tartalom'] . "',
				'" . $_POST['marka_id'] . "',
				'" . $_POST['termek_ara'] . "',
				'" . $_POST['szine'] . "',
				'" . $_POST['allapot'] . "')";


				if ($conn->query($sql_insert) === TRUE) {

					$_SESSION['bekuldve'] = "A hirdetést sikeresen feladtad!";
					$_SESSION['kiterjesztes'] = "";

				} else {

				    $_SESSION['hibabekuldes'] = "Hiba a hirdetés beküldése során." . $sql_insert . "<br>" . $conn->error;

					}
			}
		
			$conn->close(); ?>

			<?php 

		$active = 'hirdetesfeladas';
		include('navbar.php'); ?>


		<div class="tartalom container text-center">
			<div class="container">

				<div class="row">
					<div class="col-12 col-sm-12 text-right">
						 <p class="alert alert-link border-bottom" >Bejelentkezve: <?php echo($_SESSION['fnev']); ?></p>
					</div>
				</div>

				<div class="container">
					<div class="row">
						<div class="alapszoveg col-12 col-md-12 col-sm-12 col-lg-12 form-group">

							<h3>Hirdetésed létrehozása</h3>

							<p>* Hirdetésedben minél pontosabb leírást adsz, annál hamarabb elvihetik.</p>
						
							<p>* Ajánlott fotót csatolni a készülékről.</p>

						</div>  
					</div>
				</div>
					
				<form method="post" enctype="multipart/form-data">

					<div class="container col-12 col-sm-12 col-md-12 col-lg-12">
						
							<div class="container alert alert-link text-light">
								<div class="row"><?php echo($_SESSION['cimet']); ?></div>
								<div class="row"><?php echo($_SESSION['leirasat']); ?></div>
								<div class="row"><?php echo($_SESSION['ar']); ?></div>
								<div class="row"><?php echo($_SESSION['hibabekuldes']); ?></div>
								<div class="row"><?php echo($_SESSION['meret']); ?></div>
								<div class="row"><?php echo($_SESSION['kiterjesztes']); ?></div>
							</div>

							<div class="container alert alert-link text-light">
								<div class="row"><?php echo($_SESSION['bekuldve']); ?></div>		
							</div>
					
					</div>
			
							<div class="alapszoveg container col-12 col-sm-12 col-md-12">
								<p class="font-weight-bold">Kép feltöltése: maximum 6Mb lehet.</p>
								<div class="row offset-4 col-4 text-center">
									<input style="box-shadow: none;" type="file" name="image"/>
								</div>
							</div>


					<div class="alapszoveg container col-10 col-md-10 col-sm-10 col-lg-10 py-3">
						<div class="container">

							<p class="font-weight-bold">Ismertesd röviden a hirdetést:</p>
								<textarea class="form-control" type="text" cols="10" rows="1" name="cime" minlength="10" maxlength="50" wrap="hard"></textarea><br/>
							
							 <p class="font-weight-bold">Hirdetés tartalma:</p> 
								<textarea class="form-control" name="tartalom"  rows="10" cols="50" minlength="50" maxlength="250" placeholder="Termék technikai adatai, mért adod el, mennyi idős, garancia van-e rá, stb."></textarea><br/><br>
						</div>
					</div>
					
					<div class="alapszoveg container col-5 col-sm-4 col-md-3 col-lg-3">
						<div class="row">
							<p class=" text-center font-weight-bold">Ár:</p>
							<textarea class="form-control" type="number" cols="2" rows="1" placeholder="Ft" name="termek_ara" minlength="1" wrap="hard"></textarea>
						</div>
					</div>
						
					<div class="alapszoveg container col-5 col-sm-4 col-md-3 col-lg-3">
						<div class="row">

							<label class="my-2 font-weight-bold" for="marka_id">Márka:</label>

						</div>

						<div class="row">

							<select name="marka_id" id="marka">
								<option value="1">Samsung</option>
								<option value="2">Iphone</option>
								<option value="3">Huawei</option>
								<option value="4">Honor</option>
								<option value="5">Xiaomi</option>
								<option value="6">Nokia</option>
								<option value="7">OnePlus</option>
								<option value="8">Egyéb</option>
							</select>

						</div>
						
						<div class="alapszoveg row">

							<label class="my-2 font-weight-bold" for="allapota">Állapot:</label>

						</div>

						<div class="row">

							<select name="allapot" id="allapot">
								<option value="Újszerű">Újszerű</option>
								<option value="Használt">Használt</option>
								<option value="Megkímélt">Megkímélt</option>
							</select>

						</div>

						<div class="alapszoveg row">

							<label class="my-2 font-weight-bold" for="szine">Szín:</label>

						</div>

						<div class="row">
							<select name="szine" id="szin">
								<option value="Fekete">Fekete</option>
								<option value="Fehér">Fehér</option>
								<option value="Szürke">Szürke</option>
								<option value="Piros">Piros</option>
								<option value="Kék">Kék</option>
								<option value="Zöld">Zöld</option>
								<option value="Egyéb">Egyéb</option>
							</select>
						</div>	
					</div>
							
						<div class="row">
							<div class="container col-5 text-center form-group">
								<input class="my-4 btn btn-success form-group form-control" type="submit" value="Hirdetés beküldése">
							</div>	
						</div>

				</form>
			</div>
		</div>
	<?php 
	} else { ?>

		<?php 

		$active = 'hirdetesfeladas';
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
	} ?>

	<footer class="container lablec text-center p-3"  style="height: 60px; font-size: 15px;">
		@ 2020 Oszvald Renáta
	</footer>	

</div>
</body>
</html>