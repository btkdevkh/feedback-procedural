<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '123456789');
define('DB_NAME', 'phpfeed');

function connectDB() {
  $conn = null;

  try {
    if($conn === null) {
      $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      // echo "Connected successfully";
    }
    
    return $conn;
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}
