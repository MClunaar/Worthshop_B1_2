<?php

function getDataBase()
{
    $host = "localhost";
    $dbName = "udepsi";
    $login = "root";
    $password = "";

    try
    {
        $bdd = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        $bdd = null;
        die('Erreur : ' . $e->getMessage());
    }

    return $bdd;
}

function authenticateUser($login, $password, PDO $bdd = null)
{
    $user = null;

    if ($bdd == null)
    {
        $bdd = getDataBase();
    }

    $connect = false;
    if ($bdd)
    {
        try
        {
            $stmt = $bdd->prepare ("SELECT * FROM employee WHERE login=:pLogin");
            $stmt->bindParam(':pLogin', $login);
            if ($stmt->execute()) {
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                if ($user && password_verify($password, $user->password)) {
                    $connect = true;
                }
            }
        }
        catch (Exception $e)
        {
            $connect = false;
        }
    }
    if ($connect)
        return $user;

    return null;
}

function getUniqueStates(PDO $bdd = null)
{
    if ($bdd == null)
    {
        $bdd = getDataBase();
    }

    if ($bdd)
    {

        $query = "SELECT DISTINCT(state) as state FROM publishers ORDER BY state";
        $resultset = $bdd->query($query);
        $liste = $resultset->fetchAll(PDO::FETCH_OBJ);
        $resultset->closeCursor();

        return $liste;
    }

    return null;
}

function getPublishers($nom, $state,PDO $bdd = null) {
    $publishers = null;

    if ($bdd == null)
    {
        $bdd = getDataBase();
    }

    if ($bdd)
    {
        // connexion r�ussie
        // La requete de base
        $query = "SELECT * FROM publishers AS p, country AS c WHERE p.idCountry = c.id";
        // On r�cup�re tout le contenu de la table
        if (empty($state) && empty($nom)) {
            // Tous les enregistrements
            $stmt = $bdd->prepare($query);
        } else {
            $queryWhere = "";
            if (!empty($nom)) {
                $queryWhere = " AND pub_name like :pName";
            }
            if (!empty($state)) {
                $queryWhere .= " AND state = :pState";
            }
            // Concanetation de la requete
            $query = $query . $queryWhere;
            $stmt = $bdd->prepare($query);
            if (!empty($nom)) {
                $nom = $nom . "%";
                $stmt->bindParam(':pName', $nom);
            }
            if (!empty($state)) {
                $stmt->bindParam(':pState', $state);
            }
        }
        $stmt->execute();

        $publishers = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    return $publishers;
}

function getPublisher($id, PDO $bdd = null)
{
    $publisher = null;

    if ($bdd == null) {
        $bdd = getDataBase();
    }

    // La bd est-elle valide ?
    if ($bdd) {
        // connexion r�ussie
        // 3 - On r�cup�re toutes les donn�es de l'�diteur
        $query = "SELECT * FROM publishers WHERE pub_id = :pId";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':pId', $id);
        $stmt->execute();

        $publisher = $stmt->fetch(PDO::FETCH_OBJ);
    }

    return $publisher;
}

function updatePublisher($id, $pub_name, $city, $state, $cbCountry, PDO $bdd = null)
{
    $nbModifs = 0;

    if ($bdd == null) {
        $bdd = getDataBase();
    }

    // La bd est-elle valide ?
    if ($bdd) {
        try
        {
            // Mise � jour dans la bd
            $stmt = $bdd->prepare ("UPDATE publishers SET pub_name=:pubName, city=:pCity, state=:pState, idCountry=:pIdCountry WHERE pub_id=:pubId");
            $stmt->bindParam(':pubId', $pub_id);
            $stmt->bindParam(':pubName', $pub_name);
            $stmt->bindParam(':pCity', $city);
            $stmt->bindParam(':pState', $state);
            $stmt->bindParam(':pIdCountry', $cbCountry, PDO::PARAM_INT);
            $nbModifs = $stmt->execute();
        }
        catch (Exception $e)
        {
            $nbModifs = 0;
        }
    }

    return $nbModifs;
}



function getContries(PDO $bdd = null)
{
    $countries = null;

    if ($bdd == null) {
        $bdd = getDataBase();
    }

    // La bd est-elle valide ?
    if ($bdd) {
        // Obtention de la liste des pays
        $resultat = $bdd->query("SELECT * FROM country");
        if ($resultat) {
            $countries = $resultat->fetchAll(PDO::FETCH_OBJ);
            // Fermeture de la ressource
            $resultat->closeCursor();
        }
    }

    return $countries;
}

/***************************
 **
 **
 *      PARTIE CLIENT
 **
 **
***************************/

function getCart()
{
    if (isset($_SESSION["cart"])) {
        return $_SESSION["cart"];
    }

    return null;
}

function clearCart()
{
    if (isset($_SESSION["cart"])) {
        unset($_SESSION["cart"]);
    }
}

