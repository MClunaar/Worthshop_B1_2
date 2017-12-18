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
		<form method = "post" action = "emprunt.php">
			<input type="text" name="Id_adherent" placeholder="Identifiant de l'adherent" size="40" class="champs"/>
			</br>
			<input type="text" name="date_retour" placeholder="Date de retour " size="40" class="champs"/>
			</br>
			<input type="text" name="Id_Exemplaire" placeholder="id de l'exemplaire" size="40" class="champs"/>
			</br>
			<input type="submit" name="valider" size="20"  value="Terminer" class="champs" />
			
			</br>
			
			
		</div>
		<?php 	
		if  (isset($_POST['Id_adherent'])         &&  !empty($_POST['Id_adherent'])) {
	
								try {$bdh = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', ''); } catch(Exception $e) {die('Erreur : '.$e->getMessage()); }							
								$req3 = $bdh->prepare('INSERT INTO emprunte(date_retour,Id_Exemplaire,Id_adherent)  VALUES( ? , ? , ?  )');
								$req3->execute(array($_POST['date_retour'],$_POST['Id_Exemplaire'], $_POST['Id_adherent']));
								echo 'l\'emprunt a bien était enregistrer';
								$req3->closeCursor();								
								
							} else {
							echo "Veuillez saisir veuillez saisir le l'adhérent qui emprunte" ;
							}	
		?>	
	
		</center>
		
				
	
	</body>
	
</html>
