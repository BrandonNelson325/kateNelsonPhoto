<!DOCTYPE html>

<html lang="en">
  <head>
    <title>PHP Basics Exam</title>
    <meta charset="UTF-8">
    <meta name="author" contents="Brandon Nelson">
    <style>
      label, input{
        display: block;
      }
      input{
        margin-bottom: 15px;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>PHP Basics</h1>
    </header>
  <main>
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
  <?php
  
  if (isset($input)){
  echo '<h2>Customer<h2>';
  echo 'First Name is: '. $input[0];
  echo 'Last Name is: ' . $input[1];
  echo 'URL is: ' . $input[2];
  echo 'email is:' . $input[3];
  }
?>
  <footer>
    <p><?php echo 'Last Updated: '.date('j F, Y',  getlastmod()); ?></p>
  </footer>
  </body>
</html>