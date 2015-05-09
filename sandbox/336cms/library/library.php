<?php

/*
 * Custom Functions Library
 */


// Create or provide session access
session_start();

// Get the Products model to build the site navigation 
require $_SERVER['DOCUMENT_ROOT'].'/products/model.php';

// Get the People model for ease of access if needed 
require $_SERVER['DOCUMENT_ROOT'].'/people/model.php';

// Custom function for string neutralization
function valString($string) {
$string = htmlspecialchars($string, ENT_QUOTES);
 return $string;
}

// Custom function for email sanitizing and validation
function valEmail($email) {
 $email = filter_var($email, FILTER_SANITIZE_EMAIL);
 $email = filter_var($email, FILTER_VALIDATE_EMAIL);
 return $email;
}

// Custom function for double sanitizing and validation
function valFloat($value){
  $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $value = filter_var($value, FILTER_VALIDATE_FLOAT, decimal);
  return $value;
}

// Custom function for integer sanitizing and validation
function valInteger($value){
  $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
  $value = filter_var($value, FILTER_VALIDATE_INT);
  return $value;
}

// Custom function for email hashing
function hashPassword($password){
 $password = crypt($password, '$1$67Six! yT');
 return $password;
}

// Custom function for building site navigation
function buildNavigation(){
 $categories = getCategories();
    $_SESSION['categories'] = $categories;
}

// Call to build the navigation bar
// Actually assembled in the header module
buildNavigation();

?>