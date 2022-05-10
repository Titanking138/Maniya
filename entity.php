<?php

require_once("include/header.php");

if (!isset($_GET["id"])) {
    # TODO :  modify page with adding some css like error 404 page not found  
    ErrorMessage::errorShow("Page not Found ");
}

$entityId = $_GET["id"];
$entity = new Entity($conn,$entityId);

$preview = new PreviewProvider($conn, $userLoggedIn);
echo $preview->createPreview($entity);

$seasonProvide = new SeasonProvider($conn,$userLoggedIn);
echo $seasonProvide->createSP($entity);

$simillarLike = new CategoryContanier($conn,$userLoggedIn);
echo $simillarLike->showCategory($entity->getCategoryId(),"You might also like ");

?>
