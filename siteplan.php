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
        <h1>Site Plan</h1>
        <h2>Site Title: Kate Nelson Photography.</h2>
        <h3>Site Purpose:</h3>
        <p>
            The Purpose of Kate Nelson Photography is for existing clients and pursuing clients to visit the site, look at the work of Kate Nelson, and be able to contact her for further information or to set up a photography session. The site will be able to be managed by Kate Nelson who has no coding background at all. She will be able to change, add, and delete photos as needed. 
        </p>
        <h3>Target Audience:</h3>
        <p>
            The Target audience for the web site will be photography customers, and family and friends of Kate who want to see her work. The age will be anywhere from 15 - 70. 
        </p>
        <h4>Home page</h4>
        <ul id="home-diagrams">
            <li><img id="siteimg" src="/photos/browserhome.jpg" alt="browser home page"></li>
            <li><img id="siteimg" src="/photos/ipadlandhome.jpg" alt="ipad landscape homepage"></li>
            <li><img id="siteimg" src="/photos/phonehome.jpg" alt="iphone homepage"></li>
        </ul>
        <h4>Gallery Page</h4>
        <ul id="snow-diagrams">
            <li><img id="siteimg" src="/photos/browsersnow.jpg" alt="snowboarding browser"></li>
            <li><img id="siteimg" src="/photos/ipadportsnow.jpg" alt="ipad portrait snowboard page"></li>
            <li><img id="siteimg" src="/photos/phonesnow.jpg" alt="iphone snowboard page"></li>
        </ul>
    </li> 
    <h3>Persona:</h3>
    <ol>
        <li>Basic Demographics
            <ol>
                <li>Age: 19</li> 
                <li>Occupation: Subway</li>
                <li>Education: High school Student</li>
                <li>Income: $2,000 a year</li>
            </ol>
        </li>
        <li>Personal
            <ol>
                <li>Name: Brianna Thompson</li>
                <li><img id="briannasite" src="/photos/bri.jpg" alt="Photo of Jeremy Francis"></li>
                <li>Description: Brianna Thompson is a Senior at Idaho Falls High school who needs senior pictures taken. </li>
            </ol>
        </li>
        <li>Technical profile
            <ol>
                <li>Preferred OS: MacOSX</li>
                <li>Browser: Chrome</li>
                <li>Internet skill: Intermediate</li>
                <li>Favorite sites: Facebook.com, youtube.com, pinterest.com</li>
            </ol>
        </li>
        <li>Personal
            <ol>
                <li>Name: Stephanie Egbert</li>
                <li><img id="briannasite" src="/photos/stephanie.jpg" alt="Photo of Stephanie Egbert"></li>
                <li>Description: Stephanie Egbert is a Mom in Idaho Falls who needs family pictures taken. </li>
            </ol>
        </li>
        <li>Technical profile
            <ol>
                <li>Preferred OS: Windows</li>
                <li>Browser: Chrome</li>
                <li>Internet skill: Beginner</li>
                <li>Favorite sites: Facebook.com, youtube.com, pinterest.com</li>
            </ol>
        </li>
        <li>Audience Goals: The user heard about my website from some High school class mates. She has come too look at the photos Kate Nelson has taken, and contact her for pricing and a time.</li>
        <li>Business Goals: Every Gallery that the user see's, I want them to be able to be in love with the photos that they see.</li>
    </ol>
    <h3>Scenario 1</h3>
    <ol>
        <li>I need to get some senior pictures taken, and maybe even some family photos as well, is there any local photographers around Idaho Falls that does a good job?.</li>
        <li>Kate Nelson does an awesome job at all types of photography, you could visit her webiste at KateNelsonPhoto.com and see what you think of her work.</li>
    </ol> 
    <h3>Scenario 2</h3>
    <ol>
        <li>I need to get some family pictures taken, and maybe even some personal photos as well, is there any local photographers around Idaho Falls that does a good job?.</li>
        <li>Kate Nelson does an awesome job at all types of photography, you could visit her webiste at KateNelsonPhoto.com and see what you think of her work.</li>
    </ol> 
    <h3>Scenario 3</h3>
    <ol>
        <li>I need to get some animal pictures taken, is there any local photographers around Idaho Falls that does a good job?.</li>
        <li>Kate Nelson does an awesome job at all types of photography, you could visit her webiste at KateNelsonPhoto.com and see what you think of her work.</li>
    </ol> 
    <h3>Scenario 4</h3>
    <ol>
        <li>I need to get some nature pictures taken,  is there any local photographers around Idaho Falls that does a good job?.</li>
        <li>Kate Nelson does an awesome job at all types of photography, you could visit her webiste at KateNelsonPhoto.com and see what you think of her work.</li>
    </ol> 
    <h3>Scenario 5</h3>
    <ol>
        <li>I need to get some child pictures taken, is there any local photographers around Idaho Falls that does a good job?.</li>
        <li>Kate Nelson does an awesome job at all types of photography, you could visit her webiste at KateNelsonPhoto.com and see what you think of her work.</li>
    </ol> 
    <h3>Scenario 6</h3>
    <ol>
        <li>I need to get some portraits taken, is there any local photographers around Idaho Falls that does a good job?.</li>
        <li>Kate Nelson does an awesome job at all types of photography, you could visit her webiste at KateNelsonPhoto.com and see what you think of her work.</li>
    </ol> 
    <h3>Content Architecture</h3>
    <h4>Home Page</h4>
    <p>
        The Home Page will be the basic information you would expect from a home page, it will describe everything about the site, what is included in the site, include a Photo that Kate Nelson has taken, and will be inviting to the customer.
    </p>
    <h4>Galleries Page</h4>
    <p>
        This page will include thumbnail links that will take the user to each gallery content page. The content of this page will be the sole purpose to get the user into the actual galleries for each section.
    </p>
    <h4>About Page</h4>
    <p>
        This Page will have a description about Kate Nelson herself. Her background, what she loves, and why she does photography. This will help the customer understand who they will be working with if they decide to have Kate take their photos. 
    </p>
    <h4>Contact Page</h4>
    <p>
        This page will include options for customers to contact Kate Nelson. It will have her e-mail, Facebook link, and a link to her Instagram page. 
    </p>
    <h4>Portraits Gallery</h4>
    <p>
        This page will contain the Gallery for general Portraits that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>Couples Gallery</h4>
    <p>
        This page will contain the Gallery for Couples Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>Family Gallery</h4>
    <p>
        This page will contain the Gallery for Family Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>Children Gallery</h4>
    <p>
        This page will contain the Gallery for Children Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>Nature Gallery</h4>
    <p>
        This page will contain the Gallery for Nature Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>Seniors Gallery</h4>
    <p>
        This page will contain the Gallery for Senior Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>Still Life Gallery</h4>
    <p>
        This page will contain the Gallery for Still Life Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>Weddings Gallery</h4>
    <p>
        This page will contain the Gallery for Wedding Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>Animals Gallery</h4>
    <p>
        This page will contain the Gallery for Animal Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
    <h4>My Life Gallery</h4>
    <p>
        This page will contain the Gallery for Life photos Photos that Kate Nelson has taken. It will include a Slide show of images that the user can browse through and learn to love. 
    </p>
</main>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</footer>
</body>
</html>


