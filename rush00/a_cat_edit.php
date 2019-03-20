<?php
include "functions.php";
$cat_id = $_GET["cat_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add new category - Admin Panel</title>
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
            <h3>Add new category</h3>
            <div class="add">
<?php

if ($_GET["rem"] && ($fd = fopen("db/cats.csv", "r")) !== FALSE)
{
    ini_set('auto_detect_line_endings', TRUE);
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if ($arr[0] === $cat_id)
            $img_name = $arr[3];
    }
fclose($fd);
}

$up_dir = "\MAMP\htdocs\img\cats\\";
if ($_GET["rem"])
{
    $up_file = $up_dir.basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $up_file) && !empty($_POST["cat_name"]) && !empty($_POST["descr"])) // OK!
    {
        unlink("img/cats/".$img_name);
        $descr = preg_replace("/\r\n/", "<br>", $_POST["descr"]);
        $c_name = preg_replace("/\r\n/", "<br>", $_POST["cat_name"]);
        $str = $cat_id.";".$c_name.";".$descr.";".$_FILES["image"]["name"];
        edit_str("db/cats.csv", "$str", $cat_id);
        echo "<p style='color: #173; font-weight: bold;'>Category has been edited!</p>\n";
    }
    else if ($_FILES["image"]["error"] === 2) // error
        echo "<p style='color: #a46; font-weight: bold;'>!!!The picture is too large, the image size should be no more 0.5Mb!!!</p>\n";
    else if (!move_uploaded_file($_FILES["image"]["tmp_name"], $up_file) && !empty($_POST["cat_name"]) && !empty($_POST["descr"])) // error
    {
        // unlink("img/cats/".$img_name);
        $descr = preg_replace("/\r\n/", "<br>", $_POST["descr"]);
        $c_name = preg_replace("/\r\n/", "<br>", $_POST["cat_name"]);
        $str = $cat_id.";".$c_name.";".$descr.";".$img_name;
        edit_str("db/cats.csv", "$str", $cat_id);
        echo "<p style='color: #173; font-weight: bold;'>Category has been edited!</p>\n";
    }
    else // error
        echo "<p style='color: #a46; font-weight: bold;'>You must to fill all fields!</p>\n";
}

if (($fd = fopen("db/cats.csv", "r")) !== FALSE) 
{
    ini_set('auto_detect_line_endings', TRUE);
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
    {
        if ($arr[0] === $cat_id)
            $cat_find = $arr;
    }
fclose($fd);
}
$cat_find[2] = preg_replace("/<br>/", "\r\n", $cat_find[2]);

?>
<form enctype="multipart/form-data" action="/a_cat_edit.php?cat_id=<?php echo $cat_find[0]; ?>&rem=true" method="POST">
    <img src="/img/cats/<?php echo $cat_find[3]; ?>" class="id_img" alt="">
    <input type="hidden" name="MAX_FILE_SIZE" value="512000">
    <p>You can select a new picture of category (up to 0.5Mb):
    <input name="image" type="file" accept=".jpg, .jpeg, .png, .gif" class="btt2"></p>
    <p>Category name: <input type="text" name="cat_name" class="inp" style="margin-left: 49px;" value="<?php echo $cat_find[1]; ?>"></p>
    <p>Category description: <textarea rows="3" cols="55" name="descr" class="inp"><?php echo $cat_find[2]; ?></textarea></p>
    <p><input type="submit" value="Edit it!" class="btt"></p>
</form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

</body>
</html>