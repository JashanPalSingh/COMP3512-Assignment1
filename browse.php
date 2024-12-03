<?php
include "includes/header.inc.php";
include "includes/phpconfig.inc.php";
include "includes/footer.inc.php";
include "includes/function.inc.php";

?>

 <!-- The browse page provides a list of 2022 races, users can select a race which let's them see the 
 circuit stats, qualifies and race results with drivers and constructor names.
 authors: Ishan Ishan, Jashan Pal Singh -->

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
                        $data = getData('SELECT `round`, `name`, raceId FROM races WHERE races.`year` = 2022 ORDER BY `round`;', null);
                        echo "<table id='RaceTable'>";

                        echo "<tr>"; 
                        echo "<th>Rnd</th>"; 
                        echo "<th>Circuit</th>"; 
                        echo "</tr>";
                                                 
                        foreach ($data as $row){
                            echo "<tr>";
                            echo "<td>{$row['round']}</td>"; //Gave out parsing error initially
                            echo "<td>{$row['name']}</td>"; // Works when wrapped in curly brackets. Source: https://www.codecademy.com/learn/learn-php/modules/learn-php-variables/cheatsheet 
                            echo "<td><form action='./browse.php?' method='GET'><button type='submit' class='resultsButton' name='raceId' value={$row['raceId']}>Results</button></form></td>";                            
                            echo "</tr>";
                        };           

                        echo "</table>";

                    ?>
                </p>
            </article>
            <article id='browseResults'>
                <?php
                
                if (! isset($_GET['raceId'])) {
                    echo "<h1> <<< Select a Race</h1>";
                }
                

                if (isset($_GET['raceId'])){
                    $info = getData('SELECT ra.`round`, ra.`name` AS raceName, ra.raceId, ci.name AS circuitName, ci.location, ci.country, ra.date, ra.url 
                                    FROM races AS ra
                                    JOIN circuits AS ci
                                    ON ra.circuitId = ci.circuitId
                                    WHERE  ra.raceId =?;', $_GET['raceId']);
                    echo "<fieldset><legend class='constructorbig'><b>  {$info[0]['raceName']}  </b></legend>";
                    echo "<p>";
                    echo "<h3><b>Round:</b> {$info[0]['round']}<br></h3>";
                    echo "<h3><b>Circuit:</b> {$info[0]['circuitName']}<br></h3>";
                    echo "<h3><b>Location:</b> {$info[0]['location']}<br></h3>";
                    echo "<h3><b>Country:</b> {$info[0]['country']}<br></h3>";
                    echo "<h3><b>Date:</b> {$info[0]['date']}<br></h3>";
                    echo "<br>";
                    echo '<a href="'.$info[0]['url'].'" class="decoratedlink"> VIEW RACE</a>';
                    echo "<br>";
                    echo "<br>";
                    
                    echo "</fieldset>";
                    echo "<br>";
                    echo "</p>";

                    }
                ?>
                <div id="Qualifying">
                    <p>
                    <?php
                    if (isset($_GET['raceId'])){
                        $qualifying = getData("SELECT q.position, d.forename, d.surname, d.driverId, d.driverRef, c.name, c.constructorId, c.constructorRef, q.q1, q.q2, q.q3 FROM qualifying AS q 
                        JOIN drivers AS d ON q.driverId = d.driverId JOIN constructors AS c ON q.constructorId = c.constructorId 
                        JOIN races ON q.raceId = races.raceId WHERE races.raceId =? ORDER BY q.position;" ,$_GET['raceId']);

                        echo "<fieldset><legend><h1><b>  Qualifying  </b></h1></legend>";
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
                            echo "<td><a href='./driver.php?driverRef={$row['driverRef']}'>{$row['forename']} {$row['surname']}</a></td>";
                            echo "<td><a href='./constructor.php?constructorRef={$row['constructorRef']}'>{$row['name']}</a></td>";
                            echo "<td>{$row['q1']}</td>";
                            echo "<td>{$row['q2']}</td>";
                            echo "<td>{$row['q3']}</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<br>";
                        echo "</fieldset>";
                        echo "<br>";
                    }
                    ?>
                    </p>
                </div>
                <div id="Results">
                    <?php
                    if (isset($_GET['raceId'])){
                    $results = getData("SELECT re.position, dr.forename, dr.surname, dr.driverId, dr.driverRef, co.name, co.constructorRef , re.laps, re.points FROM results AS re JOIN drivers AS dr ON
                    re.driverId = dr.driverId JOIN constructors AS co ON co.constructorId = re.constructorId JOIN races ON 
                    races.raceId = re.raceId WHERE races.raceId =? ORDER BY re.position;", $_GET['raceId']);

                    echo "<fieldset><legend><h1><b>Results</b></h1></legend>";
                    echo "<div id='top3'>";
                        echo "<div class='rank'><h2><b><i>II</i><br> <a href='./driver.php?driverRef={$results[1]['driverRef']}'>{$results[1]['forename']} {$results[1]['surname']}</a></b></h2></div>";
                        echo "<div class='rank'><h2><b><i>I</i><br> <a href='./driver.php?driverRef={$results[0]['driverRef']}'>{$results[0]['forename']} {$results[0]['surname']}</a></b></h2></div>";
                        echo "<div class='rank'><h2><b><i>III</i><br> <a href='./driver.php?driverRef={$results[2]['driverRef']}'>{$results[2]['forename']} {$results[2]['surname']}</a></b></h2></div>";
                    echo "</div>";

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
                            echo "<td><a href='./driver.php?driverRef={$row['driverRef']}'>{$row['forename']} {$row['surname']}</a></td>";
                            echo "<td><a href='./constructor.php?constructorRef={$row['constructorRef']}'>{$row['name']}</a></td>";
                            echo "<td>{$row['laps']}</td>";
                            echo "<td>{$row['points']}</td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                    echo "</fieldset>";
                    }
                    ?>
                </div>
            </article>
        </main>
        
            
        <?php createFooter();?>
    </body>
</html>