<?php
include "includes/header.inc.php";
include "includes/phpconfig.inc.php";

function getRaces($SQL){
    try{
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $statement = $pdo -> prepare($SQL);
        $statement -> execute();
        $pdo = null;
        return $statement -> fetchAll();
    } catch (PDOException $e){
        echo "error : Function did not work";
    }
}


function getRace($SQL, $param){
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
        <title>2022 Season</title>
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
                <h2><b>2022 Races</b></h2>
                <p>
                    <?php
                        $data = getRaces('SELECT `round`, `name`, raceId FROM races WHERE races.`year` = 2022 ORDER BY `round`;');
                        echo "<table id='RaceTable'>";

                        echo "<tr>"; 
                        echo "<th>Rnd</th>"; 
                        echo "<th>Circuit</th>"; 
                        echo "</tr>";
                                                 
                        foreach ($data as $row){
                            echo "<tr>";
                            echo "<td>{$row['round']}</td>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td><form action='http://localhost/jsing785/browse.php?' method='GET'><button type='submit' class='resultsButton' name='raceId' value={$row['raceId']}>Results</button></form></td>";                            
                            echo "</tr>";
                        };           

                        echo "</table>";

                    ?>
                </p>
            </article>
            <article id='browseResults'>
                <?php
                if (isset($_GET['raceId'])){
                    $info = getRace('SELECT ra.`round`, ra.`name` AS raceName, ra.raceId, ci.name AS circuitName, ci.location, ci.country, ra.date, ra.url 
                                    FROM races AS ra
                                    JOIN circuits AS ci
                                    ON ra.circuitId = ci.circuitId
                                    WHERE  ra.raceId =?;', $_GET['raceId']);
                    echo "<h1><b>{$info[0]['raceName']}</b></h1>";
                    echo "<p>";
                    echo "<h3><b>Round:</b> {$info[0]['round']}<br></h3>";
                    echo "<h3><b>Circuit:</b> {$info[0]['circuitName']}<br></h3>";
                    echo "<h3><b>Location:</b> {$info[0]['location']}<br></h3>";
                    echo "<h3><b>Country:</b> {$info[0]['country']}<br></h3>";
                    echo "<h3><b>Date:</b> {$info[0]['date']}<br></h3>";
                    echo "<br>";
                    echo '<a href="'.$info[0]['url'].'" class="decoratedlink"> VIEW RACE</a>';
                    echo "</p>";

                    }
                ?>
                <div id="Qualifying">
                    <p>
                    <?php
                    if (isset($_GET['raceId'])){
                        $qualifying = getRace("SELECT q.position, d.forename, d.surname, d.driverId, c.name, c.constructorId, q.q1, q.q2, q.q3 FROM qualifying AS q 
                        JOIN drivers AS d ON q.driverId = d.driverId JOIN constructors AS c ON q.constructorId = c.constructorId 
                        JOIN races ON q.raceId = races.raceId WHERE races.raceId =? ORDER BY q.position;" ,$_GET['raceId']);

                        echo "<h1><b>Qualifying</b></h1>";
                        echo "<table class='interactiveTable'>";
                        echo "<tr>";
                        echo "<th>Pos</th>";
                        echo "<th>Driver</th>";
                        echo "<th>Constructor</th>";
                        echo "<th>Q1</th>";
                        echo "<th>Q2</th>";
                        echo "<th>Q3</th>";
                        echo "</tr>";
                        foreach ($qualifying as $row){
                            echo "<tr>";
                            echo "<td>{$row['position']}</td>";
                            echo "<td><a href=''>{$row['forename']} {$row['surname']}</a></td>";
                            echo "<td><a href=''>{$row['name']}</a></td>";
                            echo "<td>{$row['q1']}</td>";
                            echo "<td>{$row['q2']}</td>";
                            echo "<td>{$row['q3']}</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    ?>
                    </p>
                </div>
                <div id="Results">
                    <?php
                    if (isset($_GET['raceId'])){
                    $results = getRace("SELECT re.position, dr.forename, dr.surname, dr.driverId , co.name, co.constructorId , re.laps, re.points FROM results AS re JOIN drivers AS dr ON
                    re.driverId = dr.driverId JOIN constructors AS co ON co.constructorId = re.constructorId JOIN races ON 
                    races.raceId = re.raceId WHERE races.raceId =? ORDER BY re.position;", $_GET['raceId']);

                    echo "<h1><b>Results</b></h1>";
                    echo "<h2><b>First: <a href=''>{$results[0]['forename']} {$results[0]['surname']}</a></b></h2>";
                    echo "<h2><b>Second: <a href=''>{$results[1]['forename']} {$results[1]['surname']}</a></b></h2>";
                    echo "<h2><b>Third: <a href=''>{$results[2]['forename']} {$results[2]['surname']}</a></b></h2>";

                    echo "<table class='interactiveTable'>";
                        echo "<tr>";
                        echo "<th>Pos</th>";
                        echo "<th>Driver</th>";
                        echo "<th>Constructor</th>";
                        echo "<th>Laps</th>";
                        echo "<th>Points</th>";
                        echo "</tr>";
                        foreach ($results as $row){
                            echo "<tr>";
                            if ($row['position'] == null) {
                                echo "<td>DNF</td>";
                            } else {
                                echo "<td>{$row['position']}</td>";
                            }                            
                            echo "<td><a href=''>{$row['forename']} {$row['surname']}</a></td>";
                            echo "<td><a href=''>{$row['name']}</a></td>";
                            echo "<td>{$row['laps']}</td>";
                            echo "<td>{$row['points']}</td>";
                            echo "</tr>";
                        }
                    echo "</table>";

                    }
                    ?>
                </div>
            </article>
        </main>
    </body>
</html>