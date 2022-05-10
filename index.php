<?php

require_once("include/header.php");

$preview = new PreviewProvider($conn,$userLoggedIn);
echo $preview->createPreview(NULL);

$categories = new CategoryContanier($conn,$userLoggedIn);
echo $categories->showAllCategorys();
?>
