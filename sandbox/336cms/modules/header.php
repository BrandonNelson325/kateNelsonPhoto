<a href="/" title="Visit the Acme home page for more great roadrunner catching products"><img src="/images/acme-logo.jpg" alt="Acme Roadrunner catching products for coyotes who want to eat Site Logo"></a>
<h1>Acme Inc.</h1>
<div id="tools">
 <?php
 if(!$_SESSION['loggedin']){ ?>
 <a href="/people?action=register" title="Register with the Acme web site">Register</a> | <a href="/people?action=login" title="Login to the Acme web site">Login</a>
 <?php } else { ?>
 <span>Welcome, <?php echo $_SESSION['firstname'] ?></span>
 <a href="/people?action=logout" title="Log me out">Log Out</a>
         
        <?php }?>
</div>
<nav>
 <ul>
  <li><a href="/" title="Visit the Acme home page">Home</a></li>
  <?php
// Check for administrator rights, if found add Admin Tool to navigation, otherwise just build the regular navigation
  if($_SESSION['loggedin'] && $_SESSION['userlevel'] > 1){
   echo "<li><a href='/admin/' title='Go to the Acme Administration page'>Admin</a></li>";
  }
  $categories = $_SESSION['categories'];
  foreach ($categories as $category) {
   echo "<li><a href='/products?action=$category[0]' title='Visit the Acme $category[1] product page'>$category[1]</a></li>";
  }
  ?>
 </ul>
</nav>