<?php
// Create or access the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <title><?php echo ucfirst($action)  ?> Page | Proof Site</title>
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
   echo "<p>$message</p>";
  }
  unset($message);
  ?>
  <?php if($action == 'register'){?>
   <h1>Registration Page</h1>
  <form method="post" action="." id="registerform">  
   <fieldset> 
    <label for="firstname">First Name:</label>  
    <input type="text" name="firstname" required id="firstname" value="<?php echo $firstname  ?>"><br>  
    <label for="lastname">Last Name:</label>  
    <input type="text" name="lastname" id="lastname" value="<?php echo $lastname  ?>"><br>  
    <label for="email">Email:</label>  
    <input type="email" name="email" required id="email" value="<?php echo $email  ?>"><br>  
    <label for="password">Password:</label>  
    <input type="password" name="password" id="password" placeholder="Use a fake password"><br>  
    <input type="submit" name="submit" value="Register">  
    <input type="hidden" name="action" value="registerme">  
   </fieldset> 
  </form> 
  <?php } elseif($action == 'login'){ ?>
   <h1>Login Page</h1>
  <form method="post" action="." id="loginform">
   <fieldset>
    <label for="email">Email:</label>  
    <input type="email" name="email" id="email" required placeholder="Email address is username"><br>  
    <label for="password">Password:</label>  
    <input type="password" name="password" id="password"><br>
    <input type="submit" name="submit" value="Login">  
    <input type="hidden" name="action" value="logmein"> 
   </fieldset>
  </form>
  <?php  } else { 
        echo '<h1>People Page</h1>';
   echo '<p>Please choose an option from the navigation or tools at the top of the page.</p>';
  }
?>
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