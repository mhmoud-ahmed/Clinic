<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "clinic2";

// Create Connection

$confg = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$confg) {
    die("Connection Faiild : " . mysqli_connect_error());
}
