<?php

/*** mysql hostname ***/
$hostname = 'localhost';
/*** mysql username ***/
$username = 'root';
/*** mysql password ***/
$password = '';

try {
    $db = new PDO("mysql:host=$hostname;dbname=3TID2_2013", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    }
catch(PDOException $e)
    {
    echo "erreur : ".$e->getMessage();
    }
?>