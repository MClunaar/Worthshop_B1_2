<html>
<?php
	session_start()
?>
	<head>
		<link href="site_orange.css" rel="stylesheet">
	</head>
	
	<body>
		<div class="banner">
			<div class="bannercontent">
				<div class="titre">
					<a class="titlebutton" href="site_orange.php">Médiathèque d'orange </a>
				</div>				
			</div>
		
			
		</div>
	
		<div>		
			<form method = "post" action = "site_orange.php" class="connexion">
				<p>
					<input type="text" name="identifiant" placeholder="Identifiant" size="10"  class="identification"/>
				</p>		
				<p>
					<input type="password" name="password" placeholder="Mot de passe" size="10" class="identification"/>
				</p>
				<p>
					<input type="submit" name="valider" size="10"  value="Connexion" />	
				</p>
			</form>
		</div>
		<?php
			if (isset($_post['identifiant'])) {
				$_SESSION['identifiant'] = $_POST['identifiant'];
				$_SESSION['name'] = $_POST['identifiant'];
			}
		?>
				
	
	</body>
	
</html>