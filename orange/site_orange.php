<html>

	<head>
		<link href="site_orange.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
		
		<?php 
			session_start()
		?>
		
	</head>
	
	<body>
		<div class="banner">
			<div class="bannercontent">
				<div class="titre">
					<a class="titlebutton" href="site_orange.php">Médiathèque d'orange </a>
				</div>
					<?php
						if (isset ($_SESSION['identifiant'])) {
							echo "<div class=\"deconnexion\">";
							echo "Bonjour, </br>".$_SESSION['identifiant'];
							echo "<form action=\"deconnexion.php\" method=\"post\">";
							echo "<input type=\"submit\" value=\"Déconnexion\"/>";
							echo "</form>";
							echo "</div>";
						}		
						else if (isset ($_POST['identifiant'])) {
							echo "<div class=\"deconnexion\">";
							echo "Bonjour, </br>".$_POST['identifiant'];
							echo "<form action=\"deconnexion.php\" method=\"post\">";
							echo "<input type=\"submit\" value=\"Déconnexion\"/>";
							echo "</form>";
							echo "</div>";
							$_SESSION['identifiant'] = $_POST['identifiant'];
							$_SESSION['name'] = $_POST['identifiant'];
						}
						else {
							echo "<p class=\"identificationlink\">"	;
							echo "<a class=\"button\" href=\"site_orange_admin.php\"> Identification </br>Administrateur </a>";
							echo "</p>";
						}
					?>					
			</div>
			
			
		</div>
	
	
	</body>
	
</html>