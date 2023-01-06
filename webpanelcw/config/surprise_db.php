<?php
$servername = "localhost";
$username = "surprisebo62_db";
$password = "GvNYcjMpfi";

try {
  $conn = new PDO("mysql:host=$servername;dbname=surprisebo62_db;charset=utf8", $username, $password);
  // $conn = new PDO("mysql:host=$servername;dbname=surprise_project;charset=utf8", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
