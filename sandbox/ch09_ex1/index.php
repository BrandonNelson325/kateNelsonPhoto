<?php
if (isset($_POST['action'])) {
    $action =  $_POST['action'];
} else {
    $action =  'start_app';
}

switch ($action) {
    case 'start_app':
        $message = 'Enter some data and click on the Submit button.';
        break;
    case 'process_data':
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        // 2. display the name with only the first letter capitalized
        if (!empty($name)) {
            $name = strtolower($name);
            $name_message = ucwords($name);
        }else
            $name_message = 'You must enter a Name';
        

        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        // 2. make sure the email address has at least one @ sign and one dot character
        if (empty($email)) {
            $email_message = 'You must enter an email';
        }
        else if(strpos($email, '@')=== false){
            $email_message = 'The email must contain an @ symbol.';
        }
        else if(strpos($email, '.')=== false){
            $email_message = 'The email must contain a . symbol.';
        }else {
            $email_message = ucwords($email);
        }
        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        // 2. format the phone number like this 123-4567 or this 123-456-7890
        if (empty($phone)) {
            $phone_message = 'You must enter a phone number';
        }
        else if(strlen($phone) < 7){
             $phone_message = 'Number must be at least seven digits long';
        }
        else if(strlen($phone)=== 7){
            $first = substr($phone, 0, 3);
            $second = substr($phone, 3);
            $phone_message = "$first". '-' . "$second";
        }else{
            $first = substr($phone, 0, 3);
            $second = substr($phone, 3, 3);
            $third = substr($phone, 6);
            $phone_message = "$first". '-' . "$second". '-'. "$third";
        }
            

        /*************************************************
         * Display the validation message
         ************************************************/
         $message = "$name_message"."\n"."$email_message"."\n"."$phone_message";

        break;
}
include 'string_tester.php';
?>