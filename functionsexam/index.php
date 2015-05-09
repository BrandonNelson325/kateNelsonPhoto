<?php

/* 
 * Controller for the Functions Exam
 */

// Bring the model.php page into the scope of the controller
require 'model.php';


$sunday = 'I love resting';
$monday = 'Back to work';

if($sunday === $monday){
  // This shouldn't do anything
} else {
// call the function from the model
  $navigation = buildNav();
  include 'view.php';
  exit;
}