<?php

/*
 * Administration Controller
 */

/* Get the library, which includes:
 *   Session start function call
 *   Navigation builder function
 *   Calls for product and people models
 */
require $_SERVER['DOCUMENT_ROOT'] . '/library/library.php';

// Make sure the user is an administrator (level 2 or 3)
if ($_SESSION['userlevel'] < 2) {
  header('location: /');
  exit;
}

// Check for and capture action name \ value pair
if (isset($_GET['action'])) {
  $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
  $action = $_POST['action'];
}


if ($action == 'view_products') {
  /*   * **********************************************************
   * Handle request to view all products
   * ********************************************************** */

  // Call the getAllProducts function from the admin model
  // store the results (an multidimensional array) in $products
  $products = getAllProducts();

  // Check to make sure products were received
  if (empty($products)) {
    $message = 'Sorry, no products could be found.';
  }
  // Single point of exit to the view
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Handle request to view all people
 * ********************************************************** */ 

elseif ($action == 'view_people') {


//  The registeredClients function is in the people model
  $people = registeredClients();

  if (empty($people)) {
    $message = 'Sorry, no people can be found in the system.';
  }
  // Single point of exit to the view
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Handle request to add a new product by providing the form
 * ********************************************************** */ 

elseif ($action == 'new_product') {


  $task = 'new-product';
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Add a new product to inventory
 * ********************************************************** */ 

elseif ($action == 'add-product') {


  $itemcategory = valInteger($_POST['categorytype']);
  $itemname = valString($_POST['itemname']);
  $itemdescription = valString($_POST['itemdescription']);
  $itemprice = valFloat($_POST['itemprice']);
  $itemstock = valInteger($_POST['itemstock']);
  $itemlocation = valString($_POST['itemlocation']);
  $itemvendor = valString($_POST['itemvendor']);

// Check data
  if (empty($itemcategory) || empty($itemname) || empty($itemdescription) || empty($itemprice) || empty($itemstock) || empty($itemlocation) || empty($itemvendor)) {
    $message = 'One or more of the required fields is incorrect. Please correct the error and submit again.';
    $task = 'new-product'; // Allows the form to be displayed
    include 'view.php';
    exit;
  }
  // Send the data for insertion - function in products model
  $addresult = addProduct($itemcategory, $itemname, $itemdescription, $itemprice, $itemstock, $itemlocation, $itemvendor);

  if (!$addresult) {
    $message = 'Sorry the new product could not be added.';
  } else {
    $message = $itemname . ' was added successfully.';
  }
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Handle request to edit a product by providing the data in a form
 * ********************************************************** */ 

elseif ($action == 'edit') {


  $itemid = valInteger($_GET['id']);
  $iteminfo = getProductDetail($itemid); // Function in product model
  if (empty($iteminfo)) {
    $message = 'No item information could be found.';
  }
  $task = 'Edit Product'; // Shows the edit form in the view
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Update the exiting product
 * ********************************************************** */ 

elseif ($action == 'update-product') {


  $itemcategory = valInteger($_POST['categorytype']);
  $itemname = valString($_POST['itemname']);
  $itemdescription = valString($_POST['itemdescription']);
  $itemprice = valFloat($_POST['itemprice']);
  $itemstock = valInteger($_POST['itemstock']);
  $itemlocation = valString($_POST['itemlocation']);
  $itemvendor = valString($_POST['itemvendor']);
  $itemid = valInteger($_POST['itemid']);

  // Check data
  if (empty($itemcategory) || empty($itemname) || empty($itemdescription) || empty($itemprice) || empty($itemstock) || empty($itemlocation) || empty($itemvendor) || empty($itemid)) {
    $message = 'One or more of the required fields is incorrect. Please correct the error and submit again.';
    // Create the iteminfo array, but with the submitted values instead of those from the database
    $iteminfo = array($itemid, $itemname, $itemdescription, $itemprice, $itemstock, $itemlocation, $itemvendor, $itemcategory);
    $task = 'Edit Product'; // Allows the form to be displayed
    include 'view.php';
    exit;
  }

  // Call update function in Products model
  $updateresult = updateProduct($itemid, $itemname, $itemdescription, $itemprice, $itemstock, $itemlocation, $itemvendor, $itemcategory);

  // Report the result of the update
  if (!$updateresult) {
    $message = 'Sorry, but the ' . $itemname . ' was not updated.';
  } else {
    $message = $itemname . ' was updated successfully.';
  }
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Handle request to delete a product - send confirmation info
 * Note: This process is almost identical to an edit call
 * ********************************************************** */ 

elseif ($action == 'delete') {

  $itemid = valInteger($_GET['id']);
  $iteminfo = getProductDetail($itemid);
  $task = 'Delete Product';
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Delete a product
 * Note: This process is almost identical to an update call
 * ********************************************************** */ 

elseif ($action == 'delete-product') {

  $itemid = valInteger($_POST['itemid']);
  $deleteresult = deleteProduct($itemid); // In the products model
  // Report the result of the delete
  if (!$deleteresult) {
    $message = 'Sorry, but the product was not deleted.';
  } else {
    $message = 'The delete was successful.';
  }

  include 'view.php';
  exit;
}

/* * **********************************************************
 * Handle edit person request, deliver form
 * ********************************************************** */ 

 elseif ($action == 'edit_person') {
  $personid = valInteger($_GET['id']);
  $clientinfo = getClient($personid); // In People model
  if(empty($clientinfo)){
    $message = 'Sorry, no matching information was found.';
  }
  $task = 'Edit Person';
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Handle update person request
 * ********************************************************** */ 

 elseif ($action == 'update-client') {
  $clientid = valInteger($_POST['clientid']);
  $clientfirst = valString($_POST['clientfirstname']);
  $clientlast = valString($_POST['clientlastname']);
  $clientemail = valEmail($_POST['clientemail']);
  $clientlevel = valInteger($_POST['clientuserlevel']);
  $clientcomment = valString($_POST['clientcomment']);
  $clientjoindate = valString($_POST['clientjoindate']);
  
  // Check data
  if(empty($clientid) || empty($clientfirst) || empty($clientlast) || empty($clientemail) || empty($clientlevel)){
    $message = 'One or more required fields are empty. Please provide required information.';
    // put client data back into an array of same name and order as original data
    $clientinfo = array($clientid,$clientfirst,$clientlast, $clientemail,$clientjoindate,$clientcomment,$clientlevel);
    $task = 'Edit Person';
  include 'view.php';
  exit;
  }
  
  $updateresult = updateClient($clientid, $clientfirst, $clientlast, $clientemail, $clientcomment, $clientlevel); // In People model

  if(!$updateresult){
    $message = "Sorry, $clientfirst $clientlast could not be updated.";
  } else {
    $message = "$clientfirst $clientlast was updated successfully.";
  }
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Handle Delete request, deliver form for confirmation
 * ********************************************************** */ 

 elseif ($action == 'delete_person') {
   $clientid = valInteger($_GET['id']);
   $clientinfo = getClient($clientid);
  $task = 'Delete Person';
  include 'view.php';
  exit;
}

/* * **********************************************************
 * Delete client - Requires admin level
 * ********************************************************** */ 

 elseif ($action == 'delete-client') {
   $clientid = $_POST['clientid'];
   $deleteresult = deleteClient($clientid);
   if(!$deleteresult){
     $message = 'Sorry, the client deletion failed.';
   } else {
     $message = 'The deletion succeeded.';  
   }
   include 'view.php';
   exit;
}

/* * **********************************************************
 * No specific request, deliver the view as default action
 * ********************************************************** */ 

else {


  include 'view.php';
  exit;
}
?>