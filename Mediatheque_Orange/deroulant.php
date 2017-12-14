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

			</form>
	<center>
		<select name="choix">	
	
				<?php 	
					$déroulant=0;
							while($déroulant<1000000000000){
								
								?>
								<option value="valeur<?php $déroulant;?>" size="20">
								<?php
									try {
										$bdd = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '');
										}
										catch(Exception $e)
										{
											// En cas d'erreur, on affiche un message et on arrête tout
											die('Erreur : '.$e->getMessage());
										}
										// requete pour inserer un auteur avec les caractéristiques du Post 
										$reponse = $bdd->prepare('SELECT * FROM auteur Where Id_auteur = ? ');
										$reponse->execute(array($déroulant));

									
										while ($donnees = $reponse->fetch())
										{										
											echo $donnees['Nom_auteur'];					
										}
									$reponse->closeCursor();													
								$déroulant = $déroulant +1 ;
							}
							?>
							 </option>
		</select>

				
		</center>
	
	</body>
	
</html>
 