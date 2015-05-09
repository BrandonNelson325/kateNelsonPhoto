<?php
if (!$_SESSION) {
  session_start();
}
?>
<!--View For all Content-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="author" content= "Brandon Nelson">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, macimum-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/main.css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src='../js/galleriesjs.js'></script>
        <title><?php echo $title ?></title>
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
        <?php echo $larr;?>
        <?php echo $heading;?>
        <?php echo $content;?>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
    </footer>
    </body>
</html>
