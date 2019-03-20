<?php
include 'functions.php';
$user = 0;
$x = 0;
session_start();

if (!empty($_GET['login']) && !empty($_GET['password']) && $_GET['submit'] == "REGISTR")
{

	if (($fd = fopen("db/users.csv", "r")) !== FALSE) 
	{
	    while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
	    {
	        if (isset($arr) && isset($arr[0]))
	        {
	        	if ($_GET['login'] == $arr[1] )
	        	{
	        		$user = 1;
	        	}
	        }
	    }
	    fclose($fd);
	}
	if ($user === 0)
	{
		add_str("db/users.csv", $_GET['login'].";".$_GET['password'].";user;out");
		$x = 1;
		$_SESSION['loggued_on_user'] = $_GET['login'];
		require('./index.php');
	}
}
if (!$x)
{
	$_SESSION['loggued_on_user'] = "";
	require('./index.php');
}

?>