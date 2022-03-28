<?php

  include("csatlakozas.php");
  session_start();?>

<!DOCTYPE html>
<html>
<head>
<title>Regisztráció</title>

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

    $_SESSION['sikeres'] = '';
    $_SESSION['sikertelen'] = '';
    $_SESSION['jelszo_egyezes'] = '';
    $_SESSION['letezoemail'] = '';
    $_SESSION['letezofnev'] = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //ha a form post-ot küld el, akkor történik meg a feltétel.
     
      $felhnev = $_POST['fnev'];
      $email = $_POST['email'];
      $jelszo = md5($_POST['jelszo']);
      $jelszo2 = md5($_POST['jelszo2']);

      $letezo_fnev = "SELECT * FROM felhasznalok WHERE fnev = '$felhnev'";

      $letezo_fnev_eredmeny = $conn->query($letezo_fnev);

        if ($letezo_fnev_eredmeny->num_rows == 0) {

          $letezo_email = "SELECT * FROM felhasznalok WHERE email = '$email'";

          $letezo_email_eredmeny = $conn->query($letezo_email);

            if ($letezo_email_eredmeny->num_rows == 0) {
              
              if ($jelszo == $jelszo2) {
                
                $felhaszn_felvetele = "INSERT INTO felhasznalok (fnev, jelszo, email) 
                                       VALUES ('$felhnev', '$jelszo', '$email')";

                if ($conn->query($felhaszn_felvetele)) {

                  $_SESSION['sikeres'] = "Sikeres regisztráció!";

                  $letezo_felhaszn_id = "SELECT id FROM felhasznalok WHERE email = '$email' AND jelszo = '$jelszo'";

                  $letezo_felhaszn_id_eredmeny = $conn->query($letezo_felhaszn_id);

                    if ($letezo_felhaszn_id_eredmeny->num_rows == 1) {
                      
                      $sor = $letezo_felhaszn_id_eredmeny->fetch_assoc();

                      $_SESSION['felhasznalo_id'] = $sor['id'];
                    }
                } else { $_SESSION['sikertelen'] = "Sikertelen regisztráció! " . $conn->error; }

              } else { $_SESSION['jelszo_egyezes'] = "A jelszavak nem egyeznek!";}

            }else { $_SESSION['letezoemail'] = "Létező email cím!";}

        }else {$_SESSION['letezofnev'] = "Létező felhasználónév, kérlek válassz másikat!";}
    } ?>

<?php

  include('fejlec.php'); ?>
 
<?php

  $active = 'regisztralas';
  include('navbarkijelentkez.php'); ?>


<div class="tartalom container">
    <div class="container">

        <div class="row">
          <div class="col-12 col-sm-12 text-right">
            <p class="alert alert-link border-top border-bottom" >Nincs bejelentkezve</p>
          </div>
        </div>

        <div class="min-vh-100">
            <div class="container col-12 text-center">

              <div class="container">
                <h2>Regisztráció</h2>
                <p class="alapszoveg">Kérlek a regisztráláshoz tölts ki minden mezőt.</p>
                <hr>
              </div>

              <form method="post" action="#" class="was-validated">

                <div class="alert alert-link text-success">
                  <?php echo($_SESSION['sikeres']); ?>
                  <p class="text-light">
                  <?php echo($_SESSION['letezofnev']); ?> 
                  <?php echo($_SESSION['letezoemail']); ?> 
                  <?php echo($_SESSION['jelszo_egyezes']);?>
                  <?php echo($_SESSION['sikertelen']); ?>
                  </p>
                </div>

                <div class="container col-12">
                  <div class="regfelulet container text-left">
                    <div>
                    <input class="my-2 form-control" type="text" name="fnev" placeholder="Felhasználónév" minlength="5" maxlength="12" required>
                    <div class="text-light valid-feedback">Megfelelő</div>
                    <div class="text-light invalid-feedback">A felhasználónév túl rövid</div>
                    </div>
                    <div>
                    <input class="my-2 form-control" type="email" name="email" placeholder="Email cím" required>
                    <div class="text-light valid-feedback">Megfelelő</div>
                    <div class="text-light invalid-feedback">Helytelen e-mail cím</div>
                    </div>
                    <div>
                    <input class="my-2 form-control" type="password" name="jelszo" placeholder="Jelszó" minlength="6" maxlength="30" required>
                    <div class="text-light valid-feedback">Megfelelő</div>
                    <div class="text-light invalid-feedback">A jelszó túl rövid</div>
                    </div>
                    <div>
                    <input class="form-control" type="password" name="jelszo2" placeholder="Jelszó ismét" minlength="6" maxlength="30" required>
                    <div class="text-light valid-feedback">Megfelelő</div>
                    <div class="text-light invalid-feedback">A jelszó túl rövid</div>
                    </div>

                  </div>
                  <div class="form-group py-3">  
                    <button type="submit" class="registerbtn mb-3 btn btn-outline-warning" name="login_user">Regisztrálás
                    </button><br>
                  </div>  
                </div>

                <div class="alapszoveg container">
                  <p>Van már fiókod? <a href="bejelentkezes.php">Lépj be itt!</a>.</p>
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