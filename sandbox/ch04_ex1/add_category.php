<?php
// Get the product data
$category_id = $_POST['category_id'];
$name = $_POST['name'];

// Validate inputs
if ( empty($name)) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    // If valid, add the product to the database
    require_once('database.php');
    $query = "INSERT INTO products
                 (categoryID, productName)
              VALUES
                 ('$category_id', '$name')";
    $db->exec($query);

    // Display the Product List page
    include('index.php');
}
?>

