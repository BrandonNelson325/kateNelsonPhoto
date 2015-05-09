<?php
if (!$_SESSION) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="author" content= "Brandon Nelson">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, macimum-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/main.css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src='../js/galleriesjs.js'></script>
        <title><?php echo $title ?></title>
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?> 
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/nav/nav.php'; ?>
        </header>
    <main>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        } else {
            if ($errors) {
                $loop = '<ul id="error">';
                foreach ($errors as $value) {
                    $loop.= '<i>' . $value . '</li>';
                }
                $loop .= '</ul>';
            }
        }
        ?>
        <h2>Style Guide</h2>
            <h3>Color Scheme</h3>
            <p>The different colors used on KateNelsonPhoto.com are:</p>
            <br>
            <ul id="colors">
                <li>
                    <div class="swatch" style="background: #FF995C;"></div>
                    hex: #FF995C
                    <br>
                    rgb(255,153,92)
                </li>
                <li>
                    <div class="swatch" style="background: #ACD6F2;"></div>
                    hex: #ACD6F2
                    <br>
                    rgb(172,214,242)
                </li>
                <li>
                    <div class="swatch" style="background: #EFFF6C;"></div>
                    hex: #EFFF6C
                    <br>
                    rgb(239,255,108)
                    <br>
                </li>
                <li>
                    <div class="swatch" style="background: #FFC65B;"></div>
                    hex: #FFC65B
                    <br>
                    rgb(255,198,91)
                </li>
                <li>
                    <div class="swatch" style="background: #D3D3D4;"></div>
                    hex: #D3D3D4
                    <br>
                    rgb(211,211,212)
                </li>
                <li>
                    <div class="swatch" style="background: #FFF;"></div>
                    hex: #FFFFFF
                    <br>
                    rgb(255,255,255)
                </li>
            </ul>
            <br>
            <ul>
                <li>The color of my main body text will be #000000: Black.</li>
                <li>The Color of my headings will be #D3D3D4: Light Gray. </li>
                <li>My Links, When hovered over will be #EFFF6C.</li>
                <li>My Logo contains all of the above colors, to match with the style guide.</li>                       
            </ul>

            <h3>Typography On KateNelsonPhoto.com</h3>

            <table id ="typography">
                <tr>
                    <td><strong>Item</strong></td>
                    <td><strong>Font</strong></td>
                    <td><strong>Color</strong></td>
                    <td><strong>line-height</strong></td>
                </tr>
                <tr>
                    <td>Main Navigation</td>
                    <td>"arial black, 20px"</td>
                    <td>"#FFFFF, white."</td>
                    <td>height: 30px</td>
                </tr>
                <tr>
                    <td>H1</td>
                    <td>"arial black, 40px"</td>
                    <td>"#F55E33."</td>
                    <td>height: 58px</td>
                </tr>
                <tr>
                    <td>H2</td>
                    <td>"italic, 35px"</td>
                    <td>"#F55E33."</td>
                    <td>height: 50px</td>
                </tr>
                <tr>
                    <td>H3</td>
                    <td>"italic, 25px"</td>
                    <td>"#F55E33."</td>
                    <td>height: 35px</td>
                </tr>
                <tr>
                    <td>Default paragraph text</td>
                    <td>"default, 20px."</td>
                    <td>"#000000, black."</td>
                    <td>height: 30px</td>
                </tr>
                <tr>
                    <td>Sidebar Navigation</td>
                    <td>"arial black, 20px"</td>
                    <td>"#000000, black."</td>
                    <td>height: 30px</td>
                </tr>
            </table>

            <h3>Navigation</h3>
            <ul>
                <li>Location: The location will be at across the top of the page, and clearly visible.</li>
                <li>Size: 29px tall </li>
                <li>Behavior: when the mouse scrolls over the links, it will highlight to "#EFFF6C" light yellow." </li>
            </ul>
            <h3>Graphics</h3>

            <ul>
                <li>My content will all be inside of a div that takes up most of the main section of the page.                   </li>
                <li>The sizes of my images will be big enough to be seen in good detail, but not to big as to be                 obnoxious</li>
                <li>Most of my images will be placed within the content and organized accordingly.</li>
            </ul>
    </main>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
    </footer>
    </body>
</html>


