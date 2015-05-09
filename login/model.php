<?php

/* 
 *  model for the login info
 */
//get the library so we have the DB connection.
require $_SERVER['DOCUMENT_ROOT']. '/library/functions.php';

function regUser($firstname, $lastname, $email, $passwordhashed){
    $conn = dbConnection();
    $conn->beginTransaction();
    
    $flag = TRUE;
    
    try {
// Insert the first 3 variables using a prepared statement
    $sql = "INSERT INTO people 
         (people_firstname
         , people_lastname
         , people_email
         , people_password) 
         VALUES (:first, :last, :email, :password)";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':first', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':last', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $passwordhashed, PDO::PARAM_STR);
    
    
    $stmt->execute();
    $rowcount = $stmt->rowCount(); //How many rows were added

// Determine if the insert worked
// by getting the primary key created by the insert
    // this function returns the primary key. built in.
    $userid = $conn -> lastInsertId();
    $stmt -> closeCursor();
  } catch (PDOException $e) {
    return 0; // indicates failure
  }
  
  // Change flag if the insert failed
  if ($userid < 1) {
    $flag = FALSE;
  }

    
  if ($rowcount != 1) {
    $flag = FALSE; //The insert failed
  }

  // Check if flag is true
  if ($flag) {
    // Make all inserts permanent
    $conn->commit();
    return 1; // A successful registration
  } else {
    // The flag is false, get rid of any 
    // inserted data from the transaction
    $conn->rollback();
    return 0; // A failed registration
  }
} // End of function



// Login Function
function userLogin($email, $passwordhashed){
    $conn = dbConnection();
    try {
        $sql = 'SELECT people_email, people_password
                FROM people
                WHERE people_email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $hashedPassword = $stmt->fetch(); // returns single row as array with index of 0
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'Could not find user or password';
    }
    // compare the passwords to check if the hashed matches entered. 
    $comparePasswords = comparePassword($passwordhashed, $hashedPassword);
    
    if ($comparePasswords) {
    // Run a second query to get person's data because the email and password match
    // Login the person and send to account management view
    try {
      $sql = 'SELECT people_id, people_firstname, people_lastname, people_type, people_email
              FROM people 
              WHERE people_email=:email';
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      $personData = $stmt->fetch(); // returns single row
      $stmt->closeCursor();
    } catch (PDOException $ex) {
      return FALSE; // indicates failure
    }// If data was returned, log the user in using the session
    if (is_array($personData) && !empty($personData)) {
      session_regenerate_id(TRUE); // copies old session data to a new session (security)
      $_SESSION['loggedin'] = TRUE; // indicate the person is logged in
      $_SESSION['personid'] = $personData[0];
      $_SESSION['personfirst'] = $personData[1];
      $_SESSION['personlast'] = $personData[2];
      $_SESSION['persontype'] = $personData[3];
      $_SESSION['personemail'] = $personData[4];
      return TRUE;
    } else {
      return FALSE;
    }
  } 
}

function updateUser($personid, $email, $password, $fname, $lname){
    $conn = dbConnection();
    try{
        $sql = 'UPDATE people SET people_firstname=:firstname, people_lastname=:lastname, people_email=:email, people_password=:password WHERE people_id=:id';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':firstname', $fname, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lname, PDO::PARAM_STR);
        $stmt->bindValue(':password', $passwordhashed, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $personid, PDO::PARAM_INT);
        $stmt->execute();
        $updateuser = $stmt->rowCount(); // returns single row
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    if($updateuser){
        return TRUE;
    }else{
        return FALSE;
    }
}

function deleteUser($personid){
    $conn = dbConnection();
    try{
        $sql = 'DELETE FROM people WHERE people_id=:id';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $personid, PDO::PARAM_INT);
        $deleteuser = $stmt->execute(); // returns single row
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    if($deleteuser){
        $_SESSION['loggedin'] = FALSE; // indicate the person is logged in
      unset($_SESSION['loggedin']);
      unset($_SESSION['personid']);
      unset($_SESSION['personfirst']);
      unset($_SESSION['personlast']);
      unset($_SESSION['persontype']);
      session_regenerate_id(TRUE); // copies old session data to a new session (security)
      return TRUE;
    }else{
        return FALSE;
    }
}

