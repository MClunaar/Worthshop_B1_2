<html>

<head>
	<link href="css_orange.css" rel="stylesheet">
	<?php 
	session_start()
	?>
	
	<?php
	if (!isset ($_SESSION['identifiant'])) {							
	?>

	<meta http-equiv="refresh" content="0; URL=site_orange.php">
	
	<?php 
	} 
	?>
</head>

<!-- =========================================== BANNIERE ========================================================= -->

<body>

	<div class="banner">
		<div class="bannercontent">
		
			<div class="titre">
				<a class="titlebutton" href="site_orange.php">Médiathèque d'orange </a>
			</div>
		
			<?php
			if (isset ($_SESSION['identifiant'])) {							
			?>
			
				<div class="connecte">
					<?php
					echo "Connecté en tant que ".$_SESSION['identifiant'];
					?>
				</div>
				
				<p class="navigbuttons">
					<a class="button" href="site_orange.php" style="margin-right:3%"> Acceuil </a>
					<a class="button" href="ajout.php"> Ajouts </a>
					<a class="button" href="modif.php"> Modifications </a>
					<a class="currentbutton" href="suppr.php"> Suppressions </a>
					<a class="button" href="deconnexion.php" style="margin-left:3%"> Deconnexion </a>
				</p>
			
			<?php 
			} else {
			?>
				<p class="navigbuttons">
				<a class="connectbutton" href="site_orange_admin.php"> Identification </br> Administrateur </a>
				</p>
					
			<?php
			}
			?>
		
		</div>		
	</div>
	
<!-- =========================================== BOUTONS DE NAVIGATION ========================================================= -->
	
	<center style="padding-top:5%">
	
		<?php
		if (!isset ($_GET['type'])) {							
		?>
		
		
		<p class="navigbuttonstype">
			</br> Que souhaitez-vous supprimmer? </br>
			<a class="typebutton" href="suppr.php?type=auteur"> Auteur </a>
			<a class="typebutton" href="suppr.php?type=editeur"> Editeur</a>
		</p>
		
		
		<?php 
		} 
		?>

<!-- ====================================================== SUPPRESSION D'AUTEUR ========================================================= -->
		
		<?php
		if (isset($_GET['type'])) {
		
			if ($_GET['type']=='auteur') {
		?>
		
		<div class="form_connexion">		
			<form method = "post" action = "suppr.php?type=<?php echo $_GET['type']?>">
				<input type="text" name="Nom_auteur_cible" placeholder="Nom auteur" size="10" class="champs"/>
				</br>
				</br>
				<input type="submit" name="valider" size="20"  value="Valider " class="champs"/>
			</form>
		</div>
		
		<?php
		// On vérifie que le nom et le prenom de l'auteur qu'on veut supprimer la B.D. a bien était écrit
		if (isset($_POST['Nom_auteur_cible']) &&  !empty($_POST['Nom_auteur_cible']) ) {
		
			try {
					// On se connecte à MySQL
					$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '',
					array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
				}
			catch(Exception $e){
					// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
				}
				
			// requete pour inserer un auteur avec les caractéristiques du Post 
			$req = $bdd->prepare('DELETE FROM auteur WHERE nom_auteur = :nom_auteur_cible');
			$req->execute(array(
				'nom_auteur_cible'=> $_POST['Nom_auteur_cible'],
			));
			$req->closeCursor();
			
			echo "L'auteur ".$_POST['Nom_auteur_cible'].' a bien était supprimé de la base de donnée' ;
		
		} else {
			echo '</br> Veulliez rentrer le nom de l\'auteur';
		}
		?>
		
		<?php
			}
		}
		?>

<!-- ===================================================== SUPRESSION D'EDITEUR ========================================================= -->
	
		<?php
		if (isset($_GET['type'])) {
			
			if ($_GET['type']=='editeur') {
		?>
		
		<div class="form_connexion">		
			<form method = "post" action = "suppr.php?type=<?php echo $_GET['type']?>">
				<input type="text" name="nom_editeur" placeholder="nom éditeur" size="10" class="champs"/>
				</br>
				</br>
				<input type="submit" name="valider" size="20"  value="Valider " class="champs"/>	
			</form>
		</div>
				
		<?php
		// On vérifie que le nom et l'adresse de l'editeur qu'on veut ajouter a la B.D. a bien était écrit
		if (isset($_POST['nom_editeur']) &&  !empty($_POST['nom_editeur']) ) {
		
			try {
					// On se connecte à MySQL
					$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '',
					array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
				}
				catch(Exception $e)
				{
					// En cas d'erreur, on affiche un message et on arrête tout
						die('Erreur : '.$e->getMessage());
				}
			// requete pour inserer un auteur avec les caractéristiques du Post 
			$req = $bdd->prepare('DELETE FROM editeur WHERE nom_editeur = :nom_editeur');
			$req->execute(array(
				'nom_editeur'=> $_POST['nom_editeur'],
			));	
			$req->closeCursor();
			echo "L'editeur ".$_POST['nom_editeur'].' a bien était supprimé de la base de donnée.' ;
		
		} else {
			echo '</br> Veulliez rentrer le nom et l\'adresse de l\'editeur';
		}
		?>
		
	<?php
		}
	}
	?>
	
	</center>
</body>

</html>