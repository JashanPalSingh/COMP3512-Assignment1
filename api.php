<?php
include "includes/header.inc.php";

?>

<html lang="en">
    <head>
        <title>F1 Dashboard</title>
        <link rel="stylesheet" type="text/css" href= "css/apistyle.css">
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
                <h2><b>API List</b></h2>

            <table>
                <tr>
                    <th>URL</th>
                    <th>Description</th>
                </tr>

                <tr>
                <td><a href="api/circuits.php" >api/circuits.php</a></td>
                <td>Returns all the circuits for the season</td>
                </tr>

                <tr>
                <td><a href="api/circuits.php?ref=monaco" >api/circuits.php?ref=monaco</a></td>
                <td>Returns just the specific circuit</td>
                </tr>

                <tr>
                <td><a href="api/constructors.php" >api/constructors.php</a></td>
                <td>Returns all the constructors for the season</td>
                </tr>

                <tr>
                <td><a href="api/constructors.php?ref=red_bull" >api/constructors.php?ref=red_bull</a></td>
                <td>Returns just the specific circuit</td>
                </tr>

                <tr>
                <td><a href="api/drivers.php" >api/drivers.php</a></td>
                <td>Returns all the drivers for the season</td>
                </tr>

                <tr>
                <td><a href="api/drivers.php?ref=max_verstappen" >api/drivers.php?ref=max_verstappen</a></td>
                <td>Returns just the specified driver</td>
                </tr>

                <tr>
                <td><a href="api/drivers.php?race=1074" >api/drivers.php?race=1074</a></td>
                <td>Returns the drivers within a given race</td>
                </tr>

                <tr>
                <td><a href="api/races.php" >api/races.php</a></td>
                <td>Returns the races within the 2022 season</td>
                </tr>

                <tr>
                <td><a href="api/races.php?ref=1074" >api/races.php?ref=1074</a></td>
                <td>Returns just the specified race</td>
                </tr>

                <tr>
                <td><a href="api/qualifying.php?ref=1074" >api/qualifying.php?ref=1074</a></td>
                <td>Returns the qualifying results for the specified race</td>
                </tr>

                <tr>
                <td><a href="api/results.php?ref=1074" >api/results.php?ref=1074</a></td>
                <td>Returns the results for the specified race</td>
                </tr>

                <tr>
                <td><a href="api/results.php?driver=max_verstappen" >api/results.php?driver=max_verstappen</a></td>
                <td>Returns all the results for a given driver</td>
                </tr>

                
            </table>

            </article>
        </main>
    </body>
</html>