<?php
// Get access to the session
if(!$_SESSION){
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> | Data Test</title>
  </head>
  <body>
    <header>
      <h1>Data Test Site</h1>
    </header>
      <nav></nav>
  <main>
      <p>
    <?php
    
    if(isset($categories)){
    // Once the array is returned, display each item from tha array in a list
    $display = '<ul>';
    foreach ($categories as $category) {
        $display .= '<li>' . $category['categoryName'] . '</li>';
    }
//    for ($i = 0, $ii = count($categories); $i < $ii; $i++) {
//        $display .= '<li>' . $categories[$i]['categoryName'] . '<li>';
//        }
    $display .= '</ul>';
    echo $display;
    } else {
        echo 'yall doesnt even know what yas is dun';
    }
    ?>
      </p>
  </main>
  <footer>
    <p></p>
  </footer>
  </body>
</html>
