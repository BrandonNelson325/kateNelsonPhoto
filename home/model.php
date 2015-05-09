<?php

/* 
 * model for content
 */
require '../library/functions.php';

function getHomeContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT main, heading, image FROM content WHERE page = 'home'";
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

function getGalleryContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT path, gallery FROM images WHERE thumbnail = 'yes'";
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

function getAboutContent(){
    $conn = dbConnection();
    try{
        $sql = "SELECT main,heading, image FROM content WHERE page = 'about'";
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
        $sql = "SELECT main, heading, image FROM content WHERE page = 'contact'";
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
function logoutPerson() {
  // Clear all login information from session
  // Reset the session      
      $_SESSION['loggedin'] = FALSE; // indicate the person is logged in
      unset($_SESSION['loggedin']);
      unset($_SESSION['personid']);
      unset($_SESSION['personfirst']);
      unset($_SESSION['personlast']);
      unset($_SESSION['persontype']);
      session_regenerate_id(TRUE); // copies old session data to a new session (security)
      return TRUE;
}

