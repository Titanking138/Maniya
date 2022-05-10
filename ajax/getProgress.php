<?php

require_once("../include/db_config.php");

if (isset($_POST["videoId"]) && isset($_POST["username"])) {
    $query = $conn->prepare("SELECT progress FROM videoProgress WHERE username=:username AND videoId=:videoId ");
    $query->bindValue(":videoId", $_POST["videoId"]);
    $query->bindValue(":username", $_POST["username"]);
    $query->execute();
    echo $query->fetchColumn();
} else {
    echo "No videoId or usename ";
}
?>