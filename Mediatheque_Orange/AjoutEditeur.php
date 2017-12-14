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
			<form method = "post" action = "AjoutEditeur.php">
					<input type="text" name="nom_editeur" placeholder="nom éditeur" size="10" class="champs"/>
					</br>

					<input type="text" name="adresse_editeur" placeholder="adresse editeur" size="10" class="champs"/>
					</br>

					<input type="submit" name="valider" size="20"  value="Valider" class="champs"/>	

			</form>
		</div>
		
	<?php
		
		// On vérifie que le nom et le adresse de l'editeur qu'on veut ajouter a la B.D. a bien était écrit
		if (isset($_POST['nom_editeur']) &&  !empty($_POST['nom_editeur']) && isset($_POST['adresse_editeur']) &&  !empty($_POST['adresse_editeur'])) {
		
		
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
			// requete pour inserer un editeur avec les caractéristiques du Post 
			$req = $bdd->prepare('INSERT INTO editeur(nom_editeur, adresse_editeur ) VALUES( ? , ?)');
			$req->execute(array($_POST['nom_editeur'],$_POST['adresse_editeur']
				
				));
			$req->closeCursor();
			echo "L'editeur ".$_POST['nom_editeur']. " résidant à " . $_POST['adresse_editeur'] . ', a bien était ajouté a la base de donnée.' ;
		
		}else {
		
			echo 'Veulliez rentrez le nom et le adresse de l\'editeur';
		}
		
	?>
				
		</center>
	
	</body>
	
</html>
 