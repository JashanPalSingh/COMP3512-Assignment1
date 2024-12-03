<?php
include "includes/header.inc.php";
include "includes/phpconfig.inc.php";
include "includes/footer.inc.php";
include "includes/function.inc.php";

?>
<!-- 
 The driver profile page. Gives users driver statistics based on thei choice in the browse page.
 authors: Ishan Ishan, Jashan Pal Singh.
 -->

<html lang="en">
    <head>
        <title>Driver Profile</title>
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
            <article id="driverDetails">
                <h2><b>Driver Details</b></h2>

                <?php
                $sql= "SELECT DISTINCT d.'number', d.forename, d.surname, d.dob, d.nationality, d.url 
                FROM drivers d
                JOIN results r ON d.driverId = r.driverId
                JOIN races ra ON r.raceId = ra.raceId
                JOIN seasons s ON ra.year = s.year
                WHERE d.driverRef= ?;";

                $data= getData($sql, $_GET['driverRef']); 
                foreach ($data as $row) {
                    echo "<div class='big'><b>#{$row['number']}</b></div>";
                    echo "<p><h1>{$row['forename']} <b>{$row['surname']}</b></h1></p>";
                    echo "<p><b>Date of Birth:</b> {$row['dob']}</p>";
                    echo "<p><b>Nationality:</b> {$row['nationality']}</p><br>";
                    echo "<a href='{$row['url']}' class='decoratedlink'>View Profile</a>";

                }
                ?>
            </article>
            <article>
            <fieldset><legend><h2><b>Race Results</b></h2></legend>

            <?php
                $sql= "SELECT r.round, r.name AS raceName, r.raceId,  r.date, res.position, res.points
                FROM results res
                JOIN drivers d ON res.driverId = d.driverId
                JOIN constructors c ON res.constructorId = c.constructorId
                JOIN races r ON res.raceId = r.raceId
                WHERE d.driverRef = ? AND r.YEAR= 2022
                ORDER BY r.round ASC;";

                $data= getData($sql, $_GET['driverRef']); 
                ?>
                <table class="interactiveTable">
                    <tr>
                        <th>Round</th>
                        <th>Race Name</th>
                        <th>Date</th>
                        <th>Position</th>
                        <th>Points</th>
                    </tr>
                    <?php
                    foreach ($data as $row){
                        echo "<tr>";
                        echo "<td>{$row['round']}</td>";
                        echo "<td><a href='./browse.php?raceId={$row['raceId']}'>{$row['raceName']}</a></td>";
                        echo "<td>{$row['date']}</td>";
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