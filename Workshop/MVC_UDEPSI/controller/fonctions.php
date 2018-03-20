<?php
/**
 * Created by PhpStorm.
 * User: vince
 * Date: 20/03/2018
 * Time: 13:38
 */
function getdatabase()
{
    $host = "localhost";
    $login = "root";
    $password = "";
    $dbName = "udepsi";

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