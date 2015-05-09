<?php

/*
 * People Controller
 * 
 */

 /* Get the library, which includes:
  *   Session start function call
  *   Navigation builder function
  *   Calls for product and people models
  */
require $_SERVER['DOCUMENT_ROOT'] . '/library/library.php';

// Check for and capture action name \ value pair
if (isset($_GET['action'])) {
 $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
 $action = $_POST['action'];
}

// Start checking for meaningful values in the action variable
switch ($action) {
// Get the register view
 case 'register':
  include 'view.php';
  break;

// Register a new client
 case 'registerme':
// get the data
  $firstname = valString($_POST['firstname']);
  $lastname = valString($_POST['lastname']);
  $email = valEmail($_POST['email']);
  $password = valString($_POST['password']);

  // clean, validate and notify if problems
  if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
   $message = 'All fields are required. Please provide the needed information.';
   include 'view.php';
   exit;
  }
  // Register the client, capture what is returned from model
  $password = hashPassword($password); // Function in library
  $regresult = registerClient($firstname, $lastname, $email, $password);

  // Check what got sent back and then notify the client
  if ($regresult == 1) {
   $message = 'Congrats, you are now registered.';
  } else {
   $message = 'Sorry, the registration failed.';
  }

  // Get a list of all clients then notify the client
  $clients = registeredClients();
  include 'view.php';
  break;

// Get the login view
 case 'login':
  include 'view.php';
  break;

// Login the client
 case 'logmein':
  // Get the data
  $email = valEmail($_POST['email']);
  $password = valString($_POST['password']);

  if (empty($email) || empty($password)) {
   $message = 'Sorry, the email and/or password is incorrect please check them and try again.';
   include 'view.php';
   exit;
  }

  // Hash the password
  $password = hashPassword($password); // Function in library
// Attempt to find match in database
  $clientInfo = loginClient($email, $password);

// If a user is found, do the login
  if (!empty($clientInfo)) {
   // login the user
   $_SESSION['firstname'] = $clientInfo[0]['client_fname'];
   $_SESSION['lastname'] = $clientInfo[0]['client_lname'];
   $_SESSION['email'] = $clientInfo[0]['client_email'];
   $_SESSION['userlevel'] = $clientInfo[0]['auth_userlevel'];
   $_SESSION['loggedin'] = TRUE;
   include 'view.php';
   exit;
  } else {
   $message = 'Sorry the login failed.';
   include 'view.php';
  }
  break;

// Logout the client
 case 'logout': {
   unset($_SESSION['firstname']);
   unset($_SESSION['lastname']);
   unset($_SESSION['email']);
   unset($_SESSION['userlevel']);
   unset($_SESSION['loggedin']);
   header('location:/');

   break;
  }
// Default behavior - Deliver the default view
 default:
  include 'view.php';
  break;
}
?>