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

    if (!isset($data['sender']) || !isset($data['_state'])) {
      header("HTTP/1.1 400 Bad Request");
      echo json_encode(['error' => "Missing required fields: sender and _state"]);
    }

    $query = "INSERT INTO senders (id, _state, sender, _cby, _mby) SELECT UUID(), :_state, :sender, UUID(), UUID()";
    $stmt = $this->conn->prepare($query);


    $sender = filter_var($data['sender'], FILTER_SANITIZE_SPECIAL_CHARS);
    $_state = filter_var($data['_state'], FILTER_SANITIZE_NUMBER_INT);

    $stmt->bindParam(':_state', $_state);
    $stmt->bindParam(':sender', $sender);

    try {
        $stmt->execute();
        
        // Récupérer l'UUID généré pour `id`
        $lastId = $this->conn->query("SELECT id FROM senders ORDER BY _created DESC LIMIT 1")->fetchColumn();

        // Deuxième requête : mettre à jour `_cby` et `_mby` avec cet UUID
        $updateQuery = "UPDATE senders SET _cby = :uuid, _mby = :uuid WHERE id = :uuid";
        $updateStmt = $this->conn->prepare($updateQuery);
        $updateStmt->bindParam(':uuid', $lastId, PDO::PARAM_STR);
        $updateStmt->execute();

        // Réponse de succès avec l'UUID utilisé pour l'insertion
        $response = [
            "status" => "success",
            "message" => "Sender created successfully",
            "id" => $lastId
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["error" => "Failed to create sender", "details" => $e->getMessage()]);
    }
  }
}