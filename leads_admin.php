<?php
//Démarrage de la session
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrateur Lead</title>
	<meta charset="utf-8">
</head>
<body>

	<?php 

// Si l'utilisateur est déjà connecté
		if (isset($_SESSION['login'])) {
			?>

			<a href="./leads.csv">Récupérer</a>

			<?php
		} else {
			?>

			<form action="./leads_admin.php" method="POST">
				<label>Mots de passe</label>
				<input type="password" name="pass" required>

				<button type="submit">Connexion</button>
			</form>

		<?php
		}
	?>
</body>
</html>

//Définition du mot de passe
<?php 
	$PASSWORD = "vincent";

	if (isset($_POST['pass'])) {
		$input = $_POST['pass'];

// Vérification du mot passe
		if ($PASSWORD != $input) {
			echo "Mots de passe invalide";
			return;
		}

// utilisateur enfin connecté !
		$_SESSION['login'] = 1;
	}


?>