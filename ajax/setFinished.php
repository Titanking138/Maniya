<?php

require_once("../include/db_config.php");

if (isset($_POST["videoId"]) && isset($_POST["username"])) {
    $query = $conn->prepare("UPDATE videoProgress SET finished=1 , progress=0 WHERE username=:username AND videoId=:videoId ");
    $query->bindValue(":videoId", $_POST["videoId"]);
    $query->bindValue(":username", $_POST["username"]);
    $query->execute();
} else {
    echo "No videoId or usename ";
}
?>