<?php 

require_once ('../includes/config.inc.php');
header('content-type: application/json');
header("Access-Control-Allow-Origin: *");
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    
    $SQL = 'SELECT DISTINCT d.driverId, d.forename, d.surname, d.driverRef
    FROM drivers d
    JOIN results r ON d.driverId = r.driverId
    JOIN races ra ON r.raceId = ra.raceId
    JOIN seasons s ON ra.year = s.year
    WHERE s.year = 2022;';

    $statement = $pdo -> prepare($SQL);
    $statement -> execute();
    echo json_encode($statement -> fetchAll(PDO::FETCH_ASSOC));
    $pdo = null;
}catch (PDOException $e){
    echo '{"error": "API did not work: Check your querystring."}';
}

?>