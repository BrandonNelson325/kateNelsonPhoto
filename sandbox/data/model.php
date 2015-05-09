<?php
/* 
 * The data model
 */

// Get access to the custom functions library
require $_SERVER['DOCUMENT_ROOT'].'/sandbox/library/functions.php';

//Get the list of product categories in the Guitar1 database
function getProductCategories(){
  // Get the connection object from the connection function
  $conn = guitar1Connection();
  
  // The sql to get the product categories from the database
  $sql = 'SELECT * FROM categories ORDER BY categoryID';
  try{
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errormessage = 'Sorry, there was an error with the database.';
  }
  // Find out if you got results
  if(is_array($categories)){
    return $categories;
  } else {
    return FALSE;
  }
}