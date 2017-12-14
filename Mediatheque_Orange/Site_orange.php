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
					?>
					
					<div class="deconnexion">
							<?php echo "Bonjour, </br>".$_SESSION['identifiant'];?>
							<form action="deconnexion.php" method="post">
							<input type="submit" value="Déconnexion"/>
							</form>
							</div>
					<p class="identificationlink">
					<a class="button" href="AjoutAuteur.php"> Ajouter</br> un Auteur </a>
					<a class="button" href="deroulant.php">menu</br>deroulant </a>
					<a class="button" href="AjoutEditeur.php">Ajouter</br>un Editeur </a>
					<a class="button" href="AjoutLivre.php">Ajouter</br>un Livre </a>
					<?php		
						}		
						else if (isset ($_POST['identifiant'])) {
					?>
					
							<div class="deconnexion">
							<?php echo "Bonjour, </br>".$_SESSION['identifiant'];?>
							<form action="deconnexion.php" method="post">
							<input type="submit" value="Déconnexion"/>
							</form>
							</div>
					
					<?php		
							$_SESSION['identifiant'] = $_POST['identifiant'];
							$_SESSION['name'] = $_POST['identifiant'];
							
						}
						else {
					?>
					
							<p class="identificationlink">
							<a class="button" href="site_orange_admin.php"> Identification </br>Administrateur </a>
							</p>
					
					<?php
						}
					?>
				
			</div>		
			
		</div>
</br>
</br>
		<center>
<?php
if (isset ($_POST['Prenom_auteur'])) {	
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '');// On se connecte à MySQL
		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
				die('Erreur : '.$e->getMessage());
		}


		// On récupère tout le contenu de la table jeux_video ou le posseseur est égal a la recherche du $_POST )
		$req = $bdd->prepare("SELECT * FROM auteur WHERE Prenom_auteur like ? ");// le prepare signifie que la requete est préparé et qu'on va envoyer la donnée a la place du ? avec l'execute qui suit
		$req->execute(array('%'.$_POST['Prenom_auteur'].'%'));
			
			echo '<ul>';
			
		$a = 1;
		// On affiche chaque entrée une à une
		while ($donnees = $req->fetch())
		{
		?>
			<p>
			<li><strong>Resultat <?php echo $a; ?></strong> : 
			
			<br />
			
			<?php echo 'Nom de l\'auteur  ' . $donnees['Nom_auteur']; ?>
			
			<br />
			
			<?php echo  'Prenom de l\'auteur  ' . $donnees['Prenom_auteur']; ?>
			
			<br />
			<br />
			
			</p>
		 
		<?php
		$a++; }
		$req->closeCursor(); // Termine le traitement de la requête

}	
else{
	echo "Quel auteur voulez vous recherchez ? ";

	}
	?>
</br>				
</br>		
	<form method = "post" action = "Site_orange.php">
				
		<input type="text" name="Prenom_auteur" placeholder="Prenom de l'auteur" size="30" class="champs"/>
		</br>
		</br>
		<input type="submit" name="valider" size="20"  value="RECHERCHER" class="champs"/>	
		<br />
		<br />
	</center>
	</form>
	</body>
	
	
</html>