<html>
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
		<center>
		<div class="form_connexion">		
			<form method = "post" action = "Ajout.php">
					<input type="text" name="Nom_auteur" placeholder="Nom auteur" size="10" class="champs"/>
					</br>

					<input type="text" name="Prenom_auteur" placeholder="Prenom auteur" size="10" class="champs"/>
					</br>

					<input type="submit" name="valider" size="20"  value="Valider" class="champs"/>	

			</form>
		</div>
		
	<?php
		
		// On vérifie que le nom et le prenom de l'auteur qu'on veut ajouter a la B.D. a bien était écrit
		if (isset($_POST['Nom_auteur']) &&  !empty($_POST['Nom_auteur']) && isset($_POST['Prenom_auteur']) &&  !empty($_POST['Prenom_auteur'])) {
		
		
			try
				{
					// On se connecte à MySQL
					$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '');
				}
				catch(Exception $e)
				{
					// En cas d'erreur, on affiche un message et on arrête tout
						die('Erreur : '.$e->getMessage());
				}
			// requete pour inserer un auteur avec les caractéristiques du Post 
			$req = $bdd->prepare('INSERT INTO auteur(Nom_auteur, Prenom_auteur ) VALUES( ? , ?)');
			$req->execute(array($_POST['Nom_auteur'],$_POST['Prenom_auteur']
				
				));
			$req->closeCursor();
			echo "L'auteur ".$_POST['Nom_auteur']. ' ' . $_POST['Prenom_auteur'] . 'A bien était ajouté a la base de donnée' ;
		
		}else {
		
			echo 'Veulliez rentrez le nom et le prenom de l\'auteur';
		}
		
	?>
				
		</center>
	
	</body>
	
</html>
 