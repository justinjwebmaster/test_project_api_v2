<?php 

class SenderController {
  private $conn;

  public function __construct() {
    $database = new Database;
    $this->conn = $database->getConnection();
  }

  public function getSenders($filter = []){
    $query = "SELECT * FROM senders WHERE _state = 1";

    if(isset($filter["sender"])) {
      $query .= " AND sender = :sender";
    }

    $stmt = $this->conn->prepare($query);

    if (isset($filter['sender'])){
      $stmt->bindParam(':sender', $filter['sender']);
    }

    $stmt->execute();


    $senders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $structuredSenders = [];

    foreach($senders as $sender) {
      $structuredSenders[] = [
        "sender"=>$sender['sender'],
        "_state"=>$sender['_state'],
        "_modified"=>$sender['_modified'],
        "_mby"=>$sender['_mby'],
        "_created"=>$sender['_created'],
        "_cby"=>$sender['_cby'],
        "_id"=>$sender['id']
      ];
    }

    header("Content-Type: application/json");
    echo json_encode($structuredSenders);
  }

  public function getSenderById($id) {
    $query = "SELECT * FROM senders WHERE id = :id";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $sender = $stmt->fetch(PDO::FETCH_ASSOC);

    header("Content-Type: application/json");
    echo json_encode($sender);
  }

  public function createSender($data) {
    
  }
}