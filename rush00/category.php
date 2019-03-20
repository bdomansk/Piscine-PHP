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
}

if (isset($_GET['quan']) && is_numeric($_GET['quan']))
{
    if (!empty($_SESSION['loggued_on_user']))
        $str = $_SESSION['loggued_on_user'].';'.$_GET['item_id'].';'.$_GET['quan'].';'.$item[3] * $_GET['quan'];
    else
        $str = $_SESSION['user_id'].";".$_GET['item_id'].";".$_GET['quan'].';'.$item[3] * $_GET['quan'];
    add_str_cart("db/cart.csv", $str);
}
#Add to cart <<

#Cats reading >>
if (($fd = fopen("db/cats.csv", "r")) !== FALSE)
{

    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if ($arr[0] === $_GET["cat_id"])
        {
            $categ_name = $arr[1];
            $cat_iidd = $arr[0];
        }
        if ($_GET["cat_id"] === "all" )
        {
            $categ_name = "All";
        }
    }
}
#Cats reading <<

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $categ_name?> - Snikers Shop</title>
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
            <h3><?php echo $categ_name?></h3>
<?php
if (($fd = fopen("db/items.csv", "r")) !== FALSE) 
{
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if ($_GET["cat_id"] == "all" || $arr[1] === $_GET["cat_id"] || if_cat($arr[1], $_GET["cat_id"]) === 1 )
        {
            echo "<div class=\"item\">";
            echo "<img src=\"img/items/".$arr[5]."\">";
            echo "<h2><a href=\"/item.php?item_id=".$arr[0]."\">".$arr[2]."</a></h2>";
            echo "<p class=\"price\">".$arr[3]." $</p>";

            echo "\n\t\t\t<form action=\"".$_SERVER['PHP_SELF']."\" method=\"GET\">";
            echo "\n\t\t\t\t<input type=\"hidden\" name=\"cat_id\" value=\"".$cat_iidd."\">";
            echo "\n\t\t\t\t<input type=\"hidden\" name=\"item_id\" value=\"".$arr[0]."\">";
            echo "\n\t\t\t\t<input type=\"hidden\" class=\"text\" name=\"quan\" value=\"1\">";
            echo "\n\t\t\t\t<input type=\"submit\" class=\"buy\" value=\"Buy!\">";
            echo "\n\t\t\t</form>";

            echo "<p class=\"desc\">".$arr[4]."</p>";
            echo "</div>";
        }
    }
	fclose($fd);
}
?>
        </div>
        <div style="clear: both;"></div>
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