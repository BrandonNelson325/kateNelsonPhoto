<?php

/* 
 * Function Exam model
 */
require $_SERVER['DOCUMENT_ROOT']. '/library/functions.php';


/*  Get the Guitar1 database connection before anything else */



/*
 * Write the first function using the following SQL to query the Guitar1 database
 
    $sql = 'SELECT DISTINCT products.categoryID, categoryName '
            . 'FROM products INNER JOIN categories '
            . 'WHERE products.categoryID = categories.categoryID';
 
 * Use a try - catch block to handle exceptions
 * Use a prepared statement inside the try to execute the query
 * The result of the query should be an array
 * Be sure to return the array if it has data or 'FALSE' if no data was retrieved
 */

function queryCategories(){
    $conn = guitar1Connection();
    
    try { 
    $sql = 'SELECT DISTINCT products.categoryID, categoryName '
            . 'FROM products INNER JOIN categories '
            . 'WHERE products.categoryID = categories.categoryID';
    $stmt = $link->prepare($sql);
    $stmt->execute();
    // Retrieve the data
 $category = $stmt->fetch();

// Close the prepared statement
 $stmt->closeCursor();
 
// See if data was returned or not,
// respond accordingly
 if(!empty($category)){
  return $category; // Data retrieved
 } else {
  return 0; // Nothing retrieved
 }
} catch (PDOException $e) {
  return 0; // indicates a failure
}
}
 

/* 
 * Write the second function following this comment block
 
 * The function should be named "buildNav" and retrieve the needed 
 * information by calling the first function.
 
 * Then, the function should build an unordered list
 * placing each item retrieved from the database in an anchor element in a list item.
 * The entire list should be stored in a variable named $navigation.
 
 * If nothing is retrieved from the database, use the same $navigation variable 
 * to store an error message.
 
 * Finally, return $navigation (it was called in the controller).
 */

function buildNav (){
    $retrieve = queryCategories();
    if(is_array($retrieve)){
    $navigation = '<ul>';

    foreach ($retrieve as $key => $value) {
        $navigation .= "<li><a href=".$value['categoryID'].">". $value['categoryID'] . "</a></li>";
        
    }
    $navigation .= '<ul>';
    return $navigation;
    } else {
        echo 'Sorry, didnt work';
    }
    
}
echo buildNav();