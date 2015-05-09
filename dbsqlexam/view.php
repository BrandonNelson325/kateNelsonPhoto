<?php
if (!$_SESSION) {
  session_start();
}

$navigation = $_SESSION['navigation'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>DB and SQL Exam View</title>
    <meta name="author" content="Brandon Nelson">
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
      
      main a span{
        position: absolute;
        left: -1000px;
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
    <?php
    echo $content;
    ?>
  </main>
  <footer>
    <p><?php echo 'Last updated: ' . date('j F, Y \a\t h:i a ', getlastmod()); ?></p>
  </footer>
</body>
</html>
