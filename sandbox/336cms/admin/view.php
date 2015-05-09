<?php
session_start();
// Make sure the user is an administrator (level 2 or 3)
if ($_SESSION['userlevel'] < 2) {
  header('location: /');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Administration | Acme Site</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
    <style>
      textarea{
        min-width: 15em;
        width: 60%;
        min-height: 10em;
      }

      input.big-button{
        font-size: 150%;
        height: 2em;
        padding: .5em;
        margin-top: 1em;
      }

      .deletebox{
        background-color: #000; 
        color: #fff; 
        padding: .5em;
      }

      .deletebox li{
        padding: .25em 0;
      }
    </style>
  </head>
  <body>
    <section id="page">
      <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
      </header>
      <main>
        <h1>Administration Page</h1>
        <p>Choose an option below:</p>
        <ul class="admin-list">
          <li><a href=".?action=view_products" title="View and administer Acme Products">Administer Products</a></li>
          <li><a href=".?action=new_product" title="Add a new product">Add New Product</a></li>
          <li><a href=".?action=view_people" title="View and administer Acme People">Administer People</a></li>
        </ul>

        <?php
        if (isset($message)) {
          echo "<p class='notice'>$message</p>";
        }
        unset($message);
        ?>

        <?php
        if (!empty($products)) {
          // Display the list of products
          /*
           * The products array is a multidimensional array (currently with 17 items) that looks like this:
           * Array ( 
           * [0] => Array ( [inv_id] => 9 [0] => 9 [inv_name] => Large Anvil [1] => Large Anvil 
           * [category_name] => Drop [2] => Drop ) 
           * [1] => Array ( [inv_id] => 10 [0] => 10 [inv_name] => Medium Anvil [1] => Medium Anvil 
           * [category_name] => Drop [2] => Drop )) 
           */
          echo '<h2>Acme Products List - [products offered: ' . count($products) . ']</h2>';
          echo '<table id="product-list">';
          echo '<tbody>';
          $counter = count($products); // how many items in the array
          for ($i = 0; $i < $counter; $i++) {
            echo '<tr>';
            // Show the product name
            echo '<td>' . $products[$i][1] . '</td>';

            // Show the edit link
            echo '<td><a href=".?action=edit&amp;id=' . $products[$i][0] . '" title="Edit the ' . $products[$i][1] . '">Edit <span>' . $products[$i][1] . '</span></a></td>';

            // Show the delete link - only for an Administrator level 3
            if ($_SESSION['userlevel'] == 3) {
              echo '<td><a href=".?action=delete&amp;id=' . $products[$i][0] . '" title="Delete the ' . $products[$i][1] . '">Delete <span>' . $products[$i][1] . '</span></a></td>';
            }
            echo '</tr>';
          }
          echo '</tbody>';
          echo '</table>';
        } elseif (!empty($people)) {
          // Display the list of registered people
          /*
           *  The people array is a multidemensional array organized list this:
           * Array (
           * [0] => Array ( [client_id] => 5 [0] => 5 [client_fname] => Andrew [1] => Andrew 
           * [client_lname] => K [2] => K )
           * [1] => Array ( [client_id] => 8 [0] => 8 [client_fname] => Ian [1] => Ian 
           * [client_lname] => Martin [2] => Martin ))
           */

          echo '<h2>Registered People - Total: ' . count($people) . '</h2>';
          echo '<table id="people-list">';
          echo '<tbody>';
          foreach ($people as $person) {
            echo '<tr>';
            echo "<td>$person[1] $person[2]</td>";

            // Show the edit link
            echo '<td><a href=".?action=edit_person&amp;id=' . $person[0] . '" title="Edit ' . $person[1] . ' ' . $person[2] . '">Edit <span>' . $person[1] . ' ' . $person[2] . '</span></a></td>';

            // Show the delete link - only for an Administrator level 3
            if ($_SESSION['userlevel'] == 3) {
              echo '<td><a href=".?action=delete_person&amp;id=' . $person[0] . '" title="Delete ' . $person[1] . ' ' . $person[2] . '">Delete <span>' . $person[1] . ' ' . $person[2] . '</span></a></td>';
            }

            echo '</tr>';
          }
          echo '<tbody>';
          echo '</table>';
        } elseif ($task == 'new-product') {
          // Adding a new product
          echo '<h2>Add A New Product</h2>';
          echo '<p class="info">All fields are required</p>';
          echo '<form method="post" action="." id="new_product_form">';
          echo '<fieldset>';
          echo '<label for="categorytype">Category:</label>';
          echo '<select name="categorytype" id="categorytype">';
          echo "<option value='0'>Select a Category</option>";
          $categories = $_SESSION['categories'];
          foreach ($categories as $category) {
            echo "<option value='$category[0]'";
            if ($itemcategory == $category[0]) {
              echo ' selected ';
            }
            echo ">$category[1]</option>";
          }
          echo '</select>';
          echo '<label for="itemname">Name:</label>';
          echo '<input type="text" name="itemname" id="itemname" value="' . $itemname . '" size="30" required autofocus>';
          echo '<label for="itemdescription">Description:</label>';
          echo '<textarea name="itemdescription" id="itemdescription" required>' . $itemdescription . '</textarea>';
          echo '<label for="itemprice">Price:</label>';
          echo '<input type="text" name="itemprice" id="itemprice" value="' . $itemprice . '" size="8" required>';
          echo '<label for="itemstock">Stock:</label>';
          echo '<input type="text" name="itemstock" id="itemstock" value="' . $itemstock . '" size="3" required>';
          echo '<label for="itemlocation">Location:</label>';
          echo '<input type="text" name="itemlocation" id="itemlocation" value="' . $itemlocation . '" size="15" required>';
          echo '<label for="itemvendor">Vendor</label>';
          echo '<input type="text" name="itemvendor" id="itemvendor" value="' . $itemvendor . '" size="30" required>';
          echo '<label for="submit">&nbsp;</label>';
          echo '<input type="submit" name="submit" id="submit" value="Add Product">';
          echo '<input type="hidden" name="action" value="add-product">';
          echo '</fieldset>';
          echo '</form>';
        } elseif ($task == 'Edit Product') {
          // Edit an Existing Product ********************************
          /*
           * The iteminfo array looks like this:
           * Array ( [inv_id] => 9 [0] => 9 [inv_name] => Large Anvil [1] => Large Anvil [inv_description] => 50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel. [2] => 50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel. [inv_price] => 150 [3] => 150 [inv_stock] => 15 [4] => 15 [inv_location] => San Jose [5] => San Jose [inv_vendor] => Steel Made [6] => Steel Made [category_name] => Drop [7] => Drop ) 
           */

          echo "<h2>Edit $iteminfo[1]</h2>";
          echo '<p class="info">All fields are required</p>';
          echo '<form method="post" action="." id="edit_product_form">';
          echo '<fieldset>';
          echo '<label for="categorytype">Category:</label>';
          echo '<select name="categorytype" id="categorytype">';
          echo "<option value='0'>Select a Category</option>";
          $categories = $_SESSION['categories'];
          foreach ($categories as $category) {
            echo "<option value='$category[0]'";
            if ($iteminfo[7] == $category[1] || $iteminfo[7] == $category[0]) {
              echo ' selected ';
            }
            echo ">$category[1]</option>";
          }
          echo '</select>';
          echo '<label for="itemname">Name:</label>';
          echo '<input type="text" name="itemname" id="itemname" value="' . $iteminfo[1] . '" size="30" required autofocus>';
          echo '<label for="itemdescription">Description:</label>';
          echo '<textarea name="itemdescription" id="itemdescription" required>' . $iteminfo[2] . '</textarea>';
          echo '<label for="itemprice">Price:</label>';
          echo '<input type="text" name="itemprice" id="itemprice" value="' . $iteminfo[3] . '" size="8" required>';
          echo '<label for="itemstock">Stock:</label>';
          echo '<input type="text" name="itemstock" id="itemstock" value="' . $iteminfo[4] . '" size="3" required>';
          echo '<label for="itemlocation">Location:</label>';
          echo '<input type="text" name="itemlocation" id="itemlocation" value="' . $iteminfo[5] . '" size="15" required>';
          echo '<label for="itemvendor">Vendor</label>';
          echo '<input type="text" name="itemvendor" id="itemvendor" value="' . $iteminfo[6] . '" size="30" required>';
          echo '<label for="submit">&nbsp;</label>';
          echo '<input type="submit" name="submit" id="submit" value="Update ' . $iteminfo[1] . '">';
          echo '<input type="hidden" name="action" value="update-product">';
          echo '<input type="hidden" name="itemid" value="' . $iteminfo[0] . '">';
          echo '</fieldset>';
          echo '</form>';
        }

        /*         * ****************************************************
         * Delete Product View
         * Display data prior to the delete for confirmation purposes
         * Do not display if admin is not level 3
         * **************************************************** */ 
        
        elseif ($task == 'Delete Product') {

          if ($_SESSION['userlevel'] == 3) {
            echo '<h2>Delete ' . $iteminfo[1] . ' Confirmation</h2>';
            echo '<p class="notice">Deletions are permenant! Proceed only if authorized.</p>';
            echo '<ul class="deletebox">';
            echo '<li><strong>Product Name:</strong> ' . $iteminfo[1] . '<li>';
            echo '<li><strong>Product Description:</strong> ' . $iteminfo[2] . '<li>';
            echo '<li><strong>Product Stock:</strong> ' . $iteminfo[4] . '<li>';
            echo '<li>
            <form action="." method="post">
            <fieldset>
            <input type="submit" name="submit" value="Delete ' . $iteminfo[1] . '" class="big-button">
            <input type="hidden" name="action" value="delete-product">
            <input type="hidden" name="itemid" value="' . $iteminfo[0] . '">
            </fieldset>
            </form>
            <li>';
            echo '</ul>';
          } else {
            echo '<h2>Improper Authorization</h2>';
          }
        } elseif ($task == 'Edit Person') {
          /*
           * The returned array should look like this:
           * Array ( 
           * [0] => 26 
           * [1] => John 
           * [2] => Smith 
           * [3] => john.smith@336.edu 
           * [4] => 2013-07-10 17:42:14 date added
           * [5] => optional client comments
           * [6] => 1 userlevel) 
           */
          ?>

          <h2>Edit <?php echo "$clientinfo[1] $clientinfo[2]"; ?></h2>
          <p class="notice">Remember, at least one change must happen for an update to succeed.</p>
          <form method="post" action="." id="edit_client_form">  
            <fieldset> 
              <label for="clientfirstname">First Name:</label>  
              <input type="text" name="clientfirstname" id="clientfirstname" value="<?php echo $clientinfo[1] ?>" required> 
              <label for="clientlastname">Last Name:</label>  
              <input type="text" name="clientlastname" id="clientlastname" value="<?php echo $clientinfo[2] ?>" required>
              <label for="clientemail">Email:</label>  
              <input type="email" name="clientemail" id="clientemail" value="<?php echo $clientinfo[3] ?>" required>  
              <label for="clientuserlevel">User Level:</label> 
              <select name="clientuserlevel" id="clientuserlevel" size="3" required>
                <option value="1" <?php if ($clientinfo[6] == 1) {
          echo 'selected';
        } ?>>1</option>
                <option value="2" <?php if ($clientinfo[6] == 2) {
          echo 'selected';
        } ?>>2</option>
                <option value="3" <?php if ($clientinfo[6] == 3) {
          echo 'selected';
        } ?>>3</option>
              </select>
              <label for="clientcomment">Comments:</label> 
              <textarea name="clientcomment" id="clientcomment"><?php echo $clientinfo[5] ?></textarea>
              <label for="clientjoindate">Registered:</label>  
              <input type="text" name="clientjoindate" id="clientjoindate" value="<?php echo $clientinfo[4] ?>" readonly>
              <input type="submit" name="submit" value="Update <?php echo $clientinfo[1].' '.$clientinfo[2] ?>">  
              <input type="hidden" name="action" value="update-client">  
              <input type="hidden" name="clientid" value="<?php echo $clientinfo[0] ?>"> 
            </fieldset> 
          </form> 


         <?php } elseif ($task == 'Delete Person') {
           /*         * ****************************************************
         * Delete Client View
         * Display data prior to the delete for confirmation purposes
         * Do not display if admin is not level 3
         * **************************************************** */ 

           if ($_SESSION['userlevel'] == 3) {
            echo '<h2>Delete ' . $clientinfo[1].' '.$clientinfo[2] . ' Confirmation</h2>';
            echo '<p class="notice">Deletions are permenant! Proceed only if authorized.</p>';
            echo '<ul class="deletebox">';
            echo '<li><strong>Name:</strong> ' . $clientinfo[1].' '.$clientinfo[2] . '<li>';
            echo '<li><strong>Email:</strong> ' . $clientinfo[3] . '<li>';
            echo '<li><strong>User Level:</strong> ' . $clientinfo[6] . '<li>';
            echo '<li>
            <form action="." method="post">
            <fieldset>
            <input type="submit" name="submit" value="Delete ' . $clientinfo[1].' '.$clientinfo[2] . '" class="big-button">
            <input type="hidden" name="action" value="delete-client">
            <input type="hidden" name="clientid" value="' . $clientinfo[0] . '">
            </fieldset>
            </form>
            <li>';
            echo '</ul>';
          } else {
            echo '<h2>Improper Authorization</h2>';
          }
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