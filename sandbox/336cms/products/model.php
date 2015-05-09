<?php

session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// Get the normal connection object
try {
  require $_SERVER['DOCUMENT_ROOT'] . '/conn/connacme.php';
} catch (Exception $e) {
  $message = 'Sorry, the database is on break. Please check back in 15 minutes.';
  $_SESSION['message'] = $message;
  header('location: /errors/');
  exit;
}

// Get the Admin connection object
try {
  require $_SERVER['DOCUMENT_ROOT'] . '/conn/connacmeadmin.php';
} catch (Exception $e) {
  $message = 'Sorry, the database is on break. Please check back in 15 minutes.';
  $_SESSION['message'] = $message;
  header('location: /errors/');
  exit;
}

// Get a list of categories, used for site navigation
function getCategories() {
  global $database;
  global $db;

  try {
    $sql = 'SELECT category_id, category_name FROM ' . $database . '.categories';

    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    $stmt->closeCursor();
    return $categories;
  } catch (Exception $e) {
    $message = 'Sorry, the database is on break. Please check back in 15 minutes.';
    $_SESSION['message'] = $message;
    header('location: /errors/');
  }
}

// Get a list of products by category
function getProducts($action) {
  global $database;
  global $db;

  $sql = "SELECT inv_id, inv_name, category_name FROM inventory, categories WHERE inventory.category_id = :categoryid AND inventory.category_id = categories.category_id";


  try {
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':categoryid', $action);
    $stmt->execute();
    $products = $stmt->fetchall();
    $stmt->closeCursor();
    return $products;
  } catch (Exception $e) {
    echo 'error';
    exit;
  }
}

// Get a list of all products
function getAllProducts() {
  global $database;
  global $db;

  $sql = "SELECT inv_id, inv_name, category_name FROM inventory, categories WHERE inventory.category_id = categories.category_id";


  try {
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchall();
    $stmt->closeCursor();
    return $products;
  } catch (Exception $e) {
    echo 'error in get all products call';
    exit;
  }
}

// Get a product's information
function getProductDetail($prodid) {
  global $database;
  global $db;

  $sql = "SELECT inv_id, inv_name, inv_description, inv_price, inv_stock, inv_location, inv_vendor, category_name FROM $database.inventory, $database.categories WHERE inventory.inv_id = :productid AND inventory.category_id = categories.category_id";


  try {
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':productid', $prodid);
    $stmt->execute();
    $productDetail = $stmt->fetch();
    $stmt->closeCursor();
    return $productDetail;
  } catch (Exception $e) {
    echo 'error';
    exit;
  }
}

// Add new product
function addProduct($itemcategory, $itemname, $itemdescription, $itemprice, $itemstock, $itemlocation, $itemvendor) {
  global $database;
  global $db;

  $sql = "INSERT INTO $database.inventory (inv_name, inv_description, inv_price, inv_stock, inv_location, inv_vendor, category_id) VALUES (:itemname, :itemdescription, :itemprice, :itemstock, :itemlocation, :itemvendor, :itemcategory)";
  try {
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':itemname', $itemname);
    $stmt->bindValue(':itemdescription', $itemdescription);
    $stmt->bindValue(':itemprice', $itemprice);
    $stmt->bindValue(':itemstock', $itemstock);
    $stmt->bindValue(':itemlocation', $itemlocation);
    $stmt->bindValue(':itemvendor', $itemvendor);
    $stmt->bindValue(':itemcategory', $itemcategory);
    $stmt->execute();
    $insertresult = $stmt->rowCount();
    $stmt->closeCursor();
    return $insertresult;
  } catch (Exception $e) {
    echo 'error with insert';
  }
}


// Update an Existing Product
function updateProduct($itemid, $itemname, $itemdescription, $itemprice, $itemstock, $itemlocation, $itemvendor, $itemcategory){
  global $database;
  global $db;
  
  $sql = "UPDATE $database.inventory SET inv_name=:itemname, inv_description=:itemdescription, inv_price=:itemprice, inv_stock=:itemstock, inv_location=:itemlocation, inv_vendor=:itemvendor, category_id=:itemcategory WHERE inv_id=:itemid";
  
  try {
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':itemname', $itemname);
    $stmt->bindValue(':itemdescription', $itemdescription);
    $stmt->bindValue(':itemprice', $itemprice);
    $stmt->bindValue(':itemstock', $itemstock);
    $stmt->bindValue(':itemlocation', $itemlocation);
    $stmt->bindValue(':itemvendor', $itemvendor);
    $stmt->bindValue(':itemcategory', $itemcategory);
    $stmt->bindValue(':itemid', $itemid);
    $stmt->execute();
    $updateresult = $stmt->rowCount();
    $stmt->closeCursor();
    return $updateresult;
  } catch (Exception $e) {
    echo 'Error with update';
  }

}

// Delete an Existing Product - Must be a DB Admin to do this
function deleteProduct($itemid){
  global $databaseadmin;
  global $dbadmin;
  
  $sql = "DELETE FROM $databaseadmin.inventory WHERE inv_id=:itemid";
  
  try {
    $stmt = $dbadmin->prepare($sql);
    $stmt->bindValue(':itemid', $itemid);
    $stmt->execute();
    $deleteresult = $stmt->rowCount();
    $stmt->closeCursor();
    return $deleteresult;
  } catch (Exception $e) {
    echo 'Error with delete';
  }

}
?>