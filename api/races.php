<?php 

require_once ('../includes/config.inc.php');
header('content-type: application/json');
header("Access-Control-Allow-Origin: *");
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    if (! isset ($_GET['ref'])){
    $SQL = 'SELECT `round`, `name`, raceId FROM races WHERE races.`year` = 2022 ORDER BY `round`;';
    $statement = $pdo -> prepare($SQL);
    $statement -> execute();
    }
    else{
        $SQL = 'SELECT races.`name`,`round`, circuits.`name`, circuits.`location`, circuits.`country`, races.`date`, races.url, raceId FROM races JOIN circuits ON races.circuitId = circuits.circuitId WHERE races.raceId=?;';
        $statement = $pdo -> prepare($SQL);
        $statement -> bindValue(1, $_GET['ref']);
        $statement -> execute();
    }
    echo json_encode($statement -> fetchAll(PDO::FETCH_ASSOC), JSON_NUMERIC_CHECK);
    $pdo = null;
}catch (PDOException $e){
    echo '{"error": "API did not work: Check your querystring."}';
}

?>