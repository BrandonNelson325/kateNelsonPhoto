<?php

if (!$_SESSION) {
    session_start();
}
//this is the one
$personid = $_SESSION['personid'];
$personfirst = $_SESSION['personfirst'];
$personlast = $_SESSION['personlast'];
$persontype = $_SESSION['persontype'];
$fullname = "$personfirst $personlast";
/*
 * Controller for the login info.
 */
//Bring the model into scope.
require 'model.php';

if ($_POST['submit'] == 'Register') {
    // Collect the data 
    $firstname = valString($_POST['firstname']);
    $lastname = valString($_POST['lastname']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];


    // Validate
    if (empty($firstname)) {
        $errors[] = 'Please provide a first name.';
    }
    if (!valEmail($email)) {
        $errors[] = 'Please provide a valid e-mail address.';
    }
    // Check error, return for fix if needed
    // Call the function in the model

    $passwordhashed = hashPassword($password);

    $result = regUser($firstname, $lastname, $email, $passwordhashed);

    // Check model return and display view.
    if ($result == 1) {
        $message = 'Wonderful, you are now registered, Please login to make any changes.';
    } else {
        $message = 'Sorry, the registration was unsuccesful';
    }
    include 'view.php';
    //echo "<a href='index.php'>Return to Registration Page</a>";
    exit;
} 
elseif ($_POST['submit'] == 'Login') {
    // Collect the data
    $email = valEmail($_POST['emaillog']);
    $password = valString($_POST['passwordlog']);
    
    if (empty($email)) {
        $errors[] = 'Please provide a first name.';
    }
    if (empty($password)) {
        $errors[] = 'Please provide the correct password address.';
    }

    $passwordhashed = hashPassword($password);


    $loginperson = userLogin($email, $passwordhashed);
    if ($loginperson) {
        echo 'Hello ' . $_SESSION['personfirst'] . ', You were successfully logged in!';
        include 'manage.php';
        exit;
    } else {
        $message = 'Sorry, the email or password were incorrect. Please try again.';
        include 'view.php';
        exit;
    }
    // Validate
    
} 
elseif ($_POST['submit'] == 'Update') {
    // Collect the data
    $personid = $_SESSION['personid'];
    $email = valEmail($_POST['email']);
    $password = valString($_POST['password']);
    $fname = valString($_POST['firstname']);
    $lname = valString($_POST['lastname']);

    $updateuser = updateUser($personid, $email, $password, $fname, $lname);

    if ($updateuser) {
        $message = 'Update was successful.';
    } else {
        $message = 'Sorry, update failed.';
    }
    include 'manage.php';
    exit;
}
elseif ($_POST['submit'] == 'Delete Account') {
    // Collect the data
    $personid = $_SESSION['personid'];

    $deleteuser = deleteUser($personid);

    if ($deleteuser) {
        $_SESSION['loggedin'] == FALSE;
        $message = 'Your account has been completely Deleted!';
    } else {
        $message = 'Sorry, delete failed.';
    }
    include 'view.php';
    exit;
}elseif($_GET['action'] == 'editpersonal'){
    $edit = '<form id="edit" method="post" action=".">';
    $edit .=        '<p class="alert">Must fill out or change password to submit.</p>';
    $edit .=         '<p class="alert">Must Change at least one item.</p>';
    $edit .=         '<fieldset id="edituser">';
    $edit .=             '<h3>Personal Info:</h3>';
    $edit .=             '<label for="firstname">First Name:</label><br>';
    $edit .=          '<input type="text" name="firstname" id="firstname" value = "'. $_SESSION['personfirst'].'"><br>';
    $edit .=             '<label for="lastname">Last Name:</label><br>';
    $edit .=             '<input type="text" name="lastname" id="lastname" value = "'.$_SESSION['personlast'].'"><br>'; 
    $edit .=         '</fieldset>';
    $edit .=         '<fieldset id="editcredentials">';
    $edit .=             '<h3>Credential Info:</h3>';
    $edit .=            '<label for="email">Email:</label><br>';
    $edit .=             '<input type="email" name="email" id="email" value="'.$_SESSION['personemail'].'"><br>';
    $edit .=             '<label for="password">Password:</label><br>';
    $edit .=             '<input type="password" name="password" id="password" required><br>';
    $edit .=             '<input type="hidden" name="pid" value="'.$_SESSION['personid'].'"><br>';
    $edit .=         '</fieldset>';
    $edit .=         '<input id="update" type="submit" name="submit" value="Update"><br><br>';
    $edit .=         '<input id="update" type="submit" name="submit" value="Delete Account"><br>';
    $edit .=         '<p class="alert">This will delete your account entirely!</p>';     
    $edit .=     '</form>';
    $title = 'Edit Personal Information';
    include 'edit.php';
    exit;
}elseif($_GET['action'] == 'deleteuser') {
    $users = getAllUsers();
    $edit = '<div id = gallerycontent>';
    $edit .= '<h2>Delete a User</h2>';
    if(is_array($users)){
        foreach ($users as $u){
    $edit .= '<form id="deleteuser" method="post" action=".">';
    $edit .= '<label for="user">'.$u['people_firstname'] .' '. $u['people_lastname'].' '. '</label>';
    $edit .= '<input type="hidden" name="id" value="'.$u['people_id'].'">';      ;
    $edit .= '<input type="submit" name="submit" value="Delete User"><br>';
    $edit .= '</form>';
        }
    }
    $edit .= '</div>';
    $title = 'Delete User';
    include 'edit.php';
    exit;
}elseif ($_POST['submit'] == 'Delete User') {
    // Collect the data
    $personid = $_POST['id'];
    $deleteuser = adminDelete($personid);

    if ($deleteuser) {
        $message = 'The Account has been deleted.';
    } else {
        $message = 'Sorry, the delete failed.';
    }
    include 'manage.php';
    exit;
}elseif($_GET['action'] == 'addimage') {
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>Add an Image to a Gallery:</h2>';
    $edit .= '<label for="name">Gallery Name: (Must be all lowercase with NO SPACES!)</label><br>';
    $edit .= '<input type="text" name="gallery" id="name"><br>';
    $edit .= '<label for="main">Image Path: (IE: milo.jpg)</label><br>';
    $edit .= '<input type="text" name="path" id="name"><br>';
    $edit .= '<input type="submit" name="submit" value="Add Image"><br>';
    $edit .= '</fieldset>';
    $edit .= '</form>';
    $title = 'Add Image';
    include 'edit.php';
    exit;
}elseif($_GET['action'] == 'deleteimage') {
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>Delete an Image from a Gallery:</h2>';
    $edit .= '<label for="name">Gallery Name: (Must be all lowercase with NO SPACES!)</label><br>';
    $edit .= '<input type="text" name="gallery" id="name"><br>';
    $edit .= '<label for="main">Image Path: (IE: milo.jpg)</label><br>';
    $edit .= '<input type="text" name="path" id="name"><br>';
    $edit .= '<input type="submit" name="submit" value="Delete Image"><br>';
    $edit .= '</fieldset>';
    $edit .= '</form>';
    $title = 'Delete Image';
    include 'edit.php';
    exit;
}
elseif($_GET['action'] == 'edithome') {
    $homecontent = getHomeContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit home content:</h2>';
    $edit .= '<input type="hidden" name="name" id="name" value ="'.$homecontent[0][2].'" ><br>';
    $edit .= '<label for="main">Page Main Content:</label><br>';
    $edit .= '<textarea name="content">'.$homecontent[0][1].'</textarea><br>';
    $edit .= '<label for="heading">Page Heading:</label><br>';
    $edit .= '<input type="text" name="heading" value ="'.$homecontent[0][0].'" ><br>';
    $edit .= '<label for="image">Page Image Link:</label><br>';
    $edit .= '<input type="text" name="image" value = "'.$homecontent[0][3].'"><br>';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Home"><br>';
    $edit .= '</fieldset>';
    $edit .= '</form>';
    $title = 'Edit Home Content';
    include 'edit.php';
    exit;
}else if ($_POST['submit']== 'Update Home'){
    
    $pagename = valString($_POST['name']);
    $content = valString($_POST['content']);
    $heading = valString($_POST['heading']);
    $image = valString($_POST['image']);
    
    if (empty($pagename)) {
        $errors[] = 'Please a page name.';
    }
    if (empty($content)) {
        $errors[] = 'Please enter some content.';
    }
    if (empty($heading)) {
        $errors[] = 'Please enter a page heading.';
    }
    if (empty($image)) {
        $errors[] = 'Please enter an image to be displayed on the page.';
    }
    $updatehome = updateContent($pagename, $content, $heading, $image);

    if ($updatehome) {
        $message = 'Update was successful.';
    } else {
        $message = 'Sorry, update failed.';
    }
    include 'manage.php';
    exit;
}
elseif($_GET['action'] == 'editgalleries') {
    $gallerycontent = getGalleryThumb();
    $edit = '<div id = gallerycontent>';
    $edit .= '<h2>Edit Gallery Thumbnails:</h2>';
    if(is_array($gallerycontent)){
        foreach ($gallerycontent as $g){      
    $edit .= '<form id="editgallery" method="post" action=".">';
    $edit .= '<label for="name">Thumbnail Title:</label>';
    $edit .= '<input type="text" name="title" id="name" value ="'.$g['gallery'].'" >';
    $edit .= '<label for="main">Page Thumbnail Path:</label>';
    $edit .= '<input type="text" name="path" value ="'.$g['path'].'"><br>';
    $edit .= '<input type="hidden" name="id" value="'.$g['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Thumbnail"><br>';
    $edit .= '</form>';
        }
    }
    $title = 'Edit Thumb Nails';
    include 'edit.php';
    exit;
}else if ($_POST['submit']== 'Update Thumbnail'){
    
    $gallery = valString($_POST['title']);
    $path = valString($_POST['path']);
    $id = $_POST['id'];
    
    
    if (empty($title)) {
        $errors[] = 'Please a page name.';
    }
    if (empty($path)) {
        $errors[] = 'Please enter some content.';
    }
    
    $updatethumb = updateThumb($gallery, $path, $id);

    if ($updatethumb) {
        $message = 'Update was successful.';
    } else {
        $message = 'Sorry, update failed.';
    }
    include 'manage.php';
    exit;
}
elseif($_GET['action'] == 'editabout') {
    $aboutcontent = getAboutContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit About content:</h2>';
    $edit .= '<input type="hidden" name="name" id="name" value ="'.$aboutcontent[0][2].'" ><br>';
    $edit .= '<label for="main">Page Main Content:</label><br>';
    $edit .= '<textarea name="content">'.$aboutcontent[0][1].'</textarea><br>';
    $edit .= '<label for="heading">Page Heading:</label><br>';
    $edit .= '<input type="text" name="heading" value ="'.$aboutcontent[0][0].'" ><br>';
    $edit .= '<label for="image">Page Image Link:</label><br>';
    $edit .= '<input type="text" name="image" value = "'.$aboutcontent[0][3].'"><br>';
    $edit .= '<input type="submit" name="submit" value="Update About"><br>';
    $edit .= '</fieldset>';
    $edit .= '</form>';
    $title = 'Edit About Content';
    include 'edit.php';
    exit; 
}else if ($_POST['submit']== 'Update About'){
    
    $pagename = valString($_POST['name']);
    $content = valString($_POST['content']);
    $heading = valString($_POST['heading']);
    $image = valString($_POST['image']);
    
    if (empty($pagename)) {
        $errors[] = 'Please a page name.';
    }
    if (empty($content)) {
        $errors[] = 'Please enter some content.';
    }
    if (empty($heading)) {
        $errors[] = 'Please enter a page heading.';
    }
    if (empty($image)) {
        $errors[] = 'Please enter an image to be displayed on the page.';
    }
    $updatehome = updateContent($pagename, $content, $heading, $image);

    if ($updatehome) {
        $message = 'Update was successful.';
    } else {
        $message = 'Sorry, update failed.';
    }
    include 'manage.php';
    exit;
}elseif($_GET['action'] == 'editcontact') {
    $contactcontent = getContactContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Contact content:</h2>';
    $edit .= '<input type="hidden" name="name" id="name" value ="'.$contactcontent[0][2].'" ><br>';
    $edit .= '<label for="main">Page Main Content:</label><br>';
    $edit .= '<textarea name="content">'.$contactcontent[0][1].'</textarea><br>';
    $edit .= '<label for="heading">Page Heading:</label><br>';
    $edit .= '<input type="text" name="heading" value ="'.$contactcontent[0][0].'" ><br>';
    $edit .= '<label for="image">Page Image Link:</label><br>';
    $edit .= '<input type="text" name="image" value = "'.$contactcontent[0][3].'"><br>';
    $edit .= '<input type="submit" name="submit" value="Update Contact"><br>';
    $edit .= '</fieldset>';
    $edit .= '</form>';
    $title = 'Edit Contact Content';
    include 'edit.php';
    exit; 
}else if ($_POST['submit']== 'Update Contact'){
    
    $pagename = valString($_POST['name']);
    $content = $_POST['content'];
    $heading = valString($_POST['heading']);
    $image = valString($_POST['image']);
    
    if (empty($pagename)) {
        $errors[] = 'Please a page name.';
    }
    if (empty($content)) {
        $errors[] = 'Please enter some content.';
    }
    if (empty($heading)) {
        $errors[] = 'Please enter a page heading.';
    }
    if (empty($image)) {
        $errors[] = 'Please enter an image to be displayed on the page.';
    }
    $updatehome = updateContent($pagename, $content, $heading, $image);

    if ($updatehome) {
        $message = 'Update was successful.';
    } else {
        $message = 'Sorry, update failed.';
    }
    include 'manage.php';
    exit;
}
elseif($_GET['action'] == 'editportraits') {
    $content = getPortraitContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editcouples') {
    $content = getCoupleContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editfamily') {
    $content = getFamilyContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editchildren') {
    $content = getChildrenContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editnature') {
    $content = getNatureContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editseniors') {
    $content = getSeniorContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editstill') {
    $content = getStillContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editweddings') {
    $content = getWedContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editanimals') {
    $content = getAnimalContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif($_GET['action'] == 'editmylife') {
    $content = getmylifeContent();
    $edit = '<form id="editcontent" method="post" action=".">';
    $edit .= '<fieldset>';
    $edit .= '<h2>edit Portrait content:</h2>';
    $edit .= '<h3>The first image will be the default image:<br>';
    if(is_array($content)){
        foreach($content as $c){
    $edit .= '<label for="name">Image Path:</label><br>';
    $edit .= '<input type="text" name="name" id="name" value ="'.$c['path'].'" ><br>';
    $edit .= '<input type="hidden" name="pid" value="'.$c['id'].'">';
    $edit .= '<input id="update" type="submit" name="submit" value="Update Images"><br>';
        }
    }
    $edit .= '</fieldset>';
    $edit .= '</form>';
    include 'edit.php';
    exit; 
}
elseif ($_POST['submit'] == 'Add Image') {
    // Collect the data
    $gallery = valString($_POST['gallery']);
    $path = valString($_POST['path']);


    // Validate
    if (empty($gallery)) {
        $errors[] = 'Please provide a gallery name.';
    }
    if (empty($path)) {
        $errors[] = 'Please provide a valid image path.';
    }
    
    if (!empty($errors)) {
    $message = "you have an error yo!";
    include 'edit.php';
    exit;
  }
    // Check error, return for fix if needed
    // Call the function in the model

    $addimage = addImage($gallery, $path);

    // Check model return and display view.
    if ($addimage == 1) {
        $message = 'The image has been successfully added to the Gallery! Go take a look!';
    } else {
        $message = 'Sorry, the image was not added';
    }
    include 'manage.php';
    //echo "<a href='index.php'>Return to Registration Page</a>";
    exit;
}
elseif ($_POST['submit'] == 'Delete Image') {
    // Collect the data
    $gallery = valString($_POST['gallery']);
    $path = valString($_POST['path']);
    
    // Validate
    if (empty($gallery)) {
        $errors[] = 'Please provide a gallery name.';
    }
    if (empty($path)) {
        $errors[] = 'Please provide a valid image path.';
    }
    
    if (!empty($errors)) {
    $title = "you have an error yo!";
    include 'edit.php';
    exit;
  }

    $deleteimage = deleteImage($gallery, $path);

    if ($deleteimage) {
        $message = 'The image has been successfully Deleted! Go take a look!';
    } else {
        $message = 'Sorry, delete failed.';
    }
    include 'manage.php';
    exit;
} 
else {
    include 'view.php';
    exit;
}




