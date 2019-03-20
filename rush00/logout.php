<?php
include 'functions.php';

session_start();
$_SESSION['loggued_on_user'] = "";
session_destroy();
header("Location: ".$_SERVER['HTTP_REFERER']);
?>