<?php
/* 
 * The data controller
 */

// Get access to the session
if(!$_SESSION){
  session_start();
}

// Get access to the model
require $_SERVER['DOCUMENT_ROOT'].'/sandbox/data/model.php';
// Get access to the custom functions library
//require $_SERVER['DOCUMENT_ROOT'].'/sandbox/library/functions.php';
// Collect the 'action' parameter from the client request
if(isset($_GET['action'])){
    $action = $_GET['action'];
} elseif($_POST['action']) {
    $action = $_POST['action'];
} else {
    $action = '';
}

if($action == 'yuioyuoi'){
  // An initial test which right now does nothing
} else {
  // if no previous test was true, this is the default action
  $categories = getProductCategories();
  include $_SERVER['DOCUMENT_ROOT'].'/sandbox/data/view.php';
  exit;
}