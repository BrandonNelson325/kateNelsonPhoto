<?php
if (!$_SESSION) {
  session_start();
}
?>
<!--view for the login-->
<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content= "Brandon Nelson">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, macimum-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/main.css"/>
        <title>Login | Register</title>
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
        </header>
    <main>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        } else {
            if ($errors) {
                $loop = '<ul id="error">';
                foreach ($errors as $value) {
                    $loop.= '<i>' . $value . '</li>';
                }
                $loop .= '</ul>';
            }
        }
        ?>
        <form id="registration" method="post" action=".">
            <fieldset id="people">
                <span class="regspan">Register</span><br>
                <label for="firstname">First Name:</label><br>
                <input type="text" name="firstname" id="firstname" required value = "<?php echo $firstname ?>"><br>
                <label for="lastname">Last Name:</label><br>
                <input type="text" name="lastname" id="lastname" required><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required placeholder="Enter a Valid E-mail"><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required><br>
                <label for="password">Re-Enter Password:</label><br>
                <input type="password" name="password2" id="password2" required><br>
<!--                <label for="secqtn">Secret Question:</label><br>
                <input type="text" name="secqtn" id="secqtn" required><br>
                <label for="secans">Secret Answer:</label><br>
                <input type="text" name="secans" id="secans" required><br>
-->             <label for="submit">&nbsp;</label><br>
                <input type="submit" name="submit" value="Register"><br>
            </fieldset>
        </form>
        <form class="login" method="post" action=".">
            <fieldset>
                <span class="regspan">Login</span><br>
            <label for="emaillog">Email:</label><br>
            <input type="email" name="emaillog" id="email" required placeholder="Enter a Valid E-mail"><br>
            <label for="password">Password:</label><br>
            <input type="password" name="passwordlog" id="password" required><br>
            <label for="submit">&nbsp;</label><br>
            <input type="submit" name="submit" value="Login"><br>
            </fieldset>
        </form>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/registrationrules.js"></script>
</body>

</html>
