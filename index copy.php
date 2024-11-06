<?php 

require 'config.php';
require 'database/Database.php';
require 'controllers/MessageController.php';
require 'controllers/SenderController.php';

// Récuper la route + methode HTTP
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Instancier les controlleur
$messageController = new MessageController();
// $senderController = new SenderController();

//definir les routes
$baseUri = '/api/content/items';
if ($uri === "$baseUri/messages" && $method === 'GET') {
  $messageController->getMessage();
// } elseif ($uri === '/api/content/items/sender' && $method ==='GET') {
//   $senderController->getSender();
// } elseif ($uri === '/api/content/items/sender' && $method === 'POST') {
//   $senderController->createSender();
// } 
//} elseif ($uri === '/api/content/items/message' && $method === 'POST') {
//   $messageController->createMessage();
} else {
  header("HTTP/1.1 404 Not Found");
  echo json_encode(['error' => "Route not found"]);
}

