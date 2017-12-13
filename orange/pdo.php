<html>
<head>
</head>
<body>
<form method = "post" action = "Pdo.php">
					<input type="text" name="possesseur" placeholder="Votre recherche" size="30" class="champs"/>
					</br>
					<input type="submit" name="valider" size="20"  value="Connexion" class="champs"/>	

			</form>
<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table jeux_video ou le posseseur est égal a la recherche du $_POST (du coup au cas ou ta pas capté c'est avec ce genre de truc qu'on va niquer le game)
$req = $bdd->prepare('SELECT * FROM jeux_video WHERE possesseur = ?');
$req->execute(array($_POST['possesseur']));

// On affiche chaque entrée une à une. Parce qu'en gros la tu lis un suite de caractere pas sous forme d'array 
//et le $données le fait passées en array (je sais pas trop l'expliqer en faite)
while ($donnees = $req->fetch())
{
?>
    <p>
    <strong>Jeu</strong> : <?php echo $donnees['nom']; ?><br />
	
    Le possesseur de ce jeu est : 
	<?php echo $donnees['possesseur']; ?>
	
	, et il le vend à 
	<?php echo $donnees['prix']; ?> 
	euros !<br />
	
	Ce jeu fonctionne sur 
	<?php echo $donnees['console']; ?>
	et on peut y jouer à
	
	<?php echo $donnees['nbre_joueurs_max']; ?> 
	au maximum<br />
	
    <?php echo $donnees['possesseur']; ?>
	a laissé ces commentaires sur
	
	<?php echo $donnees['nom']; ?> 
	: <em>
	
	<?php echo $donnees['commentaires']; ?>
	</em>
  
  </p>
 
<?php
}

$req->closeCursor(); // Termine le traitement de la requête ====>> LE PUTAIN DE POINT VIRGULE

?>
</body>
</html>