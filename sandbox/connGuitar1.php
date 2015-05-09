<?php

/* 
 * Connect to the guitar1
 *
 */
//Standard connection method

$server = 'localhost';
$username = 'katenels_iClient';
$password = 'Nuttin123!@#';
$database = 'katenels_guitar1';
$dsn = "mysql:host=$server; dbname=$database";

try{
    $connGuitar1 = new PDO($dsn, $username, $password);
} catch (PDOException $exc) {
    echo 'Sorry the connection could not be built<br>';
}

if(is_object($connGuitar1)) {
    echo 'It WORKSSS!!!!';
}
else {
    echo 'you lose!!!';
}
    
