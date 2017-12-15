<html>

<head>
	<link href="css_orange.css" rel="stylesheet">
	
	<?php
	if (isset ($_SESSION['identifiant'])) {							
	?>

	<meta http-equiv="refresh" content="0; URL=site_orange.php">
	
	<?php 
	} 
	?>
</head>
	
<body>
	<div class="banner">
		<div class="bannercontent">
		
			<div class="titre">
				<a class="titlebutton" href="site_orange.php">Médiathèque d'orange </a>
			</div>
			
			
			<p class="navigbuttons">
				<a class="button" href="site_orange.php"> Acceuil </a>
			</p>
		
		</div>		
	</div>
	
	<center>
		<div class="form_connexion">		
			<form method = "post" action = "site_orange.php">
					<input type="text" name="identifiant" placeholder="Identifiant" size="10" class="champs"/>
					</br>

					<input type="password" name="password" placeholder="Mot de passe" size="10" class="champs"/>
					</br>
					</br>
					<input type="submit" name="valider" size="25"  value="Connexion " class="champs"/>	

			</form>
		</div>
	</center>
	
</body>
	
</html>