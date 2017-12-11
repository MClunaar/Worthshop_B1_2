<html>
<?php
	session_start();
?>
	<head>
		<link href="site_orange.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	</head>
	
	<body>
		<div class="banner">
			<div class="bannercontent">
				<div class="titre">
					<a class="titlebutton" href="site_orange.php">Médiathèque d'orange </a>
				</div>
				<?php
					if (isset ($_SESSION['identifiant'])) {
						echo "Bonjour,".$_SESSION['name'];
					} else {
						echo "<p class=\"identificationlink\">"	;
						echo "<a class=\"button\" href=\"site_orange_admin.php\"> Identification </br>Administrateur </a>";
						echo "</p>";
					}
				?>
			</div>
			
			
		</div>
	
	
	</body>
	
</html>