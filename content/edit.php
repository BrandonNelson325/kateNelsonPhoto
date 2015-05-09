<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset= "utf-8">
        <title>update form</title>
    </head>
    <body>
        <header>
            <h1>Update an item</h1>
        </header>
    <main>
    <form method="post" action="." id="editdataform">
        <legend>Update User Information</legend>
      <label for="catname">change category name:</label>
      <input type="text" name="catname" id="catname" size="10" value="<?php echo $edituser[0]?>">
      <label for="submit">&nbsp;</label>
      <input type="submit" name="action" value="edit">
    </form>
    </main>
    <footer>
        <p><?php echo $today = date("m.d.y");?></p>
    </footer>
    </body>
</html>

