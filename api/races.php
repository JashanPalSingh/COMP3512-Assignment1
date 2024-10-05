<?php 

require_once ('../includes/config.inc.php');
header('content-type: application/json');
header("Access-Control-Allow-Origin: *");
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    
    $SQL = 'SELECT `round`, `name`, raceId FROM races WHERE races.`year` = 2022 ORDER BY `round`;';
    $statement = $pdo -> prepare($SQL);
    $statement -> execute();
    echo json_encode($statement -> fetchAll(PDO::FETCH_ASSOC));
    $pdo = null;
}catch (PDOException $e){
    echo '{"error": "API did not work: Check your querystring."}';
}

?>