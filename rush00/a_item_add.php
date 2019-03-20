<?php
include "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add new item - Admin Panel</title>
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
            <h3>Add new item</h3>
            <div class="add">
<?php
$up_dir = "\MAMP\htdocs\img\items\\";
if ($_GET["new"])
{
    $up_file = $up_dir.basename($_FILES["image"]["name"]); 
    $cat_ids = $_POST['cat'];
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $up_file) && !empty($_POST["item_name"]) && !empty($_POST["descr"]) && !empty($cat_ids)) // OK!
    {
        // <Categorys is maker
        $n = count($cat_ids);
        for($i=0; $i < $n; $i++)
        {
            if ($i + 1 != $n)
                $new_cat_ids .= $cat_ids[$i].":#:";
            else
                $new_cat_ids .= $cat_ids[$i];
        }
        // Category is maker>

        $i_name = preg_replace("/\r\n/", "<br>", $_POST["item_name"]);
        $descr = preg_replace("/\r\n/", "<br>", $_POST["descr"]);
        $price = intval($_POST["item_price"]);
        $str = $new_cat_ids.";".$i_name.";".$price.";".$descr.";".$_FILES["image"]["name"];
        add_str("db/items.csv", "$str");
        echo "<p style='color: #173; font-weight: bold;'>A new category has been added, you can to add another category:</p>\n";
    }
    else if ($_FILES["image"]["error"] === 2) // error
        echo "<p style='color: #a46; font-weight: bold;'>!!!The picture is too large, the image size should be no more 0.5Mb!!!</p>\n";
    else // error
        echo "<p style='color: #a46; font-weight: bold;'>You must to fill all fields!</p>\n";
}
?>
                <form enctype="multipart/form-data" action="/a_item_add.php?new=true" method="POST">
                    <input type="hidden" name="MAX_FILE_SIZE" value="512000">
                    <p>Please select a picture to new category (up to 0.5Mb):
                    <input name="image" type="file" accept=".jpg, .jpeg, .png, .gif" class="btt2"></p>
                    <p>Item name: <input type="text" name="item_name" class="inp" style="margin-left: 49px;"></p>
                    <p>Item description: <textarea rows="3" cols="55" name="descr" class="inp"></textarea></p>
                    <p>Item price: <input type="text" name="item_price" class="inp" style="margin-left: 49px;"> $</p>
                    <p>Select a category/s:</p>
<?php
if (($fd = fopen("db/cats.csv", "r")) !== FALSE)
{
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if (isset($arr) && isset($arr[0]))
            echo "\t\t\t\t\t<p><input type=\"checkbox\" name=\"cat[]\" value=\"".$arr[0]."\"> ".$arr[1]."</p>\n";
    }
    fclose($fd);
}
?>
                    <p><input type="submit" value="Add category" class="btt"></p>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

</body>
</html>