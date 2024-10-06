<?php
include "includes/header.inc.php";


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
                        //  $jsonData = file_get_contents("api/races.php");
                        //  $data = json_decode($jsonData);

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
            <article>
                Select a race
            </article>
        </main>
    </body>
</html>