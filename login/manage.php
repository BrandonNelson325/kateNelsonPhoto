<?php
if (!$_SESSION) {
  session_start();
}


$personid = $_SESSION['personid'];
$personfirst = $_SESSION['personfirst'];
$personlast = $_SESSION['personlast'];
$persontype = $_SESSION['persontype'];
$personemail = $_SESSION['personemail'];
$personpass = $_SESSION['perssonpass'];
$fullname = "$personfirst $personlast";
?>
<!--view for the manage page-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="author" content= "Brandon Nelson">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, macimum-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/main.css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src='../js/galleriesjs.js'></script>
        <title>Manage</title>
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
    <?php
    if ($_SESSION['loggedin']== TRUE){?>
        
        <h1 class="h12">Edit Personal Information:</h1>
        <ol>
            <li>Edit name and email: <a href=".?action=editpersonal">| Edit</a></li>
        </ol>
        <?php
        if ($_SESSION['persontype']== 1){?>
        <h1 class="h12">Edit Admin Content:</h1>
        <h3>Edit Users:</h3>
        <ol>
            <li>Delete User Accounts:<a href=".?action=deleteuser"> | Delete</a></li>
        </ol>
        <h3 class="h22">Edit Gallery Content:</h3>
        <ol>
        <li>Add an image to a gallery: <a href=".?action=addimage"> | Add</a></li>
        <li>Delete an image from a gallery: <a href=".?action=deleteimage"> | Delete</a></li>
        </ol>
        <h3 class="h22">Edit Content:</h3>
        <ol>
            <li>Edit Home Page <a href=".?action=edithome"> | Edit</a></li>
            <li>Edit Gallery Thumb Nails <a href=".?action=editgalleries"> | Edit</a></li>
            <li>Edit About Page <a href=".?action=editabout"> | Edit</a></li>
            <li>Edit Contact Page <a href=".?action=editcontact"> | Edit</a></li>
          <!--  <li>Edit Portraits Gallery <a href=".?action=editportraits"> | Edit</a></li>
            <li>Edit Couples Gallery <a href=".?action=editcouples"> | Edit</a></li>
            <li>Edit Family Gallery <a href=".?action=editfamily"> | Edit</a></li>
            <li>Edit Animals Gallery <a href=".?action=editanimals"> | Edit</a></li>
            <li>Edit Children Gallery <a href=".?action=editchildren"> | Edit</a></li>
            <li>Edit Nature Gallery <a href=".?action=editnature"> | Edit</a></li>
            <li>Edit Seniors Gallery <a href=".?action=editseniors"> | Edit</a></li>
            <li>Edit Still life Gallery<a href=".?action=editstill"> | Edit</a></li>
            <li>Edit Weddings Gallery <a href=".?action=editweddings"> | Edit</a></li>
            <li>Edit My Life Gallery <a href=".?action=editmylife"> | Edit</a></li>-->
            
        </ol>
       <?php }
    } ?>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
    </footer>
    </body>
</html>

