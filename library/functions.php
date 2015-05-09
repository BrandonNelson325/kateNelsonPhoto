<?php

/* 
 * Functions Library
 */
function guitar1Connection(){
    $server = 'localhost';
    $username = 'katenels_iClient';
    $password = 'Nuttin123!@#';
    $database = 'katenels_guitar1';
    $dsn = "mysql:host=$server; dbname=$database";
    
try{
    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $ex) {
    echo 'Sorry the connection could not be built<br>';
}

if(is_object($conn)) {
    return $conn;
}
else {
    return FALSE;
}
}

function dbConnection(){
    $server   = 'localhost';
    $username = 'katenels_iClient';
    $password = 'Nuttin123!@#';
    $database = 'katenels_photo';
    $dsn      = "mysql:host=$server; dbname=$database";
    
try{
    $conn_test = new PDO($dsn, $username, $password);
} catch (PDOException $ex) {
    echo 'Sorry the connection could not be built<br>';
}

if(is_object($conn_test)) {
    return $conn_test;
}
else {
    return FALSE;
}
}


function arrayConvert($array){

$convert;
$i = 0;
foreach ($array as $item){
    $convert .= "<ul> <a href= \"$item[$i]\">" . $item . "</a> </ul>";
    $i++;
    }
    return $convert;
}
$array = array('Drums','Guitars','Pianos','Trumpets');
//echo arrayConvert($array);

function hashPassword($password){
    $passwordhashed = crypt($password, '$5$rounds=5000$buildsomesaltforme$');
    return $passwordhashed;
}

function timesByFive($x){
    $result = $x *5;
    return $result;
}

function valString($string){
    $string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    return $string;
}
function valEmail($string){
    $email = filter_var($string, FILTER_SANITIZE_EMAIL);
    return $email;
}
function comparePassword($passwordhashed, $hashedPassword){
    if($passwordhashed == $hashedPassword[1]){
        return TRUE;
    }else {
        return FALSE;
    }
}
