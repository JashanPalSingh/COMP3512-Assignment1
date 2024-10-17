<?php
include "includes/header.inc.php";
include "includes/phpconfig.inc.php";
include "includes/footer.inc.php";
include "includes/function.inc.php";

?>
<!-- 
 The constructor (team) profile page. Gives users constructor statistics and 
 driver performance statistics based on their choice in the browse page.
 authors: Ishan Ishan, Jashan Pal Singh. -->

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
            <article id='constructorDetails'>
                <h2><b>Constructor Details</b></h2>

                <?php
                $sql= "SELECT `name`, nationality, `url` FROM constructors
                WHERE constructorRef= ?;";

                $data= getData($sql, $_GET['constructorRef']); 
                foreach ($data as $row) {
                    echo "<div class='constructorbig'><b>{$row['name']}</b></div>";
                    echo "<p><b>Nationality:</b> {$row['nationality']}</p><br>";
                    echo "<a href='{$row['url']}' class='decoratedlink'>View Constructor</a>";

                }
                ?>
            </article>
            <article>
            <fieldset><legend><h2><b>Race Results</b></h2></legend>

            <?php
                $sql= "SELECT races.round, races.raceId, races.name AS circuitName , drivers.forename, drivers.surname,drivers.driverRef, results.position, results.points FROM results
                        JOIN races ON races.raceId = results.raceId JOIN circuits ON races.circuitId = circuits.circuitId JOIN drivers ON
                        drivers.driverId = results.driverId JOIN constructors ON
                        constructors.constructorId = results.constructorId WHERE races.`year` = 2022 AND constructors.constructorRef=? ORDER BY races.round;";

                $data= getData($sql, $_GET['constructorRef']); 
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
                </fieldset>


            </article>
        </main>
        
        <?php createFooter();?>
    </body>
</html>