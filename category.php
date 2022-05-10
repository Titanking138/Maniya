<?php

require_once("include/header.php");

if(!isset($_GET["id"]))
{
    ErrorMessage::errorShow("no id provided");
}
$preview = new PreviewProvider($conn, $userLoggedIn);
echo $preview->createCategoryPreview($_GET["id"]);

$categories = new CategoryContanier($conn, $userLoggedIn);
echo $categories->showCategory($_GET["id"]);
?>