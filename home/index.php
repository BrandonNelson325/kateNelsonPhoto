<?php

if(!$_SESSION){
    session_start();
}

$personid = $_SESSION['personid'];
$personfirst = $_SESSION['personfirst'];
$personlast = $_SESSION['personlast'];
$persontype = $_SESSION['persontype'];
$fullname = "$personfirst $personlast";
/* 
controller for content
*/



require 'model.php';

if(isset($_GET['action']) && ($_GET['action'] == 'home')){
    $homecontent = getHomeContent();
    $heading = '<h1>';
    $heading .= $homecontent[0][1];
    $heading .= '</h1>';
    
    $content = '<img id=home-image src = "../photos/'.$homecontent[0][2].'" alt = "home image">';
    $content .= '<p>';
    $content .= $homecontent[0][0];
    $content .= '</p>';
    $title = 'Home';
    include 'view.php';
    exit;
}

elseif(isset($_GET['action']) && ($_GET['action'] == 'galleries')){
    $galcontent = getGalleryThumb();
    if(is_array($galcontent)){
    $content = '<div id=gallerythumb>';
    $content .= '<ul>';
    foreach ($galcontent as $c){
    $content .= '<li><a href=".?action='.$c['gallery'].'"><img class ="thumb2" src="../photos/thumb/'.$c['path'].'" alt = "galleries image"><span>'.ucwords($c['gallery']).'</span></a></li>';
    }
     $content .= '</ul>';
     $content .= '</div>';
     $title = 'Galleries';
    }else {
        $content = 'Sorry no items were found';
    }
    include 'view.php';
    exit;
}

elseif(isset($_GET['action']) && ($_GET['action'] == 'about')){
    $aboutcontent = getAboutContent();
    $heading = '<h1>';
    $heading .= $aboutcontent[0][1];
    $heading .= '</h1>';
    $content = '<img id=home-image src = "../photos/'.$aboutcontent[0][2].'" alt = "about image">';
    $content .= '<p>';
    $content .= $aboutcontent[0][0];
    $content .= '</p>';
    $title = 'About';
    include 'view.php';
    exit;
}

