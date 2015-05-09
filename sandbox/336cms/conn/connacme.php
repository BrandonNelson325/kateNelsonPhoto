<?php

/*
 * Basic Proxy User Connection to the database
 */

$database = 'dbname goes here';
$server = 'server name goes here';
$dsn = 'mysql:host='.$server.';dbname='.$database;
$username = 'basic proxy user name goes here';
$password = 'password goes here';

try {
 $db = new PDO($dsn, $username, $password);
} catch (PDOException $exc) {
 echo 'Connection failed';
 exit;
}
?>