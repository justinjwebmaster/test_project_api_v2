<?php 

class Database {
  private $host = DB_HOST;
  private $port = DB_PORT;
  private $dbname = DB_NAME;
  private $dbuser = DB_USER;
  private $password = DB_PASS;
  public $conn;

  public function getConnection() {
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . "; dbname=" . $this->dbname,  $this->dbuser, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "Connection error : " . $e->getMessage();
    }
    return $this->conn;
  }
}