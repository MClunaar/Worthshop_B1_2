<?php
require_once "../controller/print_user.php";
require_once "../model/udepsi.php";

//Connexion à la BD
$bdd = getDataBase();

//Requête SQL pour voir tous les utilisateurs
if ($bdd) {
    $query = "SELECT * FROM utilisateur";
    // Exécution de la requête
    $resultat = $bdd->query($query);

// "tableau" valide ?
    if ($resultat) {
        // parcours du "tableau"
        $donnees = $resultat->fetch();
        // "donnees" valide ?
        if ($donnees) {
            // parcours du "tableau"
            while ($donnees) {
                // On affiche chaque entrée une à une

                echo "Nom = " . $donnees["nom"] . '</br>';
                echo " Prénom = " . $donnees['prenom'] . '</br>';
                echo "et a pour pseudo : " . $donnees['pseudo'] . "</br><br>";
                //Affichage des boutons de modif et de suppression
                echo "<a href =../controller/edit_user.php?id=" . $donnees['id_user'] . ">" . "Editer" . "<a/>";
                echo " | ";
                echo "<a href =../controller/delete_users.php?id=" . $donnees['id_user'] . ">" . "Supprimer" . "<a/>";

                echo '<br />' . '</br>';

                // on récupère la ligne suivante
                $donnees = $resultat->fetch();
            }
            // Fermeture de la ressource
            $resultat->closeCursor();
        } else {
            // Le tableau est vide : il n’y a aucun enregistrements
            echo "Aucun résultat";
        }
    }
}
?>

<a href="../html/new_user.php"> Ajouter un utilisateur</a>
