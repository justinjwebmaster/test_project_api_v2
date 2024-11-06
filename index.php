<?php

require 'config.php';
require 'database/Database.php';
require 'controllers/MessageController.php';
require 'controllers/SenderController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$messageController = new MessageController();
$senderController = new SenderController();

$base_uri = "/api/content/items";
$uri_part = explode('/', trim($uri, '/'));

if ($uri === "$base_uri/messages" && $method === 'GET') {
  $messageController->getMessages();
} elseif ($uri === "$base_uri/senders" && $method === "GET") {
  $filter = [];
  if (isset($_GET['filter'])) {
      // Décoder le paramètre de filtre et vérifier le résultat
      $filter = urldecode($_GET['filter']);
      $filter = json_decode($filter, true);
  }
  $senderController->getSenders($filter);
} elseif (isset($uri_part[4]) && $uri_part[3] === 'senders' && $method == "GET") {
  $id = $uri_part[4];
  $senderController->getSenderById($id);
} elseif ($uri === "$base_uri/senders" && $method === "POST") {
  // Corriger le chemin pour lire depuis php://input
  $data = json_decode(file_get_contents("php://input"), true);

  // Vérifier que les données ont été correctement décodées
  if (is_array($data)) {
      $senderController->createSender($data);
  } else {
      header("HTTP/1.1 400 Bad Request");
      echo json_encode(["error" => "Invalid JSON data"]);
  }
} else {
  header("HTTP/1.1 404 Not Found");
  echo json_encode(['error' => "Route not found"]);
}