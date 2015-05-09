
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
    <header>
    </header>
      <nav></nav>
      <main>

<?php
/* 
 * The data controller
 */
require '../basics/view.php';

if(isset($_GET['firstname'])){
    $firstName = $_GET['firstname'];
} elseif($_POST['firstname']) {
    $firstName = $_POST['firstname'];
} 
if(isset($_GET['lastname'])){
    $lastName = $_GET['lastname'];
} elseif($_POST['lastname']) {
    $lastName = $_POST['lastname'];
} 
if(isset($_GET['url'])){
    $url = $_GET['url'];
} elseif($_POST['url']) {
    $url = $_POST['url'];
} 
if(isset($_GET['email'])){
    $email = $_GET['email'];
} elseif($_POST['email']) {
    $email = $_POST['email'];
} 

$input = array( "$firstName"
, "$lastName"
, "$url"
, "$email");

?>

</main>
      
</html>
