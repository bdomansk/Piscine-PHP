<?php
include 'functions.php';

session_start();

rem_content("db/cart.csv");

header("Location: ".$_SERVER['HTTP_REFERER']);
?>