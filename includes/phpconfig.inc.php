<?php
/**
 * Defines connection for our php pages. Different from our API connection because of file structure.
 * @author Ishan Ishan, Jashan Pal Singh
 */

define('DBHOST', 'localhost');
define('DBNAME', 'f1');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBCONNSTRING','sqlite:./data/f1.db');
// define('DBCONNSTRING',"mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4;");
?>