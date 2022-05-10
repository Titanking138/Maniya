<?php

require_once("../include/db_config.php");
require_once '../include/classes/SearchResultProvider.php';
require_once '../include/classes/Entity.php';
require_once '../include/classes/EntityProvider.php';
require_once '../include/classes/PreviewProvider.php';


if (isset($_POST["term"]) && isset($_POST["username"])) {
    $srp = new SearchResultProvider($conn, ($_POST["term"]));
    echo $srp->getResult($_POST["term"]);
} else {
    echo "No term or usename ";
}
?>

