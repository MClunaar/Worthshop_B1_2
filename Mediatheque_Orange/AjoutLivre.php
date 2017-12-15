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
					<input type="text" name="Titre_livre" placeholder="Entrer le titre (et sous titre si existant)" size="40" class="champs"/>
					</br>
						<input type="text" name="DatePublication_livre" placeholder="date: ex 1998-07-12" size="40" class="champs"/>
					</br>
						<input type="text" name="genre_livre" placeholder="Entrer le genre (ex:Fantasy)" size="40" class="champs"/>
					</br>
						<input type="text" name="type_livre" placeholder="Entrer le style ici (ex:roman, nouvelle)" size="40" class="champs"/>
					</br>
						<input type="text" name="Id_auteur" placeholder="Entrer l'Id de l'auteur" size="40" class="champs"/>
					</br>
						<input type="text" name="Id_exemplaire" placeholder="Entrer l'Id de l'exemplaire" size="40" class="champs"/>
					</br>
						<input type="text" name="Id_editeur" placeholder="Entrer l'id de l'éditeur" size="40" class="champs"/>
					</br>
					<input type="submit" name="valider" size="20"  value="Valider" class="champs"/>	
			</form>
		</div>
		
		
		
	<?php
		
		if  (isset($_POST['Titre_livre']) &&  !empty($_POST['Titre_livre']) && isset($_POST['DatePublication_livre']) &&  !empty($_POST['DatePublication_livre'])
			&& isset($_POST['genre_livre']) &&  !empty($_POST['genre_livre']) && isset($_POST['type_livre']) &&  !empty($_POST['type_livre']))
		{
			try {
				// On se connecte à MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '',
				array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); // Fait en sorte d'afficher les erreurs due au SQL
				}
				
			catch(Exception $e)
				{
					// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
				}
				
			// requete pour inserer un livre avec les caractéristiques du Post 
			$reql = $bdd->prepare('INSERT INTO livre( Titre_livre , DatePublication_livre , genre_livre , type_livre , Id_auteur , Id_exemplaire , Id_editeur ) VALUES( ? , ? , ? , ? , ? , ? , ? )');
			$reql->execute(array($_POST['Titre_livre'],$_POST['DatePublication_livre'],$_POST['genre_livre'],$_POST['type_livre'],$_POST['Id_auteur'],$_POST['Id_exemplaire'],$_POST['Id_editeur']));
			$reql->closeCursor();
			echo "Le livre ".$_POST['Titre_livre']. ' De ' . $_POST['Id_auteur'] . ', a bien était ajouté a la base de donnée ';	
		}else {
			echo "Entrez un livre ";
		}
	?>	
	
		</center>
	</body>
</html>