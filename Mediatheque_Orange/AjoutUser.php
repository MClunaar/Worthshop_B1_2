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
			<form method = "post" action = "AjoutUser.php">
						<input type="text" name="Nom_adherent" placeholder="Entrez le nom de l'adhérent" size="40" class="champs"/>
					</br>
						<input type="text" name="Prenom_adherent" placeholder="Entrez le prenom de l'adhérent" size="40" class="champs"/>
					</br>
						<input type="text" name="Adresse1_adherent" placeholder="entrez l'adresse de l'adhérent" size="40" class="champs"/>
					</br>
						<input type="text" name="Adresse2_adherent" placeholder="Précisez l'adresse   *Falcutatif*)" size="40" class="champs"/>
					</br>
						<input type="text" name="CP_adherent" placeholder="Entrer le code postal" size="40" class="champs"/>
					</br>
						<input type="text" name="Ville_adherent" placeholder="Entrer la ville" size="40" class="champs"/>
					</br>
						<input type="text" name="Numero_adherent" placeholder="Entrer le numéro de telephone" size="40" class="champs"/>
					</br>
						<input type="text" name="Mail_adherent" placeholder="Entrer l'adresse email" size="40" class="champs"/>
					</br>
	
					<input type="submit" name="valider" size="20"  value="Valider" class="champs"/>	
			</form>
		</div>
		
		
		
	<?php
		
		if  (  isset($_POST['Nom_adherent'])          &&  !empty($_POST['Nom_adherent'])
			&& isset($_POST['Prenom_adherent'])		  &&  !empty($_POST['Prenom_adherent']) 
			&& isset($_POST['Adresse1_adherent'])     &&  !empty($_POST['Adresse1_adherent'])
			&& isset($_POST['CP_adherent'])			  &&  !empty($_POST['CP_adherent']) 
			&& isset($_POST['Ville_adherent'])        &&  !empty($_POST['Ville_adherent'])
			&& isset($_POST['Numero_adherent'])       &&  !empty($_POST['Numero_adherent'])
			&& isset($_POST['Mail_adherent'])         &&  !empty($_POST['Mail_adherent'])
			){
		
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
				
			// requete pour inserer un adhérent avec les caractéristiques des  $_Post 
			$req1 = $bdd->prepare('INSERT INTO adherent( Nom_adherent , Prenom_adherent, Adresse1_adherent , Adresse2_adherent ,CP_adherent , Ville_adherent , Numero_adherent , AdresseMail_adherent  ) VALUES( ? , ? , ? , ? , ? , ? , ? , ? )');
			$req1->execute(array($_POST['Nom_adherent'],$_POST['Prenom_adherent'],$_POST['Adresse1_adherent'],$_POST['Adresse2_adherent'],$_POST['CP_adherent'],$_POST['Ville_adherent'],$_POST['Numero_adherent'],$_POST['Mail_adherent']));
			echo "L'adhérent ".$_POST['Prenom_adherent']. '  ' . $_POST['Nom_adherent'] . ', a bien était ajouté a la base de donnée';	
									try {
										// On se connecte à MySQL
										$bdg = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '',
										array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); // Fait en sorte d'afficher les erreurs due au SQL
										}
										
									catch(Exception $e)
										{
											// En cas d'erreur, on affiche un message et on arrête tout
											die('Erreur : '.$e->getMessage());
										}
										
									// requete pour inserer un adhérent avec les caractéristiques des  $_Post 
									$req2 = $bdg->prepare('Select Id_adherent FROM adherent Where Nom_adherent= ? AND Prenom_adherent= ? ');
									$req2->execute(array($_POST['Nom_adherent'],$_POST['Prenom_adherent']));
									while ($donnees = $req2->fetch())
										{
									echo "  Son ID est le : " . $donnees['Id_adherent'] ;
										}
	$req1->closeCursor();	
	$req2->closeCursor();	
									
			?>
			
									<div class="form_connexion">		
									<form method = "post" action = "AjoutUser.php">
												<input type="text" name="Date_abonnement" placeholder="date de la fin de l'abonnement" size="40" class="champs"/>
											</br>
												<input type="text" name="type_abonnement" placeholder="abonnement mensuel ou annuel" size="40" class="champs"/>
											</br>
											<input type="text" name="Id_adherent" placeholder="L'id" size="40" class="champs"/>
											</br>
								<input type="submit" name="valider" size="20"  value="Terminer" class="champs"/>	
						
		<?php 	
		}else {
			echo "Entrez un nouvel adhérent ";
		}
		if  (  isset($_POST['Date_abonnement'])          &&  !empty($_POST['Date_abonnement'])
								&& isset($_POST['type_abonnement'])		  &&  !empty($_POST['type_abonnement'])) {
										try {
											// On se connecte à MySQL
											$bdh = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '',
											array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); // Fait en sorte d'afficher les erreurs due au SQL
											}
											
										catch(Exception $e)
											{
												// En cas d'erreur, on affiche un message et on arrête tout
												die('Erreur : '.$e->getMessage());
											}
											
										// requete pour inserer un adhérent avec les caractéristiques des  $_Post 
										$req3 = $bdh->prepare('INSERT INTO abonnement( Date_abonnement ,type_abonnement, Id_adherent )  VALUES( ? , ? , ?  )');
										$req3->execute(array($_POST['Date_abonnement'],$_POST['type_abonnement'], $_POST['Id_adherent']));
										echo "vous avez bien inscrit l'adhérent ainsi que son abonnement";
							$req3->closeCursor();
							} else {
							echo "Veuillez saisir son abonnement si besoin" ;
							}	

	?>	
	
		</center>
	</body>
</html>