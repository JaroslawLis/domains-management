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

  // Blog post query
  $result = $domains->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $domains_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      //print_r($row);
      extract($row);

      $domain_item = array(
        'id' => $id,
        'domain' => $domain,
        'panel' => $panel,
        'isHosting' => $isHosting,
        'isDomain' => $isDomain,
        '$serverNS1' => $serverNS1,
        '$serverNS2' => $serverNS2,
        '$serverNS3' => $serverNS3,
        '$serverNS4' => $serverNS4,
      );



      // Push to "data"
      array_push($domains_arr, $domain_item);

    }
    // print_r($domains_arr);
    // Turn to JSON & output
    echo json_encode($domains_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
