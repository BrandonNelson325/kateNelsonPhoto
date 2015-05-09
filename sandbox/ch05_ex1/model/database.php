<?php
    $server = 'localhost';
    $username = 'katenels_iClient';
    $password = 'Nuttin123!@#';
    $database = 'katenels_guitar1';
    $dsn = "mysql:host=$server; dbname=$database";

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>