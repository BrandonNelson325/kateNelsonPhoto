

<?php

// this is what me and brock did for our quiz.
function arrayConvert($array) {

    $convert;
    foreach ($array as $item) {
        $convert .= "<ul> <a href= \"$item[$i]\">" . $item . "</a> </ul>";
    }
    return $convert;
}

$array = array('Drums', 'Guitars', 'Pianos', 'Trumpets');
echo arrayConvert($array);


//this is the example from class.
$array = array('Drums', 'Guitars', 'Pianos', 'Trumpets');

function arrayConvert2($array) {

    $convert = '<ul>';

    foreach ($array as $key => $value) {
        $convert .= "<li><a href=".$key.">". $value . "</a></li>";
        
    }
    return $convert;
    $convert .= '<ul>';
}
echo arrayConvert($array);



