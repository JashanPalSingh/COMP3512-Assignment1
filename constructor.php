<?php
include "includes/header.inc.php";
include "includes/phpconfig.inc.php";

function getConstructor($SQL, $param){
    try{
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $statement = $pdo -> prepare($SQL);
        $statement -> bindValue(1, $param);
        $statement -> execute();
        $pdo = null;
        return $statement -> fetchAll();
    } catch (PDOException $e){
        echo "error : Function did not work";
    }
}


?>

<html lang="en">
    <head>
        <title>F1 Dashboard</title>
        <link rel="stylesheet" type="text/css" href= "css/generalstyle.css">
        <link rel="stylesheet" type="text/css" href= "css/otherstyle.css">
        <meta charset="utf-8">
        <meta name="description" content="Assignment #1 for COMP3512 at Mount Royal University">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!--SOURCE:  https://fonts.google.com/selection?classification=Display&stroke=Sans+Serif-->
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php createHeader() ?>
        <main id="main">
            <article>
                <h2><b>Constructor Details</b></h2>

                <?php
                $sql= "SELECT `name`, nationality, `url` FROM constructors
                WHERE constructorRef= ?;";

                $data= getConstructor($sql, $_GET['constructorRef']); 
                foreach ($data as $row) {
                    echo "<p><b>Name:</b> {$row['name']}</p>";
                    echo "<p><b>Nationality:</b> {$row['nationality']}</p><br>";
                    echo "<a href='{$row['url']}' class='decoratedlink'>View Constructor</a>";

                }
                ?>
            </article>
            <article>
            <h2><b>Race Results</b></h2>

            <?php
                $sql= "SELECT races.round, races.raceId, races.name AS circuitName , drivers.forename, drivers.surname,drivers.driverRef, results.position, results.points FROM results
                        JOIN races ON races.raceId = results.raceId JOIN circuits ON races.circuitId = circuits.circuitId JOIN drivers ON
                        drivers.driverId = results.driverId JOIN constructors ON
                        constructors.constructorId = results.constructorId WHERE races.`year` = 2022 AND constructors.constructorRef=? ORDER BY races.round;";

                $data= getConstructor($sql, $_GET['constructorRef']); 
                ?>
                <table class="interactiveTable">
                    <tr>
                        <th>Round</th>
                        <th>Circuit</th>
                        <th>Driver</th>
                        <th>Position</th>
                        <th>Points</th>
                    </tr>
                    <?php
                    foreach ($data as $row){
                        echo "<tr>";
                        echo "<td>{$row['round']}</td>";
                        echo "<td><a href='http://localhost/jsing785/browse.php?raceId={$row['raceId']}'>{$row['circuitName']}</a></td>";
                        echo "<td><a href='http://localhost/jsing785/driver.php?driverRef={$row['driverRef']}'>{$row['forename']} {$row['surname']}</a></td>";
                        if ($row['position'] == null) {
                            echo "<td>DNF</td>";
                        } else {
                            echo "<td>{$row['position']}</td>";
                        }
                        echo "<td>{$row['points']}</td>";
                        echo "</tr>";

                    } 
                        
                    ?>
                    
                    </table>



            </article>
        </main>
    </body>
</html>