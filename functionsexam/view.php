<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Functions Exam View</title>
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
    </style>
  </head>
  <body>
    <header><h1>Functions Exam View</h1></header>
    <nav>
      <?php
      echo $navigation;
      ?>
    </nav>
  <main>
    <p>No real content for this view. We are looking to see if the navigation bar was built.</p>
  </main>
  <footer>
    <p><?php echo 'Last updated: ' . date('j F, Y \a\t h:i a ', getlastmod()); ?></p>
  </footer>
</body>
</html>
