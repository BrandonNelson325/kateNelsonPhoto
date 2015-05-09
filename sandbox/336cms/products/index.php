<?php

/*
 * Product Controller
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

// Check for and capture product name \ value pair
if (isset($_GET['prodid'])) {
 $prodid = $_GET['prodid'];
} elseif (isset($_POST['prodid'])) {
 $prodid = $_POST['prodid'];
}

// action represents product categories
// prodid represents a particular product
if ($action > 0) {
 $products = getProducts($action);
} elseif ($prodid > 0) {
 $product = getProductDetail($prodid);
} else {
 if (empty($products) || empty($product)) {
  $message = 'I cannot seem to find what you were looking for.';
 }
}

// Single point of exit
// Add some default content from the database to show on the page
include 'view.php';
exit;
?>