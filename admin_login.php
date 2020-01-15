<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" >
    <title>Admin login</title>
    <link rel="stylesheet" href="css/admin_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
</head>
<body>
<div id="login">
    <form method="post" action="admin_check.php">
     <fieldset>
         <legend>Admin Login</legend>
         <label for="user">Username:</label>
         <input type="text" id="user" name="username" maxlength="30" placeholder="Username" autofocus required><br> <br>
         <label for="password">Password:</label>
         <input type="password" id="password" name="password" maxlength="15" placeholder="Password" autofocus required><br> <br>

         <input type="submit" name="send" value="Login">
         <input type="reset" name="reset" value="Cancel">
     </fieldset>
    </form>
</div>
</body>
</html>