<?php

/*
 * model for the content
 */

//get the library so we have the DB connection.
require $_SERVER['DOCUMENT_ROOT'] . '/library/functions.php';

function categoryName($catname) {

    $conn = guitar1Connection();


    try {
// Insert the first 3 variables using a prepared statement
        $sql = "INSERT INTO categories
         (categoryName)  
         VALUES (:name)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':name', $catname, PDO::PARAM_STR);

        // will return 1, 0, or -1
        $result = $stmt->execute();
        //rowcount();
        //$categoryId = $conn->lastInsertId();

        $stmt->closeCursor();
    } catch (PDOException $e) {
        $message = "PDO error in model.";
    }

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function getCategoryItem($id) {
   $conn = guitar1Connection();

    try {
        $sql = 'SELECT categoryID, categoryName 
                FROM categories 
                WHERE categoryID = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getTraceAsString();
    }
    if (is_array($data)) {
        return $data;
    } else {
        return FALSE;
    }
}

function updateCategory($catid, $catname) {
    $conn = guitar1Connection();

    try {
        $sql = 'UPDATE categories 
                SET categoryName = :catname
                WHERE categoryID = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $catid, PDO::PARAM_INT);
        $stmt->bindValue(':catname', $catname, PDO::PARAM_STR);
        $stmt->execute();
        $updateresult = $stmt->rowCount();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getTraceAsString();
    }
    if($updateresult){
        return TRUE;
    } else {
        return FALSE;
    }
}
