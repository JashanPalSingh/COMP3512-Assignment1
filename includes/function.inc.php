<?php
/**
 * One function to return everything on our dashboard.
 * Takes a sql string and a parameter (if given)
 * returns an array of data to be displayed.
 * @author Jashan Pal Singh.
 */
function getData($SQL, $param){
    try{
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $statement = $pdo -> prepare($SQL);
        if(isset($param)){
        $statement -> bindValue(1, $param);
        }
        $statement -> execute();
        $pdo = null;
        return $statement -> fetchAll();
    } catch (PDOException $e){
        echo "error : Function did not work";
    }
}

?>