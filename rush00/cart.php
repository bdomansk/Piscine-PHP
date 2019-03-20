<?php
include 'functions.php';

session_start();

if (!isset($_SESSION['user_id']))
{
    $_SESSION['user_id'] = rand(999, 99999999);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - Snikers Shop</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/logo/logo.jpg">
</head>
<body>

<div class="ct">
    <div class="header">
        <a href="index.php">
            <h1>Sneakers</h1>
        </a>
        <?php
        include_once 'functions.php';
        session_start();
        if (($fd = fopen("db/cats.csv", "r")) !== FALSE)
        {
            $i = 0;
            while (($arr = fgetcsv($fd, 0, ";")) !== FALSE && $i < 5)
            {
               
                if (isset($arr) && isset($arr[0]))
                {
                    if ($i === 0)
                    {
                        echo "<a href=\"category.php?cat_id=all\"> All </a>\n";
                    }
                    echo "<a href=\"category.php?cat_id=".$arr[0]."\">".$arr[1]."</a>\n";
                }
                $i++;
            }
        fclose($fd);
        }
        if ($_SESSION['loggued_on_user']) {
            if ($_SESSION['loggued_on_user'] === "admin")
            {
                 echo "<a href=\"a_cats_list.php\" >Admin</a>\n";
                 echo "<a href=\"cart.php\">"."<img class=\"basket3\" src=\"img/adm/basket.png\">"."</a>";
                echo "<a href=\"logout.php\">"."<img class=\"logout2\" src=\"img/adm/logout.png\">"."</a>";
            }
            else{
                echo "<a href=\"cart.php\">"."<img class=\"basket\" src=\"img/adm/basket.png\">"."</a>";
                echo "<a href=\"logout.php\">"."<img class=\"logout\" src=\"img/adm/logout.png\">"."</a>";
            }   
        }
        else {
            echo "<div class=\"login\" >";
            echo "<a href=\"cart.php\">"."<img class=\"basket2\" src=\"img/adm/basket.png\">"."</a>";
            echo "<a href=\"login.php\"> LOGIN </a>";
            echo "</div>";
        }
     ?>   
    </div>
    <div class="main">
        <div class="menu">
            <a href="/">Main Page</a>
<?php
if (($fd = fopen("db/cats.csv", "r")) !== FALSE)
{
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if (isset($arr) && isset($arr[0]))
            echo "\t\t\t"."<a href=\"/category.php?cat_id=".$arr[0]."\">".$arr[1]."</a>"."\n";
    }
    fclose($fd);
}

echo "<br><br>";

if (empty($_SESSION['loggued_on_user']))
{
    echo "<br>\n\t\t\t<form action=\"login_x.php\" method=\"GET\">
    \n\t\t\t\tLogin: <input type=\"text\" name=\"login\"><br><br>
    \n\t\t\t\tPass: <input type=\"password\" name=\"pass\"><br><br>
    \n\t\t\t\t<input type=\"submit\" name=\"submit\" value=\"LOGIN\">
    \n\t\t\t</form>";
}
else
{
    if ($_SESSION['cart_av'] != 0)
        echo "<a href='cart.php'><img src='img/cart.png' style='width: 75px; height: auto;'></a>";
    echo "\n\t<p style='font-size: 13px;'><br>Hello <b style='font-size: 14px; font-weight: bold;'>".$_SESSION['loggued_on_user']."</b>!</p>";
    if ($_SESSION['loggued_on_user'] == "admin")
        echo "\n\t<a href='/a_cats_list.php' style='color: green;'>Admin_Panel</a>";
    echo "\n\t<a href='/logout.php' style='color: red;'>LogOut!</a>";
}

?>
        </div>
        <div class="content">
<?php

$login_cart = what_log("db/cart.csv");
if ($_SESSION['loggued_on_user'] != "admin")
    echo "<h3 class='clear lower'>List of your items ".strtoupper($login_cart).":</h3>";
else
    echo "<h3 class='clear lower'>List items of user ".strtoupper($login_cart).":</h3>";

if (($fd = fopen("db/cart.csv", "r")) !== FALSE)
{
    $total_price = 0;
    $ch = 0;
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if (isset($arr[0]) && !empty($arr[0]))
        {
            if (($fd2 = fopen("db/items.csv", "r")) !== FALSE) 
            {
                while (($arr2 = fgetcsv($fd2, 0, ";")) !== FALSE)
                {
                    if (isset($arr2) && isset($arr2[0]) && $arr2[0] == $arr[1])
                    {
                        echo "<div class=\"catt\">\n<img src=\"img/items/";
                        echo $arr2[5]."\">\n<h4><a href=\"/category.php?item_id=".$arr2[0]."\">".$arr2[2]."</a></h4>\n<p class=\"desc\">Price: ";
                        echo $arr2[3]."$<br>Price for ".$arr[2]." pieces: ".$arr[2] * $arr2[3]."$</p>\n</div>";
                        $total_price += $arr[2] * $arr2[3];
                        $ch = 1;
                    }
                }
                fclose($fd2);
            }
        }
    }
    fclose($fd);
    echo "\n\t<div class='catt' style='height: 110px;'>
            \n\t<p class='desc' style='margin: 0px; font-size: 30px; font-weight: bold; text-decoration: underline'>Total price: ".$total_price."$<br>";
    if ($_SESSION['loggued_on_user'] == "admin")
        echo "<a href='arch.php' style='color: red; font-size: 15px; line-height: 35px;'>ARCHIVE</a>";
    echo"</p>
    \n\t</div>";
}

?>

        </div>
        <div class="clear"></div>
    </div>
    <div class="footer"><h1>Conatcts:</h1>
    </br>
    vnaumov@student.unit.ua
    </br>
    domanskyi.bohdan@gmail.com
     </div>
</div>

</body>
</html>