<?php
/**
 * Includes file for our header element.
 * @author Jashan Pal Singh
 */
function createHeader(){
    echo "<header>";
    echo        "<a href='index.php'><img src='css/formula1logo.png' alt='Dashboard Homepage'></a> <!-- Image Sourcce: https://en.logodownload.org/formula-1-logo-f1-logo/ -->";
    echo        "<h1><a href='index.php' alt='Dashboard Homepage'><b> Dashboard Project </b></a></h1>";
    echo        "<nav>";
    echo            "<ul>";
    echo                "<li><a href='index.php'>HOME</a></li>";
    echo                "<li><a href='browse.php'> BROWSE </a></li>";
    echo                "<li><a href='api.php'>APIs</a></li>";
    echo            "</ul>";
    echo        "</nav>";
    echo    "</header>";
}

?>