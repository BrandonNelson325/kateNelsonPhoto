<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset= "utf-8">
        <title></title>
    </head>
    <body>
        <header>
            <h1>THIS IS THE HEADER</h1>
        </header>
    <main>
        <h1></h1>
        <?php
        require $_SERVER['DOCUMENT_ROOT'].'/library/functions.php';
        
        $conn = guitar1Connection();
        
        if(is_object($conn)) {
            echo 'The connection function for guitar1 database worked!!!';
        }
        else {
            echo 'The connection failed for guitar1';
        }
        ?>
        <br>
        <?php
        $conn2 = dbConnection();
        
        if(is_object($conn2)) {
            echo 'The connection function for the test database worked!!!';
        }
        else {
            echo 'The connection failed for the test database';
        }
        
        ?>
    </main>
    
    <footer>
        <p><?php echo $today = date("m.d.y");?></p>
    </footer>
    </body>
</html>