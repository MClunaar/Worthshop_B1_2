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
			<form method = "post" action = "jointure.php">
					<h1>Entrez le nom de l'auteur que vous recherchez:</h1>
					</br>
					</br>
					<input type="text" name="Nom_auteur" placeholder="ex: Zola" size="15" class="champs"/>
					</br>
					</br>
					<input type="submit" name="valider" size="20"  value="Rechercher " class="champs"/>	

			</form>
		</div>
		<?php
		if (isset ($_POST['Nom_auteur']) &&  !empty($_POST['Nom_auteur']) ) {	
				try
				{
					$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));// On se connecte à MySQL
				}
				catch(Exception $e)
				{
					// En cas d'erreur, on affiche un message et on arrête tout
						die('Erreur : '.$e->getMessage());
				}


				// On récupère tout le contenu de la table jeux_video ou le posseseur est égal a la recherche du $_POST )
				$req = $bdd->prepare('SELECT * FROM livre , auteur , editeur WHERE livre.Id_auteur= auteur.Id_auteur And auteur.Nom_auteur like ? AND livre.Id_editeur=editeur.id_editeur');// le prepare signifie que la requete est préparé et qu'on va envoyer la donnée a la place du ? avec l'execute qui suit
				$req->execute(array('%'.$_POST['Nom_auteur'].'%'));
				
					
				$a = 1;
				// On affiche chaque entrée une à une
				while ($donnees = $req->fetch())
				{
				?>
					<p>
					<li><strong>Resultat <?php echo $a; ?></strong> : 
					
					<br />
					
					<?php echo 'Titre du livre :  ' . $donnees['Titre_livre']; ?>
					
					<br />
					
					<?php echo  'type de livre :  ' . $donnees['type_livre']; ?>
					
					<br />
					
						<?php echo 'genre :  ' . $donnees['genre_livre']; ?>
					
					<br />
					
					<?php echo 'éditeur :  ' . $donnees['nom_editeur']; ?>
					
					<br />
					
					<?php echo  'auteur du livre:  ' . $donnees['Nom_auteur'] . ' ' . $donnees['Prenom_auteur']; ?>
					
					
					
					
					
					
					
					<br />
					<br />
					
					</p>
				 
				<?php
				$a++; }
				$req->closeCursor(); // Termine le traitement de la requête

		}	
		elseif( empty($_POST['genre_livre']) &&  empty($_POST['genre_livre'])){
			echo "Quel genre de livre cherchez vous ? ";
		}
		else {
			echo "votre recherche na pas était correctement formuler";
		}
		?>
		</center>		
	
	</body>
	
</html>
 