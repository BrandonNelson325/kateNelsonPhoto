<?php
//or if ($_POST['submit'] == 'Send It')
if (isset($_POST['submit'])){
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $url = $_POST['url'];
    $email = $_POST['email'];
    
    $person = array('firstname' => $firstname,
        'lastname' => $lastname,
        'url' => $url,
        'email' => $email);
    
    include 'view.php';
    exit;
    
} else {
    include 'view.php';
}



