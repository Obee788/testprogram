<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store";

try {
  $dbcon = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
