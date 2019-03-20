<?php
include 'functions.php';

#Items read >>
if (($fd = fopen("db/items.csv", "r")) !== FALSE)
{
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if ($arr[0] === $_GET["item_id"])
        {
            $item = $arr;
        }
    }
    fclose($fd);
}
#Items read <<
#============================================================
#Add to cart >>
session_start();

if (!isset($_SESSION['user_id']))
{
    $_SESSION['user_id'] = rand(999, 99999999);
    $_SESSION['cart_av'] = 0;
}

if (isset($_GET['quan']) && is_numeric($_GET['quan']))
{
    if (!empty($_SESSION['loggued_on_user']))
        $str = $_SESSION['loggued_on_user'].';'.$_GET['item_id'].';'.$_GET['quan'].';'.$item[3] * $_GET['quan'];
    else
        $str = $_SESSION['user_id'].";".$_GET['item_id'].";".$_GET['quan'].';'.$item[3] * $_GET['quan'];
    add_str_cart("db/cart.csv", $str);
    $_SESSION['cart_av'] = 1;
}
#Add to cart <<

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $item[2] ?> - Snikers Shop</title>
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

            echo "\t\t\t<h3>".$item[2]."</h3>";
			echo "\n\t\t\t<div class=\"item_page\">\n\t\t\t\t<p class=\"desc\">";
			echo $item[4]."</p>\n\t\t\t\t<img src=\"img/items/".$item[5]."\">\n\t\t\t\t<p class=\"price\">";
			echo $item[3]."$</p>\n";
            echo "\t\t\t<form action=\"".$_SERVER['PHP_SELF']."\" method=\"GET\">\n";
            echo "\t\t\t\t<input type=\"hidden\" name=\"item_id\" value=\"".$_GET['item_id']."\">";
?>
                <input type="text" class="text" name="quan" value="1">
                <input type="submit" class="buy" value="Buy!">
            </form>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="footer">FOOTER</div>
</div>

</body>
</html>