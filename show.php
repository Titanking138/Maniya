<?php

require_once("include/header.php");

$preview = new PreviewProvider($conn, $userLoggedIn);
echo $preview->createTVShowPreview(NULL);

$categories = new CategoryContanier($conn, $userLoggedIn);
echo $categories->showTVShowCategorys();

?>