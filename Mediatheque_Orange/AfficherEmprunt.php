<html>
	
	
	<body>
		
		<form method = "post" action = "AfficherEmprunt.php">
			<input type="text" name="Id_adherent" placeholder="Identifiant de l'adherent" size="40" class="champs"/>
			</br>

			<input type="submit" name="valider" size="20"  value="Terminer" class="champs" />
			
			</br>
			
			
		
<?php 						
							if  (  isset($_POST['Id_adherent'])          &&  !empty($_POST['Id_adherent'])) {
								
								try { $bdh = new PDO('mysql:host=localhost;dbname=projet_orange;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); } catch(Exception $e) {die('Erreur : '.$e->getMessage()); }
								$req4 = $bdh->prepare('Select * From exemplaire ex, emprunte e,livre l, adherent a WHERE e.Id_adherent=a.Id_adherent And l.Id_Exemplaire=ex.Id_Exemplaire And l.Id_Exemplaire=e.id_Exemplaire And e.id_adherent= ?');
								$req4->execute(array($_POST['Id_adherent'])); 
								$a = 1;
								
								while ($donnees = $req4->fetch())
		
								{
									?>
									<p>
									<li><strong>Emprunt <?php echo $a; ?></strong> : 
									
									<br />
								
									<?php echo 'Titre du livre :  ' . $donnees['Titre_livre']; ?>
											
									<br />
											
									<?php echo 'exmplaires n°  :  ' . $donnees['Id_Exemplaire']; ?>
											
									<br />
											
									<?php echo 'Date retour :  ' . $donnees['date_retour']; ?>
											
									<br />
									
									<?php echo 'Livre empruntez par : ' . $donnees['Nom_adherent'] . $donnees['Prenom_adherent'] ; ?>
											
											
											
									<br />
									<br />
											
									</p>
										 
	<?php
								$a++;
								}
								
									$req4->closeCursor();
									
					} else {
							echo "Veuillez saisir veuillez saisir l'adhérent dont vous voulez voir les emprunts" ;
							}	
		?>		
					
	</body>
	
</html>				
									
								