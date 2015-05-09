<?php

/*
 * Main Controller @ site root
 * 
 */

 /* Get the library, which includes:
  *   Session start function call
  *   Navigation builder function
  *   Calls for product and people models
  */
require $_SERVER['DOCUMENT_ROOT'] . '/library/library.php';


// Check for and capture action name \ value pair
if(isset($_GET['action'])){
 $action = $_GET['action'];
} elseif (isset ($_POST['action'])) {
 $action = $_POST['action'];
}

// Start checking for meaningful values in the action variable
switch ($action) {

 case 'something':
break;

 default:
  include 'view.php';
  break;
}
?>