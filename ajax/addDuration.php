<?php

require_once("../include/db_config.php");

if (isset($_POST["videoId"]) && isset($_POST["username"])) {
    $query = $conn->prepare("SELECT * FROM videoProgress WHERE username=:username AND videoId = :videoId");
    $query->bindValue(":videoId", $_POST["videoId"]);
    $query->bindValue(":username", $_POST["username"]);
    $query->execute();

    if ($query->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO videoProgress (username,videoId) VALUES (:username,:videoId)");
        $query->bindValue(":videoId", $_POST["videoId"]);
        $query->bindValue(":username", $_POST["username"]);
        $query->execute();
    }
} else {
    echo "No videoId or usename ";
}
?>