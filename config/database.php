<?php

require_once 'config.php';

class Database {
  private static $db_host = DB_HOST;
  private static $db_name = DB_NAME;
  private static $db_user = DB_USER;
  private static $db_pass = DB_PASS;
  private static $conn;

  private static function setDB() {
    try {
      self::$conn = new PDO("mysql:host=" . self::$db_host . ";dbname=" . self::$db_name, self::$db_user, self::$db_pass);
      // set the PDO error mode to exception
      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      // echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  protected function getDb() {
    if(self::$conn === null) {
      self::setDb();
    } 

    return self::$conn;
  }
}