function getNbCarts()
{
    if (isset($_SESSION["cart"]) && $_SESSION["cart"] != null) {
        return $_SESSION["cart"]->getTotalQuantity();
        //return $_SESSION["cart"]->getTotalItem();
    }

    return 0;
}

function addPublisherToCart($id)
{
    $publisher = getPublisher($id);

    if ($publisher) {
        // On met � jour le panier dans la session
        if (! isset($_SESSION["cart"]) || $_SESSION["cart"] == null) {
            $_SESSION["cart"] = new Cart();
        }
        $_SESSION["cart"]->insert($publisher->pub_id, $publisher->pub_name);

    }

}


/**
 * @param string $login
 * @param PDO $bdd
 */
function insertCommand($login, PDO $bdd = null)
{
    $newId = 0;

    if ($bdd == null) {
        $bdd = getDataBase();
    }

    // La bd est-elle valide ?
    if ($bdd) {
        try
        {
            // Insertion dans la bd
            $stmt = $bdd->prepare ("INSERT INTO command(login) VALUE(:pLogin)");
            $stmt->bindParam(':pLogin', $login);
            if ($stmt->execute()) {
                // On r�cup�re l'ID de la commande
                $newId = $bdd->lastInsertId();
            }
        }
        catch (Exception $e)
        {
            $newId = 0;
        }
    }

    return $newId;
}

/**
 * @param integer $idCmd
 * @param integer $idItem
 * @param integer $quantity
 * @param PDO $bdd
 */
function insertCommandDetail($idCmd, $idItem, $quantity, PDO $bdd = null)
{
    $nbModifs = 0;

    if ($bdd == null) {
        $bdd = getDataBase();
    }

    // La bd est-elle valide ?
    if ($bdd) {
        try
        {
            // Insertion dans la bd
            $stmt = $bdd->prepare ('INSERT INTO commanddetail(idcmd, iditem, quantity) VALUE(:pIdCmd, :pIdItem, :pQuantity)');
            $stmt->bindParam(':pIdCmd', $idCmd, PDO::PARAM_INT);
            $stmt->bindParam(':pIdItem', $idItem, PDO::PARAM_INT);
            $stmt->bindParam(':pQuantity', $quantity, PDO::PARAM_INT);
            $nbModifs = $stmt->execute();
        }
        catch (Exception $e)
        {
            $nbModifs = 0;
        }
    }

    return $nbModifs;
}

/*
 * @param string $login
 * @param PDO $bdd
 */
function getNbCommandes($login, PDO $bdd = null)
{
    $nbCommand = 0;

    if ($bdd == null) {
        $bdd = getDataBase();
    }

    // La bd est-elle valide ?
    if ($bdd) {
        // connexion r�ussie
        // 3 - On r�cup�re toutes les donn�es de l'�diteur
        $query = "SELECT COUNT(*) AS nbcmd FROM command WHERE login=:pLogin";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':pLogin', $login);
        $stmt->execute();

        $resultset = $stmt->fetch();
        if ($resultset)
            $nbCommand = intval($resultset["nbcmd"]);
    }

    return $nbCommand;
}

/*
 * @param string $login
 * @param PDO $bdd
 */
function getCommandes($login, PDO $bdd = null)
{
    $liste = null;

    if ($bdd == null) {
        $bdd = getDataBase();
    }

    // La bd est-elle valide ?
    if ($bdd) {
        // connexion r�ussie
        // 3 - On r�cup�re toutes les donn�es de l'�diteur
        $query = "SELECT date, idcmd, iditem, pub_name as libelle, quantity 
                    FROM command as c, commanddetail as cdt, publishers as p 
                    WHERE c.id = cdt.idcmd 
                        AND cdt.iditem = p.pub_id
                        AND c.login=:pLogin 
                    ORDER BY cdt.idcmd, cdt.iditem";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':pLogin', $login);
        $stmt->execute();

        $liste = $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    return $liste;
}

/*
 * @param string $login
 * @param integer $idCmd
 * @param PDO $bdd
 */
function getCommande($login, $idCmd, PDO $bdd = null)
{
    $liste = null;

    if ($bdd == null) {
        $bdd = getDataBase();
    }

    // La bd est-elle valide ?
    if ($bdd) {
        // connexion r�ussie
        // 3 - On r�cup�re toutes les donn�es de la commande
        $query = "SELECT date, idcmd, iditem, pub_name as libelle, quantity 
                    FROM command as c, commanddetail as cdt, publishers as p 
                    WHERE c.id = cdt.idcmd 
                        AND cdt.iditem = p.pub_id
                        AND c.login=:pLogin 
                        AND cdt.idcmd=:pIdCmd
                    ORDER BY cdt.idcmd, cdt.iditem";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':pLogin', $login);
        $stmt->bindParam(':pIdCmd', $idCmd, PDO::PARAM_INT);
        $stmt->execute();

        $liste = $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    return $liste;
}
