<?php
/* ***************************************
 * DB and SQL Exam model
 * **************************************/

/* ***************************************
 * Get access to the database connection
 * **************************************/
require '../library/functions.php';

$guitar1 = guitar1Connection();



/* ***************************************
 * Get navigation items from database
 * **************************************/
function getNavigation() {
   $guitar1 = guitar1Connection();
  try {
    $sql = 'SELECT DISTINCT products.categoryID, categoryName '
            . 'FROM products INNER JOIN categories '
            . 'WHERE products.categoryID = categories.categoryID';
    $stmt = $guitar1->prepare($sql);
    $stmt->execute();
    $navList = $stmt->fetchAll();
    $stmt->closeCursor();
  } catch (PDOException $exc) {
    header('location: ./error.php');
    exit;
  }
  if (!empty($navList)) {
    return $navList;
  } else {
    return FALSE;
  }
}

/* ***************************************
 * Get the list of items by category
 * **************************************/
function getCategoryItems($category) {
  $guitar1 = guitar1Connection();

  try {
      $sql = 'SELECT categoryID,categoryName
              FROM katenels_guitar1.categories
              WHERE categoryName = :category
              ORDER BY categoryID';
      $stmt = $guitar1->prepare($sql);
      $stmt->bindValue(':category', $category, PDO::PARAM_STR);
      $stmt->execute();
      $catinfo = $stmt->fetchAll();
      $stmt->closeCursor();
  } catch (Exception $ex) {
    header('location: ./error.php');
    exit;
  }
  if(!empty($catinfo)){
    return $catinfo;
  } else{
    return FALSE;
  }
}

/* ***************************************
 * Get item based on its key
 * **************************************/
function getItem($productid) {
    $guitar1 = guitar1Connection();

  try {
      $sql = 'SELECT productID, categoryID, productCode, productName, listPrice
              FROM katenels_guitar1.products
              WHERE productID = :productid';
      $stmt = $guitar1->prepare($sql);
      $stmt->bindValue(':productid', $productid, PDO::PARAM_INT);
      $stmt->execute();
      $productinfo = $stmt->fetchAll();
      $stmt->closeCursor();
  } catch (Exception $ex) {
    header('location: ./error.php');
    exit;
  }
  if(!empty($productinfo)){
    return $productinfo;
  } else{
    return FALSE;
  }
}

/* ***************************************
 * Build the navigation menu list
 * **************************************/
function buildNav(){
  $navItems = getNavigation();
  if(is_array($navItems)){
    $navigation = '<ul>';
    foreach ($navItems as $item) {
      $navigation .= "<li><a href='/dbsqlexam?action=q&amp;category=$item[0]' title='View our $item[1]'>$item[1]</a></li>";
    }
    $navigation .= '</ul>';
  } else {
    $navigation = 'Sorry, a critical error occurred.';
  }
  return $navigation;
}