<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert a category name</title>
    </head>

    <body>
        <?php
        if (isset($message)) {
            echo '<h1>Insert Result</h1>';
            echo '<p>' . $message . '</p>';
        } else {
            // will show if there are errors
            if ($error) {
                $display = '<p>' .$error . '</p>';
                echo $display;
            }
        
        ?>


         <h1>New Category</h1><br>
              <form id = "newcatform" method="post" action=".">
            <fieldset>
                      <label for="catname">Category Name:</label>
                      <input type="text" name="catname" id="catname"required value="<?php echo $catName ?>"><br>
                      <label for="action">&nbsp;</label>
                      <input type="submit" name="action" value="Add Category" id="action"><br>
                    </form>
            </fieldset>
        </form>
        
        <a href=".?action=edit&amp;id=3" title="edit item 3">Edit Drums</a>
        <?php
        }
        ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </body>
</html>