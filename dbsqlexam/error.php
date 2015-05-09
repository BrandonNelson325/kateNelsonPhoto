<?php
if(!$_SESSION){
  session_start();
}
$navigation = $_SESSION['navigation'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Error View</title>
    <style>
      nav ul{
        list-style: none;
        font-size: 120%;
        margin: 0;
        padding: 0;
      }
      nav li{
        display: inline;
        width: 15em;
        padding: 0 5px;
      }
    </style>
  </head>
  <body>
    <header><h1>Database and SQL Exam</h1></header>
    <nav>
      <?php
      echo $navigation;
      ?>
    </nav>
  <main>
    <h1>Error Page</h1>
    <p>Sorry, the process you requested could not be completed due to an error.</p>
  </main>
  <footer>
    <p><?php echo 'Last updated: ' . date('j F, Y \a\t h:i a ', getlastmod()); ?></p>
  </footer>
</body>
</html>
