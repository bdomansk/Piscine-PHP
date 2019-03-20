<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sneakers</title>
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
        <div class="content">
        <div class="index_margin2">
            <h3>Leaders of sells</h3>

<?php
if (($fd = fopen("db/items.csv", "r")) !== FALSE) 
{
	$i = 3;
    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE  && $i > 0)
    {
        if ($i > 0 && isset($arr) && isset($arr[0]))
        {
            echo "<div class=\"item\">";
            echo "<img src=\"img/items/".$arr[5]."\">";
            echo "<h2><a href=\"item.php?item_id=".$arr[0]."\">".$arr[2]."</a></h2>";
            echo "<p class=\"price\">".$arr[3]." $</p>";
            echo "<p class=\"desc\">".$arr[4]."</p>";
            echo "</div>";
			$i--;
        }
    }
	fclose($fd);
}
?>          
            </div>
            <div class="index_margin">
            <pre><h3 class="clear lower">                            OUR BRANDS</h3></pre>
            <br />
            <br />
<?php
if (($fd = fopen("db/cats.csv", "r")) !== FALSE) 
{
	while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
	{
		if (isset($arr) && isset($arr[0]))
		{
			echo "<div class=\"catt\">\n<img src=\"img/cats/".$arr[3]."\">\n";
			echo "<h4><a href=\"category.php?cat_id=".$arr[0]."\">".$arr[1]."</a></h4>\n";
            echo "<br \>";
			echo "<p class=\"desc\">".$arr[2]."</p>\n</div>";
		}
	}
	fclose($fd);
}
?>
        </div>
        </div>
        <div class="clear"></div>
   
     <div class="footer"><h1>Conatcts:</h1>
    </br>
    vnaumov@student.unit.ua
    </br>
    domanskyi.bohdan@gmail.com
     </div>

</div>

</body>
</html>