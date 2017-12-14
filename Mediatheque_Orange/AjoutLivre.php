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
			<form method = "post" action = "AjoutLivre.php">
					<input type="text" name="Titre_livre" placeholder="Entrer le titre (et sous titre si existant)" size="30" class="champs"/>
					</br>
						<input type="text" name="DatePublication_livre" placeholder="Entrer la date de publication" size="30" class="champs"/>
					</br>
						<input type="text" name="Genre_livre" placeholder="Entrer le genre (ex:Fantasy)" size="30" class="champs"/>
					</br>
						<input type="text" name="Type_livre" placeholder="Entrer le style ici (ex:roman, nouvelle)" size="30" class="champs"/>
					</br>
						<input type="text" name="Id__auteur" placeholder="Entrer l'Id de l'auteur" size="30" class="champs"/>
					</br>
						<input type="text" name="Id_exemplaire" placeholder="Entrer l'id exemplaire " size="30" class="champs"/>
					</br>
						<input type="text" name="Id_éditeur" placeholder="Entrer l'id de l'éditeur" size="30" class="champs"/>
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
			$req = $bdd->prepare('INSERT INTO livre(Nom_auteur, Prenom_auteur ) VALUES( ? , ?)');
			$req->execute(array($_POST['Nom_livre'],$_POST['Nom_livre'],$_POST['Nom_livre'],$_POST['Nom_livre'],$_POST['Nom_livre'],$_POST['Id_auteur'],$_POST['Id_exemplaire'],$_POST['Id_éditeur']));
			$req->closeCursor();
			echo "Le livre ".$_POST['Titre_livre']. ' De ' . $_POST['Id_auteur'] . ', a bien était ajouté a la base de donnée ;
		
		}else {
		
			echo 'Veulliez rentrez les caractéristiques du livre;
		}
		
	?>
				
		</center>
	
	</body>
	
</html>