elseif(isset($_GET['action']) && ($_GET['action'] == 'contact')){
    $contactcontent = getContactContent();
    $heading = '<h1>';
    $heading .= $contactcontent[0][1];
    $heading .= '</h1>';
    $content = '<img id=contact-image src = "../photos/'.$contactcontent[0][2].'" alt = "contact image">';
//    $content .= '<ul id = contact>';
//    $content .= $contactcontent[0][0];
//    $content .= '</ul>';
    $content .= '<form id = "contact" action="index.php" method="post">
     <fieldset>
      <label for="first">First Name:</t></label>
      <input id="first" name="first" type="text"><br>
      <label for="last">Last Name:   </label>
      <input id="last" name="last" type="text"><br>
      <label for="email">Email Address:</label>
      <input id="email" name="email" type="email"><br>
      <label for="subject">Subject:</label>
      <input id="subject" name="subject" type="text"><br>
      <label for="message">Message:</label>
      <textarea name="message" id="message"></textarea><br>
      <label for="submit">&nbsp;</label><br>
      <input type="submit" name="submit" value="Send"><br>
     </fieldset>
    </form>';
    $title = 'Contact';
    include 'view.php';
    exit;
}elseif ($_POST['submit'] == 'Send') {
    // Collect the data 
    $firstname = valString($_POST['first']);
    $lastname = valString($_POST['last']);
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    // Validate
    if (empty($firstname)) {
        $errors[] = 'Please provide a first name.';
    }
    if (!valEmail($email)) {
        $errors[] = 'Please provide a valid e-mail address.';
    } 
    
    if(!empty($errors)){
        include 'contact.php';
        exit;
    } else {
        $to = 'Katehillnelson@gmail.com';
        $from = 'From:'.$email;
        $fullname = $firstname.' '.$lastname;
        $message .= "\n\n$fullname";
        $message .= "\n\n$from";
        
        $result = mail($to, $subject, $message);
        
        if($result){
            $message = 'Thanks, your message has been sent!';
        }
        else{
            $message = 'Sorry, the message could not be sent.';
        }
    include 'view.php';
    exit;
    }
    // Check error, return for fix if needed
    // Call the function in the model

    include 'view.php';
    exit;
}elseif(isset($_GET['action']) && ($_GET['action'] == 'portraits')){
    $portraitcontent = getPortraitContent();
    $galcontent = getGalleryContent();
    $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
    if(is_array($galcontent)){
    $content = '<nav id=gallerynav>';
    $content .= '<ul>';
    foreach ($galcontent as $c){
    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
        }
     $content .= '</ul>';
     $content .= '</nav>';
     $title = 'Portraits';
    }
    if(is_array($portraitcontent)){
        $content .= '<div id=gallery>';
        $content .= '<img id = "main-img" src="../photos/'.$portraitcontent[0][0].'" alt="portrait photo" />';
        $content .= '<ul>';
        foreach ($portraitcontent as $p){
           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="portrait thumb"></li>';
        }
        $content .= '</ul>';
        $content .= '</div>';
    }else {
       $content = 'Sorry no items were found'; 
    }
    include 'view.php';
    exit;
}
//elseif(isset($_GET['action']) && ($_GET['action'] == 'couples')){
//    $couplecontent = getCoupleContent();
//    $galcontent = getGalleryContent();
//    $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
//    if(is_array($galcontent)){
//    $content = '<nav id=gallerynav>';
//    $content .= '<ul>';
//    foreach ($galcontent as $c){
//    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
//        }
//     $content .= '</ul>';
//     $content .= '</nav>';
//     $title = 'Couples';
//    }
//    if(is_array($couplecontent)){
//        $content .= '<div id=gallery>';
//        $content .= '<img id = "main-img" src="../photos/'.$couplecontent[0][0].'" alt="couple images"/>';
//        $content .= '<ul>';
//        foreach ($couplecontent as $p){
//           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="couple thumbnail"></li>';
//        }
//        $content .= '</ul>';
//        $content .= '</div>';
//    }else {
//       $content = 'Sorry no items were found'; 
//    }
//    include 'view.php';
//    exit;
//}
elseif(isset($_GET['action']) && ($_GET['action'] == 'family')){
    $familycontent = getFamilyContent();
    $galcontent = getGalleryContent();
    $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
    if(is_array($galcontent)){
    $content = '<nav id=gallerynav>';
    $content .= '<ul>';
    foreach ($galcontent as $c){
    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
        }
     $content .= '</ul>';
     $content .= '</nav>';
     $title = 'Family';
    }
    if(is_array($familycontent)){
        $content .= '<div id=gallery>';
        $content .= '<img id = "main-img" src="../photos/'.$familycontent[0][0].'" alt="family images" />';
        $content .= '<ul>';
        foreach ($familycontent as $p){
           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="family thumbnail" ></li>';
        }
        $content .= '</ul>';
        $content .= '</div>';
    }else {
       $content = 'Sorry no items were found'; 
    }
    include 'view.php';
    exit;
}
//elseif(isset($_GET['action']) && ($_GET['action'] == 'animals')){
//    $animalcontent = getAnimalContent();
//    $galcontent = getGalleryContent();
//    $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
//    if(is_array($galcontent)){
//    $content = '<nav id=gallerynav>';
//    $content .= '<ul>';
//    foreach ($galcontent as $c){
//    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
//        }
//     $content .= '</ul>';
//     $content .= '</nav>';
//     $title = 'Animals';
//    }
//    if(is_array($animalcontent)){
//        $content .= '<div id=gallery>';
//        $content .= '<img id = "main-img" src="../photos/'.$animalcontent[0][0].'" alt="animal photo"/>';
//        $content .= '<ul>';
//        foreach ($animalcontent as $p){
//           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="animal thumbnail"></li>';
//        }
//        $content .= '</ul>';
//        $content .= '</div>';
//    }else {
//       $content = 'Sorry no items were found'; 
//    }
//    include 'view.php';
//    exit;
//}
elseif(isset($_GET['action']) && ($_GET['action'] == 'children')){
    $childrencontent = getChildrenContent();
    $galcontent = getGalleryContent();
    $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
    if(is_array($galcontent)){
    $content = '<nav id=gallerynav>';
    $content .= '<ul>';
    foreach ($galcontent as $c){
    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
        }
     $content .= '</ul>';
     $content .= '</nav>';
     $title = 'Children';
    }
    if(is_array($childrencontent)){
        $content .= '<div id=gallery>';
        $content .= '<img id = "main-img" src="../photos/'.$childrencontent[0][0].'" alt="children photo" />';
        $content .= '<ul>';
        foreach ($childrencontent as $p){
           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="children thumbnail"></li>';
        }
        $content .= '</ul>';
        $content .= '</div>';
    }else {
       $content = 'Sorry no items were found'; 
    }
    include 'view.php';
    exit;
}
//elseif(isset($_GET['action']) && ($_GET['action'] == 'nature')){
//    $naturecontent = getNatureContent();
//    $galcontent = getGalleryContent();
//    $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
//    if(is_array($galcontent)){
//    $content = '<nav id=gallerynav>';
//    $content .= '<ul>';
//    foreach ($galcontent as $c){
//    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
//        }
//     $content .= '</ul>';
//     $content .= '</nav>';
//     $title = 'Nature';
//    }
//    if(is_array($naturecontent)){
//        $content .= '<div id=gallery>';
//        $content .= '<img id = "main-img" src="../photos/'.$naturecontent[0][0].'" alt="nature photo"/>';
//        $content .= '<ul>';
//        foreach ($naturecontent as $p){
//           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="nature thumbnail"></li>';
//        }
//        $content .= '</ul>';
//        $content .= '</div>';
//    }else {
//       $content = 'Sorry no items were found'; 
//    }
//    include 'view.php';
//    exit;
//}
elseif(isset($_GET['action']) && ($_GET['action'] == 'seniors')){
    $seniorcontent = getSeniorContent();
     $galcontent = getGalleryContent();
     $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
    if(is_array($galcontent)){
    $content = '<nav id=gallerynav>';
    $content .= '<ul>';
    foreach ($galcontent as $c){
    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
        }
     $content .= '</ul>';
     $content .= '</nav>';
      $title = 'Seniors';
    }
    if(is_array($seniorcontent)){
        $content .= '<div id=gallery>';
        $content .= '<img id = "main-img" src="../photos/'.$seniorcontent[0][0].'" alt="senior photo"/>';
        $content .= '<ul>';
        foreach ($seniorcontent as $p){
           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="senior thumbnail"></li>';
        }
        $content .= '</ul>';
        $content .= '</div>';
    }else {
       $content = 'Sorry no items were found'; 
    }
    include 'view.php';
    exit;
}
elseif(isset($_GET['action']) && ($_GET['action'] == 'stilllife')){
    $stillcontent = getStillContent();
    $galcontent = getGalleryContent();
    $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
    if(is_array($galcontent)){
    $content = '<nav id=gallerynav>';
    $content .= '<ul>';
    foreach ($galcontent as $c){
    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
        }
     $content .= '</ul>';
     $content .= '</nav>';
     $title = 'Still Life';
    }
    if(is_array($stillcontent)){
        $content .= '<div id=gallery>';
        $content .= '<img id = "main-img" src="../photos/'.$stillcontent[0][0].'" alt="still life photo"/>';
        $content .= '<ul>';
        foreach ($stillcontent as $p){
           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="still life thumbnail"></li>';
        }
        $content .= '</ul>';
        $content .= '</div>';
    }else {
       $content = 'Sorry no items were found'; 
    }
    include 'view.php';
    exit;
}
elseif(isset($_GET['action']) && ($_GET['action'] == 'weddings')){
    $wedcontent = getWedContent();
     $galcontent = getGalleryContent();
     $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
    if(is_array($galcontent)){
    $content = '<nav id=gallerynav>';
    $content .= '<ul>';
    foreach ($galcontent as $c){
    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
        }
     $content .= '</ul>';
     $content .= '</nav>';
      $title = 'Weddings';
    }
    if(is_array($wedcontent)){
        $content .= '<div id=gallery>';
        $content .= '<img id = "main-img" src="../photos/'.$wedcontent[0][0].'" alt="wedding photo"/>';
        $content .= '<ul>';
        foreach ($wedcontent as $p){
           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="wedding thumbnail"> </li>';
        }
        $content .= '</ul>';
        $content .= '</div>';
    }else {
       $content = 'Sorry no items were found'; 
    }
    include 'view.php';
    exit;
}
//elseif(isset($_GET['action']) && ($_GET['action'] == 'mylife')){
//    $mylifecontent = getmylifeContent();
//    $galcontent = getGalleryContent();
//    $larr = '<a id="larr" href=".?action=galleries">&larr; Back</a>';
//    if(is_array($galcontent)){
//    $content = '<nav id=gallerynav>';
//    $content .= '<ul>';
//    foreach ($galcontent as $c){
//    $content .= '<li><a href=".?action='.$c['gallery'].'">'.ucwords($c['gallery']).'</a></li>';
//        }
//     $content .= '</ul>';
//     $content .= '</nav>';
//     $title = 'My Life';
//    }
//    if(is_array($mylifecontent)){
//        $content .= '<div id=gallery>';
//        $content .= '<img id = "main-img" src="../photos/'.$mylifecontent[0][0].'" alt="my life photo"/>';
//        $content .= '<ul>';
//        foreach ($mylifecontent as $p){
//           $content .= '<li><img class="thumb" src="../photos/thumb/'.$p['path'].'" alt="my life thumbnail"></li>';
//        }
//        $content .= '</ul>';
//        $content .= '</div>';
//    }else {
//       $content = 'Sorry no items were found'; 
//    }
//    include 'view.php';
//    exit;
//
//}
else if(isset($_GET['action']) && ($_GET['action'] == 'logout')){
    $logout = logoutPerson();
    if($logout){
    $message = 'you were successfully logged out!';
    $homecontent = getHomeContent();
    $heading = '<h1>';
    $heading .= $homecontent[0][1];
    $heading .= '</h1>';
    
    $content = '<img id=home-image src = "../photos/'.$homecontent[0][2].'" alt = "home image">';
    $content .= '<p>';
    $content .= $homecontent[0][0];
    $content .= '</p>';
    $title = 'Home';
    include 'view.php';
    exit;
  } else {
    $message = 'There was an error while performing the logout.';
    $_SESSION['message'] = $message;
    exit;
  }
}else {
    $content = getHomeContent();
    $content = $content[0];
    include 'view.php';
    exit;
}


