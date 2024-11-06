<?php 

class MessageController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getMessages() {
        $query = "SELECT * FROM messages WHERE _state = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Structurer le format JSON selon le besoin sans jointure
        $formattedMessages = [];
        foreach ($messages as $msg) {
            $formattedMessages[] = [
                "sender" => [
                    "_model" => "senders",
                    "_id" => $msg['sender_id']  // Utilise simplement sender_id comme UUID ici
                ],
                "message" => $msg['message'],
                "_state" => $msg['_state'],
                "_created" => $msg['_created'],
                "_modified" => $msg['_modified'],
                "_cby" => $msg['_cby'],
                "_mby" => $msg['_mby'],
                "_id" => $msg['id']
            ];
        }

        header("Content-Type: application/json");
        echo json_encode($formattedMessages);
    }
}