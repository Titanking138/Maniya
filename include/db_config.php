<?php

ob_start(); // turn on output buffer so no out goes out while buffer is on
session_start();
date_default_timezone_set("Indian/Mahe");

try {
    $conn = new PDO("mysql:dbname=maniya;host=localhost", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $th) {
    exit("connection fail : " . $th->getMessage());
}
?>