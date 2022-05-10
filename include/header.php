<?php
require_once("include/db_config.php");
require_once("include/classes/CategoryContanier.php");
require_once("include/classes/Entity.php");
// require_once("include/classes/entity.php");
require_once("include/classes/PreviewProvider.php");
require_once("include/classes/EntityProvider.php");
require_once("include/classes/SeasonProvider.php");
require_once("include/classes/Season.php");
require_once("include/classes/Video.php");
require_once("include/classes/ErrorMessage.php");
require_once("include/classes/VideoProvider.php");

if (!isset($_SESSION["userLoggedIn"])) {
    header('Location: login.php');
}

$userLoggedIn = isset($_SESSION["userLoggedIn"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Maniya</title>
    <link rel="stylesheet" type="text/css " href="Asseset/style/style.css">
    <script src="https://kit.fontawesome.com/e9512f1df8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="Asseset/js/script.js"></script>
</head>

<body>
    <div class="wapper">

 <?php
    if(!isset($hideNav))
    {
        include_once("include/navBar.php");
    }
 ?>