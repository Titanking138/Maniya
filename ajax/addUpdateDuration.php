<?php

require_once("../include/db_config.php");

if (isset($_POST["videoId"]) && isset($_POST["username"]) && isset($_POST["progress"])) {
    $query = $conn->prepare("UPDATE videoProgress SET progress=:progress , dateModified=NOW() WHERE username=:username AND videoId=:videoId ");
    $query->bindValue(":videoId", $_POST["videoId"]);
    $query->bindValue(":username", $_POST["username"]);
    $query->bindValue(":progress", $_POST["progress"]);
    $query->execute();
} else {
    echo "No videoId or usename ";
}

?>