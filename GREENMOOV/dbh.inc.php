<?php

$serverName = "localhost";
$dBUsername = "";
$dBPassword = "";
$dbName = "GREENMOOV";

$conn = new mysqli($serverName, $dBUsername, $dBPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
  }
?>