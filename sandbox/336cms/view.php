<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <title>Home Page | Proof Site</title>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
 </head>
 <body>
  <section id="page">
  <header>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  </header>
 <main>
  <h1>Home Page</h1>
  <?php
  if (isset($message)) {
   echo "<p>$message</p>";
  }
  unset($message);
  ?>

  <p>This is the home page for the proof site.</p>
 </main>
 <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
  <p>Last updated: <?php echo date('j F, Y', getlastmod()) ?></p>
 </footer>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
 <script src="/javascript/jquery.validate.min.js"></script>
 <script src="/javascript/regrules.js"></script>
 </section>
</body>
</html>