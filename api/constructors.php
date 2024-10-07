<?php 

require_once ('../includes/config.inc.php');
header('content-type: application/json');
header("Access-Control-Allow-Origin: *");
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    
    if (! isset ($_GET['ref'])) {
        $SQL = 'SELECT DISTINCT co.constructorId, co.constructorRef, co.name
        FROM constructors co
        JOIN results re ON co.constructorId = re.constructorId
        JOIN races ra ON re.raceId = ra.raceId
        WHERE ra.year = 2022;';
        
        $statement = $pdo -> prepare($SQL);
        $statement -> execute();
    } else {
        $SQL = 'SELECT DISTINCT co.constructorId, co.constructorRef, co.name
        FROM constructors co
        JOIN results re ON co.constructorId = re.constructorId
        JOIN races ra ON re.raceId = ra.raceId
        WHERE ra.year = 2022 AND co.constructorRef= ?;';
        
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