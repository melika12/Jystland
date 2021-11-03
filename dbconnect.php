<?php
$servername = "mysql103.unoeuro.com";
$port = 3306;
$username = "zappstudios_dk";
$password = "AybwD5pcBmzf";
$dbname = "zappstudios_dk_db_jystland";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}