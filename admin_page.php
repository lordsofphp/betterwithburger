<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="robots" content="index,follow" >

        <title>Admin </title>
        <link rel="stylesheet" href="css/admin_page.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    </head>
    <body>
    <div id="header">Administration
       <p> <?php


        $usernames= "";
        $password = "";
        session_start();
        $usernames = $_SESSION["username"];
        $password = $_SESSION["password"];
        echo "$usernames logged in <br>";
        session_reset();

           ?> </p>
    </div>
    <div id="content">
        <div id="nav">
            <label for="show-menu" class="show-menu"><i class="fa fa-bars"></i>&nbsp;Menu</label>
            <input type="checkbox" id="show-menu">
            <ul class="list">
                <li class="list"><a class="link" href="#profile" title="Profiles"><i class="fa fa-folder"></i>Profiles</a></li>

                <li class="list"><a class="link" href="#employee" title="Employees"><i class="fa fa-folder"></i>Employees</a></li>

                <li class="list"><a class="link" href="#products" title="Products"><i class="fa fa-folder"></i>Products</a></li>

                <li class="list"><a class="link" href="#admins" title="Admins"><i class="fa fa-folder"></i>Admins</a></li>

            </ul>
        </div>
        <div id="main">
         <div id="profile">
             <h1 class="head">Profiles</h1>
             <fieldset>
                 <legend>Active Profiles</legend>
                 <?php
                 //LISTING ACTIVE PROFILES
                 include "db_config.php";
                 $sql = "SELECT user_id, user_name FROM users";
                 $result = $conn->query($sql);
                  $user_id="";
                 if ($result->num_rows > 0) {
                     // output data of each row
                     while($row = $result->fetch_assoc()) {
                         $user_id = $row["user_id"];
                         $username = $row["user_name"];
                         echo "
                         <form action='admin_page.php' method='post'>
                          <input type='submit' name='send' value='$user_id - $username'> 
          
                         </form>";
                     }
                 }
                 ?>

             </fieldset>
             <fieldset class="listing">
                 <legend>Profile Info</legend>
                 <?php
                 //LISTING PROFILE INFOES
                 if (isset($_POST["send"])) {
                     $value = $_POST["send"];
                     $value = preg_replace('/[0-9]+ - /', '', $value);
                     include "db_config.php";
                     $sql = "SELECT user_id, user_name, first_name,last_name,email,phone,address FROM users";
                     $result = $conn->query($sql);
                       if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                if ($value == $row["user_name"]) {
                                    $f_name = $row["first_name"];
                                    $l_name = $row["last_name"];
                                    $mail = $row["email"];
                                    $phone = $row["phone"];
                                    $address = $row["address"];
                                    echo "First name: $f_name <br>
                                      Last name: $l_name<br>
                                      Email: $mail <br>
                                      Phone number: $phone <br>
                                      Address: $address<br><br>
                                      <form action='admin_page.php' method='post'>
                          <input type='submit' name='delete' value='Delete - $value'> 
                         </form>";
                                }
                            }

                        }
                    }
                    //DELETING PROFILE
                 if (isset($_POST["delete"])) {
                     $del = $_POST["delete"];
                     $del = str_replace('Delete - ', '', $del);

                     include "db_config.php";
                     $sql = "DELETE FROM users WHERE user_name='$del'";

                     if (mysqli_query($conn, $sql)) {
                         echo "Record deleted successfully";

                     } else {
                         echo "Error deleting record: " . mysqli_error($conn);
                     }

                     mysqli_close($conn);
                 }
                 ?>
             </fieldset>
         </div>
            <div id="employee">
                <h1 class="head">Employees</h1>

                <form action='admin_page.php' method='post'>
                    <input type='submit' name='insert_emp' value='Add employee'>
                </form>
                <br>
                <fieldset>
                    <legend>Active Employees</legend>
                    <?php
                    //LISTING EMPLOYEE
                    include "db_config.php";
                    $sql = "SELECT employe_id, user_name FROM employe";
                    $result = $conn->query($sql);
                    $employe_id="";
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $employe_id = $row["employe_id"];
                            $username = $row["user_name"];
                            echo "
                         <form action='admin_page.php' method='post'>
                          <input type='submit' name='send' value='$employe_id - $username'> 
          
                         </form>";
                        }
                    }
                    ?>

                </fieldset>
                <fieldset class="listing">
                    <legend>Employees Info</legend>
                    <?php
                    //LISTING EMPLOYEE INFOES
                    if (isset($_POST["send"])) {
                        $value = $_POST["send"];
                        $value = preg_replace('/[0-9]+ - /', '', $value);
                        include "db_config.php";
                        $sql = "SELECT employe_id, user_name, first_name,last_name,email,positions FROM employe";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                if ($value == $row["user_name"]) {
                                    $f_name = $row["first_name"];
                                    $l_name = $row["last_name"];
                                    $mail = $row["email"];
                                    $position = $row["positions"];
                                    echo "First name: $f_name <br>
                                      Last name: $l_name<br>
                                      Email: $mail <br>
                                      Position: $position <br><br>
                                      <form action='admin_page.php' method='post'>
                          <input type='submit' name='delete_emp' value='Delete - $value'> 
                          <input type='submit' name='insert_emp' value='Add employee'> 
                         </form>
                                      
                                      ";
                                }
                            }

                        }
                    }
                     //DELETING EMPLOYEE
                    if (isset($_POST["delete_emp"])) {
                        $del = $_POST["delete_emp"];
                        $del = str_replace('Delete - ', '', $del);

                        include "db_config.php";
                        $sql = "DELETE FROM employe WHERE user_name='$del'";

                        if (mysqli_query($conn, $sql)) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }
                     //INSERT EMPLOYEE
                    if (isset($_POST["insert_emp"])) {
                        echo "
                        <form action='admin_page.php' method='post'>
                        Username:
                        <input type='text' name='user_name' required placeholder='Username'> <br>
                        Email:
                        <input type='email' name='email' required placeholder='Email address'><br>
                        Firstname:
                        <input type='text' name='first_name' required placeholder='Firstname'><br>
                        Lastname:
                        <input type='text' name='last_name' required placeholder='Lastname'><br>
                        Password:
                        <input type='password' name='password' required><br>
                        Positions:
                         <select name='position'>
                             <option name=\"kitchen\">kitchen</option>
                             <option name=\"shop\">shop</option>
                             <option name=\"admin\">admin</option>
                             <option name=\"deliver\">deliver</option>
                         </select> 
                         <br><br>
                         <input type='submit' name='insert' value='Insert'> 
                          <input type='reset' name='cancel' value='Cancel'> 
                        </form>";
                    }
                     //INSERT EMPLOYEE PHP
                    if (isset($_POST["insert"])) {
                        define("SALT1", "wtSHSU890381IC4");
                        define("SALT2", "4CITAcywut46a");
                    $user_name = $_POST["user_name"];
                        $email = $_POST["email"];
                        $first_name = $_POST["first_name"];
                        $last_name = $_POST["last_name"];
                        $password = $_POST["password"];
                        $position = $_POST["position"];
                        $password = strip_tags($password);
                        $password_temps = SALT1 . "$password" . SALT2;
                        $password_decrypts = md5($password_temps);

                        include "db_config.php";
                        $sql = "INSERT INTO employe (first_name, last_name, user_name, password,email,positions)VALUES ('$first_name', '$last_name', '$user_name','$password_decrypts','$email','$position')";

                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }
                    ?>
                </fieldset>
            </div>
            <div id="products">
                <h1 class="head">Products</h1>
                <fieldset>
                    <legend>Product types</legend>
                         <form action='admin_page.php' method='post'>
                             <input type='submit' name='send' value='Bread'>
                         </form>
                    <form action='admin_page.php' method='post'>
                        <input type='submit' name='send' value='Meat'>
                    </form>
                    <form action='admin_page.php' method='post'>
                        <input type='submit' name='send' value='Cheese'>
                    </form>
                    <form action='admin_page.php' method='post'>
                        <input type='submit' name='send' value='Sauce'>
                    </form>
                    <form action='admin_page.php' method='post'>
                        <input type='submit' name='send' value='Extras'>
                    </form>

                </fieldset>
                <fieldset class="listing">
                    <legend>Products Info</legend>
                    <?php
                    //LISTING PRODUCTS
                    if (isset($_POST["send"])) {
                        $value = $_POST["send"];
                        include "db_config.php";
                        if ($value == 'Bread') {
                            $sql = "SELECT id_bread,type_name FROM bread_roll";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['type_name'];
                                    $id = $row['id_bread'];
                                    echo "$id - $name <br>";
                                }
                            }
                            echo "<br><hr>
                          <form action='admin_page.php' method='post'>
                          <label for='id'>ID of type name</label>
                          <input type='number' name='id_bread' id='id'>
                          <input type='submit' name='delete_bread' value='Delete type'> <br><hr>
                          <input type='submit' name='insert_bread' value='Add type'> 
                         </form>";
                        }
                        if ($value == 'Meat') {
                            $sql = "SELECT id_meat,type_name FROM meat";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['type_name'];
                                    $id = $row['id_meat'];
                                    echo "$id - $name <br>";
                                }
                            }
                            echo "<br><hr>
                          <form action='admin_page.php' method='post'>
                          <label for='id'>ID of type name</label>
                          <input type='number' name='id_meat' id='id'>
                          <input type='submit' name='delete_meat' value='Delete type'> <br><hr>
                          <input type='submit' name='insert_meat' value='Add type'> 
                         </form>";
                        }
                        if ($value == 'Cheese') {
                            $sql = "SELECT id_cheese,type_name FROM  cheese";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['type_name'];
                                    $id = $row['id_cheese'];
                                    echo "$id - $name <br>";
                                }
                            }
                            echo "<br><hr>
                          <form action='admin_page.php' method='post'>
                          <label for='id'>ID of type name</label>
                          <input type='number' name='id_cheese' id='id'>
                          <input type='submit' name='delete_cheese' value='Delete type'> <br><hr>
                          <input type='submit' name='insert_cheese' value='Add type'> 
                         </form>";
                        }
                        if ($value == 'Sauce') {
                            $sql = "SELECT id_sauce,type_name FROM sauce";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['type_name'];
                                    $id = $row['id_sauce'];
                                    echo "$id - $name <br>";
                                }
                            }
                            echo "<br><hr>
                          <form action='admin_page.php' method='post'>
                          <label for='id'>ID of type name</label>
                          <input type='number' name='id_sauce' id='id'>
                          <input type='submit' name='delete_sauce' value='Delete type'> <br><hr>
                          <input type='submit' name='insert_sauce' value='Add type'> 
                         </form>";
                        }
                        if ($value == 'Extras') {
                            $sql = "SELECT id_extras,type_name FROM extras";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['type_name'];
                                    $id = $row['id_extras'];
                                    echo "$id - $name <br>";
                                }
                            }
                            echo "<br><hr>
                          <form action='admin_page.php' method='post'>
                          <label for='id'>ID of type name</label>
                          <input type='number' name='id_extras' id='id'>
                          <input type='submit' name='delete_extras' value='Delete type'> <br><hr>
                          <input type='submit' name='insert_extras' value='Add type'> 
                         </form>";
                        }

                    }
                     //DELETE BREAD
                    if (isset($_POST["delete_bread"])) {
                        $id = $_POST["id_bread"];

                        include "db_config.php";
                        $sql = "DELETE FROM bread_roll WHERE id_bread='$id'";

                        if (mysqli_query($conn, $sql)) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                     //INSERT BREAD
                    if (isset($_POST["insert_bread"])) {
                        echo "
                        <form action='admin_page.php' method='post'>
                        <label for='bread'>Bread name:</label>
                        <input type='text' id='bread' name='bread_name' required placeholder='Bread name'> <br>
                        <br><br>
                        <input type='submit' name='insert_b' value='Add'> 
                        <input type='reset' name='cancel' value='Cancel'> 
                
                        </form>
                        ";
                    }
                     //INSERT BREAD PHP
                    if (isset($_POST["insert_b"])) {
                        $bread_name = $_POST["bread_name"];

                        include "db_config.php";
                        $sql = "INSERT INTO bread_roll (type_name)VALUES ('$bread_name')";

                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                    //DELETE MEAT
                    if (isset($_POST["delete_meat"])) {
                        $id = $_POST["id_meat"];

                        include "db_config.php";
                        $sql = "DELETE FROM meat WHERE id_meat='$id'";

                        if (mysqli_query($conn, $sql)) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                    //INSERT MEAT
                    if (isset($_POST["insert_meat"])) {
                        echo "
                        <form action='admin_page.php' method='post'>
                        <label for='meat'>Meat name:</label>
                        <input type='text' id='meat' name='meat_name' required placeholder='Meat name'> <br>
                        <br><br>
                        <input type='submit' name='insert_m' value='Add'> 
                        <input type='reset' name='cancel' value='Cancel'> 
                
                        </form>
                        ";
                    }
                    //INSERT MEAT PHP
                    if (isset($_POST["insert_m"])) {
                        $meat_name = $_POST["meat_name"];

                        include "db_config.php";
                        $sql = "INSERT INTO meat (type_name)VALUES ('$meat_name')";

                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                    //DELETE CHEESE
                    if (isset($_POST["delete_cheese"])) {
                        $id = $_POST["id_cheese"];

                        include "db_config.php";
                        $sql = "DELETE FROM cheese WHERE id_cheese='$id'";

                        if (mysqli_query($conn, $sql)) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                    //INSERT CHEESE
                    if (isset($_POST["insert_cheese"])) {
                        echo "
                        <form action='admin_page.php' method='post'>
                        <label for='cheese'>Cheese name:</label>
                        <input type='text' id='cheese' name='cheese_name' required placeholder='Cheese name'> <br>
                        <br><br>
                        <input type='submit' name='insert_c' value='Add'> 
                        <input type='reset' name='cancel' value='Cancel'> 
                
                        </form>
                        ";
                    }

                    //INSERT CHEESE PHP
                    if (isset($_POST["insert_c"])) {
                        $cheese_name = $_POST["cheese_name"];

                        include "db_config.php";
                        $sql = "INSERT INTO cheese (type_name)VALUES ('$cheese_name')";

                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                    //DELETE SAUCE
                    if (isset($_POST["delete_sauce"])) {
                        $id = $_POST["id_sauce"];

                        include "db_config.php";
                        $sql = "DELETE FROM sauce WHERE id_sauce='$id'";

                        if (mysqli_query($conn, $sql)) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                    //INSERT SAUCE
                    if (isset($_POST["insert_sauce"])) {
                        echo "
                        <form action='admin_page.php' method='post'>
                        <label for='sauce'>Sauce name:</label>
                        <input type='text' id='sauce' name='sauce_name' required placeholder='Sauce name'> <br>
                        <br><br>
                        <input type='submit' name='insert_s' value='Add'> 
                        <input type='reset' name='cancel' value='Cancel'> 
                
                        </form>
                        ";
                    }

                    //INSERT SAUCE PHP
                    if (isset($_POST["insert_s"])) {
                        $sauce_name = $_POST["sauce_name"];

                        include "db_config.php";
                        $sql = "INSERT INTO sauce (type_name)VALUES ('$sauce_name')";

                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                    //DELETE EXTRAS
                    if (isset($_POST["delete_extras"])) {
                        $id = $_POST["id_extras"];

                        include "db_config.php";
                        $sql = "DELETE FROM extras WHERE id_extras='$id'";

                        if (mysqli_query($conn, $sql)) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }

                    //INSERT EXTRAS
                    if (isset($_POST["insert_extras"])) {
                        echo "
                        <form action='admin_page.php' method='post'>
                        <label for='extras'>Extra name:</label>
                        <input type='text' id='extras' name='extras_name' required placeholder='Extra name'> <br>
                        <br><br>
                        <input type='submit' name='insert_e' value='Add'> 
                        <input type='reset' name='cancel' value='Cancel'> 
                
                        </form>
                        ";
                    }

                    //INSERT EXTRAS PHP
                    if (isset($_POST["insert_e"])) {
                        $extras_name = $_POST["extras_name"];

                        include "db_config.php";
                        $sql = "INSERT INTO extras (type_name)VALUES ('$extras_name')";

                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }


                    ?>

                </fieldset>
            </div>
            <div id="admins">
                <h1 class="head">Admins</h1>
                <form action='admin_page.php' method='post'>
                    <input type='submit' name='insert_adm' value='Add admin'>
                </form>
                <br>
                <fieldset>
                    <legend>Active Admins</legend>
                    <?php
                    //LISTING ACTIVE ADMINES
                    include "db_config.php";
                    $sql = "SELECT admin_id, user_name FROM admin";
                    $result = $conn->query($sql);
                    $admin_id="";
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $admin_id = $row["admin_id"];
                            $usernameadmin = $row["user_name"];
                            echo "
                         <form action='admin_page.php' method='post'>
                          <input type='submit' name='send' value='$admin_id - $usernameadmin'> 
          
                         </form>";
                        }
                    }
                    ?>

                </fieldset>
                <fieldset class="listing">
                    <legend>Admin Info</legend>
                    <?php
                    //LISTING ADMIN INFOES
                    if (isset($_POST["send"])) {
                        $value = $_POST["send"];
                        $value = preg_replace('/[0-9]+ - /', '', $value);
                        include "db_config.php";
                        $sql = "SELECT admin_id, user_name,password,email  FROM admin";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                if ($value == $row["user_name"]) {
                                    $emailadmin = $row["email"];
                                    echo "Email: $emailadmin <br>
                                  
                                   
                                      <form action='admin_page.php' method='post'>
                          <input type='submit' name='delete_admin' value='Delete - $value'> 
                          <input type='submit' name='insert_adm' value='Add admin'> 
                         </form>";
                                }
                            }

                        }
                    }
                    //DELETING ADMINS
                    if (isset($_POST["delete_admin"])) {
                        $del = $_POST["delete_admin"];
                        $del = str_replace('Delete - ', '', $del);
                        include "db_config.php";
                        if($usernames == $del){
                            echo "Error deleting $del because that profile is already logged in!";
                        }
                        else {
                        $sql = "DELETE FROM admin WHERE user_name='$del'";

                        if (mysqli_query($conn, $sql)) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }
                    }
                    //INSERT ADMIN
                    if (isset($_POST["insert_adm"])) {
                        echo "
                        <form action='admin_page.php' method='post'>
                        <label for='usernameadmin'>Username:</label>
                        <input type='text' id='usernameadmin' name='user_name_admin' required placeholder='Username'> <br>
                        <label for='emailadmin'>Email:</label>
                        <input type='email' id='emailadmin' name='email_admin' required placeholder='Email address'><br>
                        <label for='passwordadmin'>Password:</label>
                        <input type='password' id='passwordadmin' name='password_admin' placeholder='Password' required><br>                
                        <br><br>
                        <input type='submit' name='insert_admin' value='Insert'> 
                        <input type='reset' name='cancel' value='Cancel'> 
                        </form>";
                    }

                    //INSERT ADMIN PHP
                    if (isset($_POST["insert_admin"])) {
                        define("SALT1", "wtSHSU890381IC4");
                        define("SALT2", "4CITAcywut46a");
                        $user_name_admin = $_POST["user_name_admin"];
                        $email_admin = $_POST["email_admin"];
                        $password_admin = $_POST["password_admin"];
                        $password_admin = strip_tags($password_admin);
                        $password_temp = SALT1 . "$password_admin" . SALT2;
                        $password_decrypt = md5($password_temp);

                        include "db_config.php";
                        $sql = "INSERT INTO admin (user_name,password,email)VALUES ('$user_name_admin','$password_decrypt','$email_admin')";

                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    }
                    ?>
                </fieldset>
        </div>
    </div>
    </body>
    </html>