<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Domains.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate domains object
  $domains = new Domains($db);

  //Get ID
  $domains->id = isset($_GET['id']) ? $_GET['id']: die();

  // Get domain
  $domains->read_single_domain();

  // Create array
  $domain_arr = array(
    'id' => $domains->id,
    'domain' => $domains->domain,
    'panel' => $domains->panel,
     'isHosting' => $domains->isHosting,
     'isDomain' => $domains->isDomain,
     '$serverNS1' => $domains->serverNS1,
     '$serverNS2' => $domains->serverNS2,
     '$serverNS3' => $domains->serverNS3,
     '$serverNS4' => $domains->serverNS4,
  );

  // Make JSON
  print_r(json_encode($domain_arr));