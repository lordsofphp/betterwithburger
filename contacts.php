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


    <title>Contacts</title>
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
                                <form action="contacts.php" method="post">
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
                <form action="contacts.php" method="post">
                    <input type="submit" id="regbutton" name="reg" value="Registration">
                </form>
            </div>

            <?php
        }
        ?>

    </div>
<div id="main">
    <p class="bar">Contacts</p>
    <br>
    <div id="members">
        <img class="member_pic" src="pics/david_varga.jpg" alt="David Varga">
    David Varga<br>
    <h1 class="member_caps">Technical Communication Management</h1>
        <h1 class="member_caps">Subotica Tech - College of Applied Sciences</h1>
        <h1 class="member_caps"><i class="fa fa-envelope"></i>davidstube97@gmail.com</h1><br><br>
    <hr><br>
        <img class="member_pic" src="pics/csaba_liscsevity.jpg" alt="Csaba Liscsevity">
    Csaba Liscsevity<br>
        <h1 class="member_caps">Internet and E-Commerce</h1>
            <h1 class="member_caps">Subotica Tech - College of Applied Sciences</h1>
                <h1 class="member_caps"><i class="fa fa-envelope"></i>csabaliscsevity@yahoo.com</h1><br><br>
        <hr><br>
        <h1 class="project">This is a school project of E-Commerce subject. (5th semester)</h1>
    </div>
</div>
</div>
<div class="clear"></div>
<br>
<br>
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