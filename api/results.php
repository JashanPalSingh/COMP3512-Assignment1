<?php 

require_once ('../includes/config.inc.php');
header('content-type: application/json');
header("Access-Control-Allow-Origin: *");
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    
    if (isset ($_GET['driver'])){
        $SQL = 'SELECT r.name AS raceName, r.round, r.year, r.date, c.name AS constructorName, c.constructorRef, c.nationality AS constructorNationality, res.grid, res.position, res.time, res.points
        FROM results res
        JOIN drivers d ON res.driverId = d.driverId
        JOIN constructors c ON res.constructorId = c.constructorId
        JOIN races r ON res.raceId = r.raceId
        WHERE d.driverRef = ?
        ORDER BY r.year DESC, r.round ASC;';
        
        $statement = $pdo -> prepare($SQL);
        $statement -> bindValue(1, $_GET['driver']);
        $statement -> execute();
        
    } elseif (isset ($_GET['ref'])) {
        $SQL = 'SELECT r.name AS raceName, r.round, r.year, r.date, d.driverRef, d.code, d.forename, d.surname, c.name AS constructorName, c.constructorRef, c.nationality AS constructorNationality, res.grid, res.position, res.time, res.points
        FROM results res
        JOIN drivers d ON res.driverId = d.driverId
        JOIN constructors c ON res.constructorId = c.constructorId
        JOIN races r ON res.raceId = r.raceId
        WHERE r.raceId = ?
        ORDER BY res.position ASC';
        
        $statement = $pdo -> prepare($SQL);
        $statement -> bindValue(1, $_GET['ref']);
        $statement -> execute();
    }     
    echo json_encode($statement -> fetchAll(PDO::FETCH_ASSOC));
    $pdo = null;
}catch (PDOException $e){
    echo '{"error": "API did not work: Check your querystring."}';
}

?>