<?php 
/**
 * API that returns circuit information in JSON format.
 * @author Ishan Ishan
 */


require_once ('../includes/config.inc.php');
header('content-type: application/json');
header("Access-Control-Allow-Origin: *");
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    
    if (! isset ($_GET['ref'])) {
        $SQL = 'SELECT c.circuitId, c.circuitRef, c.name
        FROM circuits c
        JOIN races r ON c.circuitId = r.circuitId
        WHERE r.year = 2022;';
        
        $statement = $pdo -> prepare($SQL);
        $statement -> execute();
    } else {
        $SQL = 'SELECT c.circuitId, c.circuitRef, c.name
        FROM circuits c
        JOIN races r ON c.circuitId = r.circuitId
        WHERE r.year= 2022 AND c.circuitRef= ?;';
        
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