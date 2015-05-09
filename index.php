<?php

/* 
 * Controller for first index page
 */
require 'model.php';

if(!isset($_GET['action'])){
include 'view.php';
exit;
}


if(isset($_GET['action']) && ($_GET['action'] == 'home')){
    header('location: /home/?action=home');
    exit;
}

if(isset($_GET['action']) && ($_GET['action'] == 'galleries')){
    header('location: /home/?action=galleries');
    exit;
}

if(isset($_GET['action']) && ($_GET['action'] == 'about')){
    header('location: /home/?action=about');
    exit;
}

if(isset($_GET['action']) && ($_GET['action'] == 'contact')){
    header('location: /home/?action=contact');
    exit;
}
