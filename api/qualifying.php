<?php 

/**
 * API that returns qualifying information in JSON format.
 * @author Ishan Ishan
 */

require_once ('../includes/config.inc.php');
header('content-type: application/json');
header("Access-Control-Allow-Origin: *");
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    
    $SQL = 'SELECT q.position, d.driverId, d.driverRef, d.forename, d.surname, c.constructorId, c.constructorRef, c.name AS constructorName, q.q1, q.q2, q.q3
    FROM qualifying q
    JOIN drivers d ON q.driverId = d.driverId
    JOIN constructors c ON q.constructorId = c.constructorId
    JOIN races r ON q.raceId = r.raceId
    WHERE r.raceId = ?
    ORDER BY q.position ASC;';

    $statement = $pdo -> prepare($SQL);
    $statement -> bindValue(1, $_GET['ref']);
    $statement -> execute();
    echo json_encode($statement -> fetchAll(PDO::FETCH_ASSOC));
    $pdo = null;
}catch (PDOException $e){
    echo '{"error": "API did not work: Check your querystring."}';
}

?>