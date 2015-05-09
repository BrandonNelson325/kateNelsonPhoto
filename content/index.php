<?php

/* 
controller for content
*/

require $_SERVER['DOCUMENT_ROOT']. '/content/model.php';

if(isset($_POST['action']) && $_POST['action'] == 'Add Category'){
    $catName = valString($_POST['catname']);
    
    if(empty($catName)){
       $error = "Please provide a category name.";
    }
    if(!empty($error)){
        include 'view.php';
        exit;
    }
    
    $insertResult = categoryName($catName);
    if($insertResult){
        $message = $catName. ' was successfully inserted into the database.';
    }else{
        $message = 'The insert failed....';
    }
    include 'view.php';
}
elseif($_GET['action']=='edit'){
    $id =(int) $_GET['id'];
    
    $data = getCategoryItem($id);
    
    if(is_array($data)){
        include 'edit.php';
        exit;
    }else {
        $message = 'No data found.';
        include 'view.php';
    }   
}
elseif($_POST['action']=='Update'){
    $catname = valString($_POST['catname']);
    $catid   = (int) $_POST(['id']);
    
    if($empty($catname)){
        $error = 'Please provide a categorie name';
    }
    if(!empty($error)){
        include 'edit.php';
        exit;
    }
    
    $result = updateCategory($catid, $catname);
    if($result){
        $message = 'Update Successful.';
    }else {
        $message = 'Update Failed... LOSER';
    }
    include 'view.php';
    exit;
}
else{
    include 'view.php';
}