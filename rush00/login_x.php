<?php
include 'functions.php';

session_start();

if (!empty($_GET['login']) && !empty($_GET['password']) && $_GET['submit'] == "LOGIN")
{

	if (($fd = fopen("db/users.csv", "r")) !== FALSE) 
	{
	    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
	    {
	        if (isset($arr) && isset($arr[0]))
	        {
	        	if ($_GET['login'] == $arr[1] && $_GET['password'] == $arr[2])
	        	{
	        		$_SESSION['loggued_on_user'] = $_GET['login'];
					$x = 42;
					require('./index.php');
	        	}
	        }
	    }
	    fclose($fd);
	}
}
if (!$x)
{
	$_SESSION['loggued_on_user'] = "";
	require('./index.php');
}

?>