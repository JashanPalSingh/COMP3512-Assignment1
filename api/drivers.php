<?php 

require_once ('../includes/config.inc.php');
header('content-type: application/json');
header("Access-Control-Allow-Origin: *");
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    
    if (isset ($_GET['race'])){
        $SQL = 'SELECT DISTINCT d.driverId, d.forename, d.surname, d.driverRef
        FROM drivers d
        JOIN results r ON d.driverId = r.driverId
        JOIN races ra ON r.raceId = ra.raceId
        JOIN seasons s ON ra.year = s.year
        WHERE ra.raceID= ?;';
        
        $statement = $pdo -> prepare($SQL);
        $statement -> bindValue(1, $_GET['race']);
        $statement -> execute();
        
    } elseif (isset ($_GET['ref'])) {
        $SQL = 'SELECT DISTINCT d.driverId, d.forename, d.surname, d.driverRef
        FROM drivers d
        JOIN results r ON d.driverId = r.driverId
        JOIN races ra ON r.raceId = ra.raceId
        JOIN seasons s ON ra.year = s.year
        WHERE d.driverRef= ?;';
        
        $statement = $pdo -> prepare($SQL);
        $statement -> bindValue(1, $_GET['ref']);
        $statement -> execute();
    } else {
        $SQL = 'SELECT DISTINCT d.driverId, d.forename, d.surname, d.driverRef
        FROM drivers d
        JOIN results r ON d.driverId = r.driverId
        JOIN races ra ON r.raceId = ra.raceId
        JOIN seasons s ON ra.year = s.year
        WHERE s.year = 2022;';
        
        $statement = $pdo -> prepare($SQL);
        $statement -> execute(); 
    }
    
    echo json_encode($statement -> fetchAll(PDO::FETCH_ASSOC));
    $pdo = null;
}catch (PDOException $e){
    echo '{"error": "API did not work: Check your querystring."}';
}

?>