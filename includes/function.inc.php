<?php

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