
<a href =".?action=home">
    <img id="logo-home" src="../photos/4t.png" alt="home logo image for Kate Nelson Photography.">
</a>
<?php include '../nav/nav.php'; ?>
<div id ="login-link">
    <?php
    if ($_SESSION['loggedin']) {
        echo 'Welcome ' . $_SESSION['personfirst'] . '! ';
        echo '<a href = "../login/manage.php">Edit  </a>';
        echo '| ';
        echo '<a href ="/home/?action=logout">Logout</a>';
    } else {
        echo '<a href = "/login/index.php">login/register</a>';
    }
    ?>
</div>
