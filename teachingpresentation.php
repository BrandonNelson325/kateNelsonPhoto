<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta name="author" content= "Brandon Nelson">
        <meta charset="utf-8">
        <link href="/presentation.css" rel="stylesheet"  type="text/css" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1, macimum-scale=1">
        <title>Teaching Presentation | Multidimensional Array's</title>
    </head>
    <body>
        <div class = "content">
            <header>
                <a href="/index.php">Home</a>
                <h1>MULTIDIMENSIONAL ARRAYS</h1>
                <hr>
            </header>
            <main>
                <h2>Review of Arrays</h2>
                A good way to look at an array is as a row of data in a table.<br>
                <h3>Building an array:</h3>
                $Person = array("Alex", "Caucasian","Male","24","Red Hair");<br><br>
                    The way that this would look in a table would be:<br>

                    <img id="SingleArray" src="images/SingleArray.png" alt="Single array for a person."><br>
                    <?php
                    $array1 = array("Alex", "Caucasian", "Male", "24", "Red Hair");
                    ?>
                    
                    <hr>
                    
                <h2>Multidimensional Arrays</h2>
                <p>
                    Q: What if we want to store the data for multiple people?<br>
                    A: You would store it in a Multidimensional Array.<br>
                <p>
                    A Multidimensional Array in PHP is an Array of Arrays. In other words, There is one BIG array, and then there can be as many SMALLER arrays stored inside of it. The small arrays are stored inside of the big array.<br>
                </p>    
                <h3>Building a multidimensional array:</h3>
                    $people = array(
                    <div id ="indent">
                    array("Alex", "Caucasian", "Male", "24", "Red Hair"),<br>
                    array("Sherman","Caucasian", "Male","29", "Brown Hair"),<br>
                    array("Lexi","Caucasian","Female","18","Brunette"));<br>
                    </div><br>
                    Now we have a table with three people:<br>
                    <img id="MultiArray" src="images/MultiArray.png" alt="Multi array for people.">
                    
                    <?php
                    $people = array(
                                   array("Alex", "Caucasian", "Male", "24", "Red Hair"),
                                   array("Sherman","Caucasian", "Male","29", "Brown Hair"),
                                   array("Lexi","Caucasian","Female","18","Brunette"));
                    ?>               
                </p>
                
                <h3>Extracting the data</h3>
                <p>
                    Now that we understand how multidimensional arrays are built and how they store the data, how do we extract the data?<br>
                    There is more than one way to extract data from a multidimensional array and I will demonstrate two of them today.<br>
                    - The first way is to call a specific index of the array:<br><br>
                    echo $people [1][2]; would display "Male"<br>
                    echo $people [0][0]; would display "Alex"<br>
                </p>
               <?php  
//               echo "[1][2] is:  {$people[1][2]} <br />",
//                    "[0][0] is:  {$people[0][0]}";
                ?>
                <p>
                    The second way to extract data from a multidimensional array is to run it through a loop. The easiest way to accomplish this in PHP is through a foreach loop.</p>
                <p>
                <h3>the syntax to accomplish this would be:</h3>
                foreach ($people as $each_person => $location) {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "$each_person . ";<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach ($location as $i) {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "{$i} < br>";<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "< br>";<br>
                }
                </p>
                <h3>This syntax would output:</h3>
                    
                <?php
                foreach($people as $each_person => $item_number) {
                    echo "$each_person . ";
                    foreach ($item_number as $details){
                        echo "{$details} <br>";
                    }
                    echo "<br>";
                }
                ?>
                </p>
            </main>
            <footer>
                <p>Resources: CodeAcademy.com, Blainerobertson.net, developerdrive.com, w3schools.com</p>
            </footer>
        </div>
    </body>
</html>

