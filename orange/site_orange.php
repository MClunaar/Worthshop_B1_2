<html>

<head>
	<link href="css_orange.css" rel="stylesheet">
	
	<?php 
	session_start()
	?>
</head>

<!-- ======================================================= BANNIERE ========================================================= -->

<body>
	<div class="banner">
		<div class="bannercontent">
		
			<div class="titre">
			
				<a class="titlebutton" href="site_orange.php"> Médiathèque d'orange </a>
			</div>
			
		<!-- ============================= Si l'utilisateur est connecté ======================== -->
			
			<?php
			if (isset ($_SESSION['identifiant'])) {							
			?>
			
				<div class="connecte">
					<?php
					echo "Connecté en tant que ".$_SESSION['identifiant'];
					?>
				</div>
				
				<p class="navigbuttons">
					<a class="currentbutton" href="site_orange.php" style="margin-right:3%"> Acceuil </a>
					<a class="button" href="ajout.php"> Ajouts </a>
					<a class="button" href="modif.php"> Modifications</a>
					<a class="button" href="suppr.php"> Suppressions </a>
					<a class="button" href="deconnexion.php" style="margin-left:3%"> Deconnexion </a>
				</p>
			
		<!-- ============================= Si l'utilisateur se connecte ======================== -->
			
			<?php 
			} else if (isset ($_POST['identifiant'])) {
			?>			
				
				<?php
				
				try	{
					$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '');// On se connecte à MySQL
				}
				
				catch(Exception $e)	{
					// En cas d'erreur, on affiche un message et on arrête tout
					die('Erreur : '.$e->getMessage());
				}
				
				// On récupère le mot de passe correspondant à l'identifiant renseignée
				$req = $bdd -> prepare("SELECT password_admin FROM admin WHERE id_admin = ? ");
				$req->execute(array(
					$_POST['identifiant']
				));
				
				$donnees = $req -> fetch();
				$password = $donnees['password_admin'];
				
				
				if ($password == $_POST['password'] and isset($_POST['password']) and $_POST['password'] != '') {
					$_SESSION['identifiant'] = $_POST['identifiant'];
					$_SESSION['name'] = $_POST['identifiant'];
				?>
					
					<div class="connecte">
					<?php
					echo "Connecté en tant que ".$_POST['identifiant'];
					?>
					</div>
					
					<p class="navigbuttons">
					<a class="currentbutton" href="site_orange.php" style="margin-right:3%"> Acceuil </a>
					<a class="button" href="ajout.php"> Ajouts </a>
					<a class="button" href="modif.php"> Modifications </a>
					<a class="button" href="suppr.php"> Suppressions </a>
					<a class="button" href="deconnexion.php" style="margin-left:3%"> Deconnexion </a>
					</p>
					
				<?php
				} else {
					echo '<meta http-equiv="refresh" content="0; URL=site_orange.php">';
				}
			} else {
			?>
			<!-- ============================= Si l'utilisateur n'est pas connecté ======================== -->
			
				<p class="navigbuttons">
				<a class="connectbutton" href="site_orange_admin.php"> Identification </br> Administrateur </a>
				</p>
					
			<?php
			}
			?>
		
		</div>		
	</div>
	
	</br>
	</br>
	
<!-- ======================================================= RECHERCHE D'AUTEUR ========================================================= -->
	
	<center>
		<?php
		if (isset ($_POST['Prenom_auteur'])) {	
		
			try	{
				$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '');// On se connecte à MySQL
			}
			
			catch(Exception $e)	{
				// En cas d'erreur, on affiche un message et on arrête tout
				die('Erreur : '.$e->getMessage());
			}
			
			// On récupère tout le contenu de la table jeux_video ou le posseseur est égal a la recherche du $_POST )
			$req = $bdd->prepare("SELECT * FROM auteur WHERE Prenom_auteur like ? ");// le prepare signifie que la requete est préparé et qu'on va envoyer la donnée a la place du ? avec l'execute qui suit
			$req->execute(array('%'.$_POST['Prenom_auteur'].'%'));
			
			echo '<ul>';
			
			$a = 1;
			
			// On affiche chaque entrée une à une
			while ($donnees = $req->fetch()) {
			?>
				<p>
				<li><strong>Resultat <?php echo $a; ?></strong> : 			
				<br/>
				<?php
				echo 'Nom de l\'auteur  ' . $donnees['Nom_auteur']; 
				?>			
				<br/>			
				<?php echo  'Prenom de l\'auteur  ' . $donnees['Prenom_auteur']; ?>
				<br/>
				<br/>
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
		</form>
		
	</center>
</body>
	
	
</html>