function adminDelete($personid){
    $conn = dbConnection();
    try{
        $sql = 'DELETE FROM people WHERE people_id=:id';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $personid, PDO::PARAM_INT);
        $deleteuser = $stmt->execute(); // returns single row
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    if($deleteuser){
      return TRUE;
    }else{
        return FALSE;
    }
}

function addImage($gallery, $path){
    $conn = dbConnection();
    $conn->beginTransaction();
    
    $flag = TRUE;
    
    try {
// Insert the first 3 variables using a prepared statement
    $sql = "INSERT INTO images
         ( gallery
         , path) 
         VALUES (:gallery, :path)";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':gallery', $gallery, PDO::PARAM_STR);
    $stmt->bindValue(':path', $path, PDO::PARAM_STR);
    
    
    $stmt->execute();
    $rowcount = $stmt->rowCount(); //How many rows were added

// Determine if the insert worked
// by getting the primary key created by the insert
    // this function returns the primary key. built in.
    $userid = $conn -> lastInsertId();
    $stmt -> closeCursor();
  } catch (PDOException $e) {
    return 0; // indicates failure
  }
  
  // Change flag if the insert failed
  if ($userid < 1) {
    $flag = FALSE;
  }

    
  if ($rowcount != 1) {
    $flag = FALSE; //The insert failed
  }

  // Check if flag is true
  if ($flag) {
    // Make all inserts permanent
    $conn->commit();
    return 1; // A successful registration
  } else {
    // The flag is false, get rid of any 
    // inserted data from the transaction
    $conn->rollback();
    return 0; // A failed registration
  }
} // End of function

function deleteImage($gallery, $path){
    $conn = dbConnection();
    try{
        $sql = 'DELETE FROM images WHERE gallery=:gallery AND path=:path';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':gallery', $gallery, PDO::PARAM_STR);
        $stmt->bindValue(':path', $path, PDO::PARAM_STR);
        $deleteimage = $stmt->execute(); // returns single row
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    if($deleteimage){
      return TRUE;
    }else{
        return FALSE;
    }
}


function getHomeContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT heading, main, page, image FROM content WHERE page = 'home'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function updateContent($pagename, $content, $heading, $image){
    $conn = dbConnection();
    try{
        $sql = 'UPDATE content SET main=:content, heading=:heading, image=:image WHERE page=:pagename';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':heading', $heading, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindValue(':pagename', $pagename, PDO::PARAM_STR);
        $stmt->execute();
        $updateuser = $stmt->rowCount(); // returns single row
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    if($updateuser){
        return TRUE;
    }else{
        return FALSE;
    }
}

function getGalleryContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT  gallery, path, id FROM images WHERE thumbnail = 'yes'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $query = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($query)){
        return $query;
    } else {
        return FALSE;
    }
}

function getGalleryThumb(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, gallery, id FROM thumbnails ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $query = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($query)){
        return $query;
    } else {
        return FALSE;
    }
}

function updateThumb($gallery, $path, $id){
    $conn = dbConnection();
    try{
        $sql = 'UPDATE thumbnails SET gallery=:gallery, path=:path WHERE id=:id';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':gallery', $gallery, PDO::PARAM_STR);
        $stmt->bindValue(':path', $path, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $updatethumb = $stmt->rowCount();// returns single row
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    if($updatethumb){
        return TRUE;
    }else{
        return FALSE;
    }
}

function getAboutContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT  heading, main, page, image FROM content WHERE page = 'about'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getContactContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT heading, main, page, image FROM content WHERE page = 'contact'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getPortraitContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'portraits'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getCoupleContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'couples'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getFamilyContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'family'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getAnimalContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'animals'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getChildrenContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'children'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}
function getNatureContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'nature'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getSeniorContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'seniors'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getStillContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'stilllife'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getWedContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'weddings'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}
function getmylifeContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, id FROM images WHERE gallery = 'mylife'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $content = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($content)){
        return $content;
    } else {
        return FALSE;
    }
}

function getAllUsers(){
    $conn = dbConnection();
    try{
        $sql = "SELECT * FROM people";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        $message = 'The query could not be executed';
    }
    if(!empty($users)){
        return $users;
    } else {
        return FALSE;
    }
}
    