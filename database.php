<?php
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbHost= $_ENV['DB_HOST'];
$dbPort= $_ENV['DB_PORT'];
$dbUser= $_ENV['DB_USER'];
$dbPass= $_ENV['DB_PASS'];
$dbName= $_ENV['DB_NAME'];

try {
  $dsn = "mysql:host=$dbHost; port=$dbPort; dbname=$dbName; charset=utf8mb4";
  $conn = new PDO($dsn, $dbUser, $dbPass);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  return $conn;
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>