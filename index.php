<?php
include "includes/header.inc.php";
include "includes/footer.inc.php";
?>

 <!-- Homepage of our dashboard. Allows users to see the github repo or proceed to see the 2022 season in 
 browse page.
 authors: Ishan Ishan, Jashan Pal Singh. -->
<html lang="en">
    <head>
        <title>F1 Dashboard</title>
        <link rel="stylesheet" type="text/css" href= "css/generalstyle.css">
        <meta charset="utf-8">
        <meta name="description" content="Assignment #1 for COMP3512 at Mount Royal University">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!--SOURCE:  https://fonts.google.com/selection?classification=Display&stroke=Sans+Serif-->
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> <!-- SOURCE: https://fonts.google.com/specimen/Urbanist -->
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php createHeader() ?>
        <main id="main">
            <article>
                <h2><b>Description</b></h2>
                <p>
                    This site provides you with the information about the 2022 F1 season. You can browse the season's race results, constructor details, as well as the driver statistics. 
                </p>
                <p>    
                    This project was created by Ishan Ishan and Jashan Pal Singh as their Assignment 1 studying COMP3512 at the Mount Royal University taught by Professor Randy Conolly.
                </p>
                <p>
                    You can access our GitHub repository for this project below
                </p>
                <br>
                <br>
                <div id="Homepagelinks">
                <a href="https://github.com/JashanPalSingh/COMP3512-Assignment1" id="viewrepo" target="_blank"> View Repo</a>
                <br><br><br><br>
                <a href="browse.php" id="browsepage"> Browse 2022 Season</a>
                </div>
            </article>
            <article id="show">
                <img src="css/Background.PNG" width="100%"/> <!-- image source: https://wallpapercave.com/w/wp12663282 -->
            </article>
        </main>
        <?php createFooter();?>
    </body>
</html>