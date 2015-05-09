<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset= "utf-8">
        <title>Tool Check Page</title>
    </head>
    <body>
        <header>
            <h1>KateNelsonPhoto.com</h1>
        </header>
    <main>
        <h1>Brandon Nelson</h1>
        <h1>Input Form</h1>
    <form method="post" action=".">
      <label for="firstname">First Name:</label>
      <input type="text" name="firstname" id="firstname">
      <label for="lastname">Last Name:</label>
      <input type="text" name="lastname" id="lastname">
      <label for="url">URL:</label>
      <input type="url" name="url" id="url">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email">
      <label for="submit">&nbsp;</label>
      <input type="submit" name="submit" value="Send It">
    </form>
    </main>
    <footer>
        <p><?php echo $today = date("m.d.y");?></p>
    </footer>
    </body>
</html>

