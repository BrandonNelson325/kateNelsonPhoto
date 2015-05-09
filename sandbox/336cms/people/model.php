<?php

/*
 * People Model
 */

// Get the connection object
require $_SERVER['DOCUMENT_ROOT'].'/conn/connacme.php';

// Function to register new clients
function registerClient($firstname, $lastname, $email, $password){
 global $db;
 global $database;
 
 // Begin Transaction to allow inserts to multiple tables
 $db->beginTransaction();
 
 // Set a flag to determine if the transaction is working
 $flag = TRUE;
 
 // Begin the first insert
 try{
  $query = 'INSERT INTO '.$database.'.client (client_fname, client_lname, client_email) VALUES (:firstname, :lastname, :email)';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':firstname', $firstname);
  $stmt->bindValue(':lastname', $lastname);
  $stmt->bindValue(':email', $email);
  $stmt->execute();
  $clientid = $db->lastInsertId(); // Getting the primary key value
  $stmt -> closeCursor();
 } catch (PDOException $exc) {
  // send back failure
  return 0;
 }
 
 // See if the insert failed, change flag if it did
 if($clientid < 1){
  $flag = FALSE;
 }
 
 // If flag is still true, attempt the second insert
 if($flag){
  try{
  $query = "INSERT INTO $database.authorization (client_id, auth_password) VALUES (:clientid, :password)";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':clientid', $clientid);
  $stmt->bindValue(':password', $password);
  $stmt->execute();
  $rowcount = $stmt->rowCount(); //How many rows were added
  $stmt -> closeCursor();
  
 } catch (PDOException $exc) {
  // set flag to false indicating the insert could not be completed
  $flag = FALSE;
 }
 }
 
 if($rowcount != 1){
  $flag = FALSE;
 }
 
 // Check if flag is true
 if($flag){
  // Make all inserts permanent
  $db->commit();
  return 1; // Send to controller a successful registration
 } else {
  // flag must be false, get rid of any inserted data from either insertion
 $db->rollback();
 return 0; // Send to controller a registration failure
 }
}

// Get all clients who are registered in the database
function registeredClients(){
 global $db;
 global $database;
 
 $query = "SELECT client_id, client_fname, client_lname 
   FROM $database.client";
 
 try {
  $stmt = $db->prepare($query);
  $stmt->execute();
  $clients = array(); // create an array to store all clients
  $client = $stmt->fetch(); // get the first client
  while ($client != NULL){ // loop until no more clients to get
   $clients[] = $client; // store each client into an array
   $client = $stmt->fetch(); // get the next client
  }
  $size = count($clients); // see how many clients there are
  $stmt -> closeCursor();

  if($size >= 1){
   return $clients; // return the clients array
  } else {
   return 0;
  }
 } catch (PDOException $exc) {

  return 0;
 }

}

// Get a specific client from the database
function getClient($personid){
 global $db;
 global $database;
 
 $query = "SELECT client.client_id, client_fname, client_lname, client_email, client_added, client_comments, auth_userlevel 
   FROM $database.client, $database.authorization 
     WHERE client.client_id=:clientid
     AND client.client_id = authorization.client_id";
 
 try {
  $stmt = $db->prepare($query);
  $stmt->bindValue(':clientid', $personid);
  $stmt->execute();
  $client = $stmt->fetch(PDO::FETCH_NUM);
  $stmt -> closeCursor();
  return $client; // return the client array
 } catch (PDOException $exc) {
  echo 'Error retrieving client';
 }
}

// Update a specific client's data
function updateClient($clientid,$clientfirst,$clientlast, $clientemail,$clientcomment,$clientlevel){
  global $database;
  global $db;
  
  $sql = "UPDATE $database.client, $database.authorization SET client_fname=:clientfirst, client_lname=:clientlast, client_email=:clientemail, client_comments=:clientcomment, auth_userlevel=:clientlevel
          WHERE client.client_id = :clientid AND client.client_id = authorization.client_id";

  try {
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientfirst', $clientfirst);
    $stmt->bindValue(':clientlast', $clientlast);
    $stmt->bindValue(':clientemail', $clientemail);
    $stmt->bindValue(':clientcomment', $clientcomment);
    $stmt->bindValue(':clientlevel', $clientlevel);
    $stmt->bindValue(':clientid', $clientid);
    $stmt->execute();
    $clientupdateresult = $stmt->rowCount();
    $stmt -> closeCursor();
    return $clientupdateresult;
  } catch (Exception $e) {
    echo 'Error updating client in database';
  }
}

// Delete an Existing Client - Must be a DB Admin to do this
function deleteClient($clientid){
  global $databaseadmin;
  global $dbadmin;
  
  $sql = "DELETE FROM $databaseadmin.client WHERE client_id=:clientid";
  
  try {
    $stmt = $dbadmin->prepare($sql);
    $stmt->bindValue(':clientid', $clientid);
    $stmt->execute();
    $deleteresult = $stmt->rowCount();
    $stmt->closeCursor();
    return $deleteresult;
  } catch (Exception $e) {
    echo 'Error with delete';
  }

}

// Login client
function loginClient($email, $password){
 global $database;
 global $db;
 
 try{
  $sql = "SELECT client_fname, client_lname, client_email, auth_userlevel
FROM $database.client, $database.authorization
WHERE auth_password = :password
AND client_email = :email
AND client.client_id = authorization.client_id";
  
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':password', $password);
  $stmt->execute();
  $clientInfo = $stmt->fetchAll();
  $stmt->closeCursor();
  return $clientInfo;
} catch (Exception $e){
 // Do nothing
}
}

// check for existing email as part of registration process
function getEmail($submittedemail){
 global $db;
 global $database;
 try {
  $sql = "SELECT client_email FROM $database.client WHERE client_email = :email";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $submittedemail);
  $stmt->execute();
  $existingemail = $stmt->fetch();
  $stmt->closeCursor();
  if(!empty($existingemail)){
   return $existingemail;
  } else {
   return 0;
  }
} catch (Exception $e){
$error = $e->getMessage();
echo $error;
}
}
?>