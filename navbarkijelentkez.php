<nav class="container navbar navbar-expand-lg navbar-expand-md navbar-dark">
    	<a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
        	data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
       		aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
    </button>


	<div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($active == 'kezdooldal'){echo 'active'; } ?>">
				<a class="nav-link" href="kezdooldal.php">Főoldal</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link disabled" href="bejegyzesek.php">Bejegyzések</a>
			</li>

			<li class="nav-item <?php if($active == 'hirdetesek'){echo 'active'; } ?>">
				<a class="nav-link" href="hirdetesek.php">Hirdetések</a>
			</li>

			<li class="nav-item ">
				<a class="nav-link disabled" href="szabalyzat.php">Szabályzat</a>
			</li>
			<li class="nav-item <?php if($active == 'bejelentkezes'){echo 'active'; } ?>">
				<a class="nav-link" href="bejelentkezes.php">Bejelentkezés</a>
			</li>
		</ul>

		<ul class="navbar-nav text-small">
			<a class="nav-link text-success" href="regisztralas.php">Regisztráció</a>
		</ul>

	</div>

</nav>