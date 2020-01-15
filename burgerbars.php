<!DOCTYPE html>
<html lang="en">
<?php
require 'Mobile_Detect.php';
// https://www.php.net/manual/en/features.cookies.php
$side='';
$detect = new Mobile_Detect;
$device = ($detect->isMobile()? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

if ($detect->isiOS() or $detect->isAndroidOS()) {
    $side='touch';
}
else {
    $side='style';
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index,follow" >
    <meta name="author" content="Liscsevity Csaba and Varga David">
    <meta name="keywords" content="HTML,CSS,PHP,Hamburgers,Burgers, Life is better with burger,Hamburgers,better with">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <meta http-equiv="content-language" content="hu">
    <meta name="description" content="This is a website for Hamburgers.">

    <meta property="og:image" content="http://betterwithburger.000webhostapp.com/pics/burgerlogo.jpg">
    <meta property="og:image:width" content="150" />
    <meta property="og:image:height" content="75" />
    <meta property="og:url" content="http://betterwithburger.000webhostapp.com/">
    <meta property="og:type" content="Home-Life is better with Burger">
    <meta property="og:title" content="Hamburgers">
    <meta property="og:site_name" content="Life is better with Burger">
    <meta property="og:description" content="If you want the know something about Hamburgers or want to eat please visite our website.Best burgers of all time.">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-151763050-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-151763050-1');
    </script>


    <title>Burger Bars</title>
    <link rel="stylesheet" href="css/<?php
    echo "$side";?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
</head>
<body>
<div id="header"></div>
<div id="content">
    <div id="nav">
        <label for="show-menu" class="show-menu"><i class="fa fa-bars"></i>&nbsp;Menu</label>
        <input type="checkbox" id="show-menu">
        <ul class="list">
            <li class="list"><a class="link" href="index.php" title="Home"><i class="fa fa-home"></i>Burger Home</a></li>

            <li class="list"><a class="link" href="burgerhistory.php" title="History"><i class="fa fa-history"></i>Burger History</a></li>

            <li class="list"><a class="link" href="burgerbars.php" title="Bars"><i class="fa fa-map-signs"></i>Burger Bars</a></li>

            <li class="list"><a class="link" href="burgers.php" title="Burgers"><i class="fa fa-folder"></i>Burgers</a></li>

            <li class="list"><a class="link" href="contacts.php" title="Contacts"><i class="fa fa-id-badge"></i>Contacts </a></li>
            <?php
            session_start();
            if(isset($_POST['logout'])){
                unset($username);
                unset($_SESSION['username']);
                session_destroy();
                //header("Location:index.php");
            }
            if (!empty($_SESSION['username'])) {
                echo <<<EOT
            <li class="list"><a class="link" href="order.php" title="Order"><i class="fa fa-folder"></i>Order!</a></li>
EOT;

            }
            ?>
        </ul>
        <?php
        if (!empty($_SESSION['username'])) {
            include "db_config.php";
            $username = $_SESSION['username'];
            $sql = "SELECT user_id,first_name, last_name, user_name, password,email,phone, address,city FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    if ($row["user_name"] == $username) {
                        $firstname = $row["first_name"];
                        echo <<< EOT
                      <div id="profilediv">
Welcome $firstname<br>
                               <span style='font-size: 10px; color: green'>You are logged in</span>
                               <br>
                               My Profile<br>
                               My orders<br>
                               <hr>
                                <form action="burgerbars.php" method="post">
                <input type="submit" id="regbutton" name="logout" value="Logout">
            </form>
                               </div>
                               
EOT;


                    }
                }
            }

        }
        else {

            ?>
            <div id="logindiv">
                <h3>Login</h3>
                <form action="login.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" maxlength="30" size="25" placeholder="username" autofocus>
                    <br><br>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" maxlength="15" size="25" placeholder="password" autofocus>
                    <br><br>
                    <input type="submit" name="sb" value="Send">
                    <input type="reset" name="rg" value="Cancle">
                    <br>
                    <br>
                </form>
                <form action="index.php" method="post">
                    <input type="submit" id="regbutton" name="reg" value="Registration">
                </form>
            </div>

            <?php
        }
        ?>

    </div>
    <div id="main">
        <p class="bar">Burger Bars in Serbia:</p>
        <br>
            <div id="bars" >
                <div>
                <b>Fabrika Burger Bar</b>
                <br>
                <h1 class="barsCaps">Location:Serbia,Subotica</h1>
                <img class="bar_pics" alt="Fabrika Burger Bar" src="https://media-cdn.tripadvisor.com/media/photo-s/11/29/95/9b/fabrika-burger-bar.jpg"/><br/>
                    <h1 class="barsSmallCaps">All rights reserved to TripAdvisor Serbia for the picture</h1>
                <div >
                    <iframe class="g_map" src="https://maps.google.com/maps?q=Fabrika%20Burger%20bar&t=&z=13&ie=UTF8&iwloc=&output=embed" marginwidth="0"></iframe>
                </div>
                <a class="link" href="http://fabrikaburgerbar.rs/" target="_blank" title="Fabrika Burger Bar"><h1 class="barsCaps">Go to Website</h1></a><hr class="spacing">
                </div>
                <div>
                    <b>BG Burger Bar</b>
                    <br>
                    <h1 class="barsCaps">Location:Serbia,Beograd</h1>
                    <img class="bar_pics" src="pics/bg_burger.jpg" alt="Location of BG Burger">
                    <h1 class="barsSmallCaps">All rights reserved to Graphic Beast Serbia for the picture</h1>
                    <div >
                        <iframe class="g_map" src="https://maps.google.com/maps?q=bg%20burger%20bar&t=&z=13&ie=UTF8&iwloc=&output=embed" marginwidth="0"></iframe>
                    </div>
                    <a class="link" href="https://bgburgerbar.com/" title="BG Burger Bar" target="_blank"><h1 class="barsCaps">Go to Website</h1></a><hr class="spacing">
                </div>
                <div>
                    <b>Brunch Burger Bar</b>
                    <br>
                    <h1 class="barsCaps">Location:Serbia,Novi Sad</h1>
                    <img class="bar_pics" src="pics/brunch_burger_bar.jpg" alt="Location of Brunch Burger">
                    <h1 class="barsSmallCaps">All rights reserved to mojnovisad.com for the picture</h1>
                    <div >
                        <iframe class="g_map" src="https://maps.google.com/maps?q=brunch%20burger%20bar&t=&z=13&ie=UTF8&iwloc=&output=embed" marginwidth="0"></iframe>
                    </div>
                    <a class="link" href="https://brunchburgerbar.rs/" title="Brunch Burger Bar" target="_blank"><h1 class="barsCaps">Go to Website</h1></a><hr class="spacing">
                </div>
                </div>
        </div> <br><br>
</div>
<div class="clear"></div>
<div id="footer">
    <p>
        This is a school project.<br>
        © <?php
        $date = date('Y');
        echo $date;
        ?>
        <br>Csaba Liscsevity and David Varga<br>All rights reserved.

</div>
</body>
</html>