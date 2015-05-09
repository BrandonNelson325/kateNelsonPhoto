<?php
/* ***************************************
 * Controller for the DB and SQL Exam
 * **************************************/

/* ***************************************
 * Create or access the session
 * **************************************/
 if(!$_SESSION){
 	session_start();
 }
/* ***************************************
 * Bring the model into scope
 * *************************x*************/
 include 'model.php';
 
/* ***************************************
 * Build the navigation menu and store in the session
 * **************************************/
$navigation = buildNav();
$_SESSION['navigation'] = $navigation;

/* ***************************************
 * Capture the value of 'action' from get or post
 * **************************************/
if (isset($_POST['action'])) {
  $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
  $action = $_GET['action'];
}

/* ***************************************
 * Determine if a request for a category has occurred
 * **************************************/
if ($action == 'q' && isset($_GET['category'])) {
  $category = $_GET['category'];
  $catinfo = getCategoryItems($category);
  if(is_array($catinfo)){
    $content = '<h1>'.$catinfo[0]['categoryName'].'</h1>';
      $content .= '<dl>';
      foreach ($catinfo as $item) {
        $content .= '<dt>'.$item['productName'].'</dt>';
        $content .= '<dd><a href="/dbsqlexam/?action=q&amp;item='.$item['productID'].'" title="Get more information about the '.$item['productName'].'">Learn more <span>about the '.$item['productName'].'</span></a></dd>';
      }
      $content .= '</dl>';
  } else {
    $content = 'Sorry, not items were found.';
  }
  include 'view.php';
  exit;
} elseif ($action == 'q' && isset($_GET['item'])) {
/* ***************************************
 * Determine if a request for a product has occurred
 * **************************************/
  $productid = $_GET['item'];
  $productinfo = getItem($productid);
  if(is_array($productinfo)){
    $content = '<h1>'.$productinfo[1].'</h1>';
    $content .= '<dl>';
     $content .= '<dt>List Price: '.number_format($productinfo[2], 2, '.', ',').'</dt>';
     $content .= '<dt><form method="post" action=".">';
     $content .= '<p><input type="submit" name="submit" value="Add to Cart">';
     $content .= '<input type="hidden" name="productid" value="'.$productinfo[0].'"></p>';
     $content .= '</form></dt>';
     $content .= '</dl>';
  } else {
    $content = 'Sorry, no item was returned.';
  }
  include 'view.php';
  exit;
} else {
/* ***************************************
 * Default delivery of the view
 * **************************************/
  include 'view.php';
  exit;
}