<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <title><?php echo $products[0][2].' Products';  ?> | Acme Site</title>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
 </head>
 <body>
  <section id="page">
  <header>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  </header>
 <main>
  <?php
  if (isset($message)) {
   echo "<p class='notice'>$message</p>";
  }
  unset($message);
  ?>
<?php
if(!empty($products)){
  echo '<h1>'.$products[0][2].' Products Page</h1>';
echo '<ul id="product-list">';
foreach ($products as $product) {
  echo '<li><a href="/products?prodid='.$product[0].'" title="View the '.$product[1].' details page">'.$product[1].'</a></li>';
}
echo '</ul>';
} elseif (!empty ($product)) {
 echo '<h1>'. $product[1] .'</h1>';
 echo "<p>".$product['inv_description']."</p>";

}
?>
  

 </main>
 <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
  <p>Last updated: <?php echo date('j F, Y', getlastmod()) ?></p>
 </footer>
 </section>
</body>
</html>