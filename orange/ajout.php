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
				<a class="titlebutton" href="site_orange.php">Médiathèque d'orange</a>
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
					<a class="currentbutton" href="ajout.php"> Ajouts </a>
					<a class="button" href="modif.php"> Modifications</a>
					<a class="button" href="suppr.php"> Suppressions </a>
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
			</br> Que souhaitez-vous ajouter? </br>
			<a class="typebutton" href="ajout.php?type=auteur"> Auteur </a>
			<a class="typebutton" href="ajout.php?type=editeur"> Editeur</a>
			<a class="typebutton" href="ajout.php?type=livre"> Livre</a>
		</p>
		
		
		<?php 
		} 
		?>

<!-- ======================================================== AJOUT D'AUTEUR ========================================================= -->
		
		<?php
		if (isset($_GET['type'])) {
		
			if ($_GET['type']=='auteur') {
		?>
		
		<div class="form_connexion">		
			<form method = "post" action = "ajout.php?type=<?php echo $_GET['type']?>">	
				<input type="text" name="Nom_auteur" placeholder="Nom auteur" size="10" class="champs"/>
				</br>
				<input type="text" name="Prenom_auteur" placeholder="Prenom auteur" size="10" class="champs"/>
				</br>
				</br>
				<input type="submit" name="valider" size="20"  value="Valider " class="champs"/>
			</form>
		</div>
		
		<?php
		// On vérifie que le nom et le prenom de l'auteur qu'on veut ajouter a la B.D. a bien était écrit
		if (isset($_POST['Nom_auteur']) &&  !empty($_POST['Nom_auteur']) && isset($_POST['Prenom_auteur']) &&  !empty($_POST['Prenom_auteur'])) {
		
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
			$req = $bdd->prepare('INSERT INTO auteur(Nom_auteur, Prenom_auteur ) VALUES( ? , ?)');
			$req->execute(array($_POST['Nom_auteur'],$_POST['Prenom_auteur']));
			$req->closeCursor();
			
			echo "L'auteur ".$_POST['Nom_auteur']. ' ' . $_POST['Prenom_auteur'] . ' a bien était ajouté a la base de donnée' ;
		
		} else {
			echo '</br> Veulliez rentrer le nom et le prenom de l\'auteur';
		}
		?>
		
	<?php
		}
	}
	?>

<!-- ============================================================== AJOUT D'EDITEUR ============================================================ -->
	
	
		<?php
		if (isset($_GET['type'])) {
			
			if ($_GET['type']=='editeur') {
		?>
		
		<div class="form_connexion">		
			<form method = "post" action = "ajout.php?type=<?php echo $_GET['type']?>">	
				<input type="text" name="nom_editeur" placeholder="Nom éditeur" size="10" class="champs"/>
				</br>
				<input type="text" name="adresse_editeur" placeholder="Adresse editeur" size="10" class="champs"/>
				</br>
				</br>
				<input type="submit" name="valider" size="20"  value="Valider " class="champs"/>	
			</form>
		</div>
				
		<?php
		// On vérifie que le nom et l'adresse de l'editeur qu'on veut ajouter a la B.D. a bien était écrit
		if (isset($_POST['nom_editeur']) &&  !empty($_POST['nom_editeur']) && isset($_POST['adresse_editeur']) &&  !empty($_POST['adresse_editeur'])) {
		
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
			// requete pour inserer un editeur avec les caractéristiques du Post 
			$req = $bdd->prepare('INSERT INTO editeur(nom_editeur, adresse_editeur ) VALUES( ? , ?)');
			$req->execute(array($_POST['nom_editeur'],$_POST['adresse_editeur']
				
				));
			$req->closeCursor();
			echo "L'editeur ".$_POST['nom_editeur']. " résidant à " . $_POST['adresse_editeur'] . ' a bien était ajouté a la base de donnée.' ;
		
		} else {
			echo '</br> Veulliez rentrer le nom et le adresse de l\'editeur';
		}
		?>
		
	<?php
		}
	}
	?>
	
<!-- ============================================================== AJOUT DE LIVRE ============================================================ -->
	
	<?php
		if (isset($_GET['type'])) {
			
			if ($_GET['type']=='livre') {
		?>
	
		<div class="form_connexion">		
			<form method = "post" action = "ajout.php?type=livre">
					<input type="text" name="Titre_livre" placeholder="Entrer le titre (et sous titre si existant)" size="40" class="champs"/>
					</br>
					<input type="text" name="DatePublication_livre" placeholder="date (annee-mm-jj)" size="40" class="champs"/>
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
					</br>
					<input type="submit" name="valider" size="20"  value="Valider " class="champs"/>	
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
				echo "Le livre ".$_POST['Titre_livre']. ' De ' . $_POST['Id_auteur'] . ', a bien était ajouté à la base de donnée ';	
			} else {
				echo "</br> Entrer un livre ";
			}

		?>
	
	<?php
		}
	}
	?>

	</center>
</body>

</html>