<?php 

include "includes/config.inc.php";

function getCircuits(){
    $SQL = 'SELECT "round", name FROM races WHERE races."year" = 2022 ORDER BY "round";';
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $statement = $pdo -> prepare($SQL);
    $statement -> execute();
    return $statement -> fetchAll();
}

?>