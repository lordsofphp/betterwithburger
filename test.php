<?php
include 'db_config.php';
/*$i=0;
while ($i<5) {
    echo "<input type='checkbox' name='sauce' value='ajiow'>Senf<br>";
    $i++;
}*/


        include 'db_config.php';

     echo "<form action='order_check.php' method='post'>";
        //BREAD KIIRATAS
        $sql = "SELECT id_bread,type_name FROM bread_roll";
        $result = $conn->query($sql);
         echo "<label for='breadroll'>Choose your bread:</label>";
        echo "<select name='breadroll' id='breadroll'>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['id_bread'] ."'>" . $row['type_name'] ."</option>";
        }
        echo "</select><br><br>";
        //MEAT KIIRATAS
        $sql = "SELECT id_meat,type_name FROM meat";
        $result = $conn->query($sql);
        echo "<label for='meat'>Choose your meat:</label>";
        echo "<select name='meat' id='meat'>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['id_meat'] ."'>" . $row['type_name'] ."</option>";
        }
        echo "</select><br><br>";
        //CHEESE KIIRATAS
        $sql = "SELECT id_cheese,type_name FROM cheese";
        $result = $conn->query($sql);
        echo "<label for='cheese'>Choose your cheese:</label>";
        echo "<select name='cheese' id='cheese'>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['id_cheese'] ."'>" . $row['type_name'] ."</option>";
        }
        echo "</select><br><br>";
        ?>
        <?php
        //SAUCE KIIRATAS
        $sql = "SELECT id_sauce,type_name FROM sauce";
        $result = $conn->query($sql);
        echo "<label for='sauce'>Choose your sauce:<br></label>";
        while ($row = mysqli_fetch_array($result)) {
         //  echo"<input type='checkbox' name='sauce' value='" . $row['id_sauce'] ."'>" . $row['type_name'] ."<br>";
            echo"<input type='checkbox' name='sauce' value='ajiow'>Senf<br>";
        }
        ?>
