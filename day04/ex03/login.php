<?php
include_once ('auth.php');
session_start();
if ($_GET['login'] && $_GET['passwd'] && auth($_GET['login'], $_GET['passwd'])){
	echo "OK\n";
	$_SESSION['loggued_on_user'] = $_GET['login'];
}
else {
	echo "ERROR\n";
	$_SESSION['loggued_on_user'] = "";
}
?>