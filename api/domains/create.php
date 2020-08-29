<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Domains.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate domains object
  $domains = new Domains($db);

  // Get raw posted data
  $data = json_decode(file_get_contents('php://input'));

  $domains->domain = $data->domain;
  $domains->panel = $data->panel;
  $domains->isHosting = $data->isHosting;
  $domains->isDomain = $data->isDomain;

  // Crete domain
  if($domains->create()) {
      echo json_encode(
          array('message' => 'Domain Created')
      );
  } else {
      echo json_encode(
          array('message' => 'Domain Not Created')
      );
  }