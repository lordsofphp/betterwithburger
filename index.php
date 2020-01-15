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
    <meta name="googlebot" content="index,follow" >
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


    <title>Life is better with Burger</title>
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
                               <form action="index.php" method="post">
                <input type="submit" id="regbutton" name="myorders" value="My Orders">
            </form>
                               <hr>
                                <form action="index.php" method="post">
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
                <?php
                if (isset($_GET['l']))
                    $l = $_GET['l'];
                else
                    $l = "";

                if ($l == "1")
                    echo "<span style='color: crimson; font-size: 12px'>One of fields are not filled!</span>";
                if ($l == "2")
                    echo "<span style='color: crimson; font-size: 12px'>Wrong username or password!</span>";
                ?>
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

        <?php
        if(isset($_POST['reg']) or isset($_GET['p'])){
            echo "<div id=\"regdiv\">
<div class=\"reg_error\">";
            if (isset($_GET['p']))
                $p = $_GET['p'];
            else
                $p = "";

            if ($p == "1")
                echo "Firstname required!";
            if ($p == "2")
                echo "Laststname required!";
            if ($p == "3")
                echo "Username required!";
            if ($p == "4")
                echo "Password required!";
            if ($p == "5")
                echo "Verification password required!";
            if ($p == "6")
                echo "Email required!";
            if ($p == "7")
                echo "Phone required!";
            if ($p == "8")
                echo "Address required!";
            if ($p == "9")
                echo "City required!";
            if ($p == "10")
                echo "Error in firstname field!";
            if ($p == "11")
                echo "Error in Lastname field!";
            if ($p == "12")
                echo "Error in username field!";
            if ($p == "13")
                echo "Error in password field!";
            if ($p == "14")
                echo "Error in phone field!";
            if ($p == "15")
                echo "Error in city field!";
            if ($p == "16")
                echo "This email or username already exist! ";
            if ($p == "17")
                echo "<span style='color: green'>You are registered!</span> ";
            if ($p == "18")
                echo "Something went wrong! Please try again! ";
            echo <<< EOT

</div>
    
<form method="post" action="registration.php">
	<h2>Registration:</h2>
		<label for="fn">First name:</label>
		<input type="text" name="fn" id="fn" maxlength="30" size="15" placeholder="First Name" autofocus>
		<b>Allowed:Only letters</b>
		<br><br>
		<label for="ln">Last name:</label>
		<input type="text" name="ln" id="ln" maxlength="30" size="15" placeholder="Last Name" autofocus>
		<b>Allowed:Only letters</b>
		<br><br>
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" maxlength="30" size="15" placeholder="Username" autofocus>
		<b>Allowed:Only letters and numbers</b>
		<br><br>
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" minlength="8" maxlength="15" size="15" placeholder="Password" autofocus>
		<b>Allowed:Letters, numbers, characters</b>
		<br><br>
		<label for="password2">Confirm Password:</label>
		<input type="password" name="password2" id="password2" maxlength="15" size="15" placeholder="Confirm Password" autofocus>
		<b>Retype password</b>
		<br><br>
		<label for="email">Email:</label>
		<input type="email" name="email" id="email" maxlength="40" size="15" placeholder="Email" autofocus>
		<br><br>
		<label for="phone">Phone:</label>
		<input type="text" name="phone" id="phone" maxlength="15" size="15" placeholder="Phone" autofocus>
		<b>Allowed:only numbers</b>
		<br><br>
		<label for="address">Address:</label>
		<input type="text" name="address" id="address" maxlength="40" size="15" placeholder="Address" autofocus>
	    <b>Street name and house number</b>
	    <br><br>
		<label for="city">City:</label>
		<input type="text" name="city" id="city" maxlength="30" size="15" placeholder="City" autofocus>
		<br><br>
		<input type="submit" name="sb" value="Send">
		<input type="reset"  name="rg" value="Cancel">
</form>
</div>
EOT;

        }
        if(isset($_POST['myorders'])){
            echo <<< EOT
            <div id="myorders">
            <fieldset id="myorder_field">
            <legend>My Orders</legend>
EOT;
            $username = $_SESSION['username'];
            $sql = "SELECT user_id,first_name, last_name, user_name, password,email,phone, address,city FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    if ($row["user_name"] == $username) {
                        $firstname = $row["first_name"];
                        $lastname = $row["last_name"];
                    }
                }
            }

            $sql = "SELECT  order_id,bread_roll, meat, cheese, sauce,extras,first_name, last_name,phone FROM orders";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    if ($row["last_name"] == $lastname and $row["first_name"] == $firstname) {
                        $order_id = $row["order_id"];
                        $bread = $row["bread_roll"];
                        $meat = $row["meat"];
                        $cheese = $row["cheese"];
                        $sauce = $row["sauce"];
                        $extras = $row["extras"];
                        echo "
                        $order_id - $bread, $meat, $cheese, $sauce, $extras<br>";
                    }
                }
            }

            echo "
</fieldset>
            </div>";

        }

        else{
            echo <<< EOT
<img id="logo" src="pics/burgerlogo.jpg" alt="Burger">
        <p class="text">A hamburger (short: burger) is a sandwich consisting of one or more cooked patties of ground meat, usually beef, placed inside a sliced bread roll or bun.
            The patty may be pan fried, grilled, or flame broiled. Hamburgers are often served with cheese, lettuce, tomato, onion, pickles, bacon, or chiles; condiments such as ketchup, mayonnaise, mustard, relish, or "special sauce"; and are frequently placed on sesame seed buns. A hamburger topped with cheese is called a cheeseburger.</p>
EOT;
        }
        ?>
    </div>
    <div id="banners">
        <h1 class="bannCaps">Lets see other websites in this project!</h1>
        <div id="bann">
            <a href="http://doggiefood.000webhostapp.com/" target="_blank" title="Visit Doggie Food">
                <img class="bannerImg" src="pics/petsWeb.gif" alt="Doggie Food">
            </a>
        </div>
        <div id="bann">
            <a href="http://www.driedfruits.nhely.hu/index.html" target="_blank" title="Visit Dried Fruits">
                <img class="bannerImg" src="pics/bannerNorbi.gif" alt="Dried Fruits Banner">
            </a>
        </div>
        <div id="bann">
            <a href="http://handmadesoaps.000webhostapp.com" target="_blank" title="Visit Handmade soaps">
                <img class="bannerImg" src="pics/bannerHandmadeSoap.gif" alt="Handmade soaps">
            </a>
        </div>
        <div id="bann">
            <a href="http://www.kulcstartok.nhely.hu" target="_blank" title="Visit Keychains">
                <img class="bannerImg" src="pics/bannerKeychains.gif" alt="Keychains">
            </a>
        </div>
    </div>
</div>
<div class="clear"></div>
<div>
    <div id="footer">
        <p>
            This is a school project.<br>
            © <?php
            $date = date('Y');
            echo $date;
            ?>
            <br>Csaba Liscsevity and David Varga<br>All rights reserved.<br>
            <a href="admin_login.php" name="Admin login" target="_blank">Admin login</a>

    </div>
</div>
</body>
</html>