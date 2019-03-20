<?php
include "functions.php";
$cat_id = $_GET["cat_id"];
$rem_id = $_GET["rem_id"];
$cat_name = "All items";
if (is_numeric($rem_id))
{
    remove_id("db/items.csv", $rem_id);
    header("Location: ".preg_replace("/(.*)&[^&]*/", "$1", $_SERVER['REQUEST_URI']));
}
if (($fd = fopen("db/cats.csv", "r")) !== FALSE) 
{
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if (isset($arr) && isset($arr[0]) && $arr[0] === $_GET["cat_id"] && $cat_id != "all")
            $cat_name = "Items from \"".$arr[1]."\" category";
    }
    fclose($fd);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $cat_name; ?> - Admin Panel</title>
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
            <a href="/">Main page</a>
            <a href="a_cats_list.php" class="a_m">Categories</a>
            <a href="a_cat_add.php" class="add_cat">+add new</a>
            <a href="a_items_list.php?cat_id=all" class="a_m">Items</a>
            <a href="a_item_add.php" class="add_item">+add new</a>
            <a href="a_users_list.php" class="a_m">Users</a>
            <a href="a_users_add.php" class="add_user">+add new</a>
            <a href="cart.php">Orders</a>
        </div>
        <div class="content">
            <h3><?php echo $cat_name; ?></h3>
<?php
if (($fd = fopen("db/items.csv", "r")) !== FALSE)
{
    $i = 1;
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if ($arr[1] === $cat_id || if_cat($arr[1], $cat_id) === 1)
        {
            echo "\n\t<div class=\"cat_list\">\n
                \t\t<p>".$i++.".</p>\n
                \t\t<img src=\"img/items/".$arr[5]."\">\n
                \t\t<a href=\"#\" class=\"item_l\">".$arr[2]."</a>\n
                \t\t<a href=\"".$_SERVER['REQUEST_URI']."&rem_id=".$arr[0]."\"><img src=\"img/adm/remove.png\" alt=\"Remove\" class=\"pic\"></a>\n
                \t\t<a href=\"#\"><img src=\"img/adm/edit.png\" alt=\"Edit\" class=\"pic\"></a>\n
                \t</div>";
        }
        else if ($cat_id === "all" && isset($arr[0]) && is_numeric($arr[0]))
        {
            echo "\n\t<div class=\"cat_list\">\n
                \t\t<p>".$i++.".</p>\n
                \t\t<img src=\"img/items/".$arr[5]."\">\n
                \t\t<a href=\"#\" class=\"item_l\">".$arr[2]."</a>\n
                \t\t<a href=\"".$_SERVER['REQUEST_URI']."&rem_id=".$arr[0]."\"><img src=\"img/adm/remove.png\" alt=\"Remove\" class=\"pic\"></a>\n
                \t\t<a href=\"#\"><img src=\"img/adm/edit.png\" alt=\"Edit\" class=\"pic\"></a>\n
                \t</div>";
        }
        
        
    }
    fclose($fd);
}
?>
        </div>
        <div class="clear"></div>
    </div>
</div>

</body>
</html>