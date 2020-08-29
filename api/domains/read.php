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

function cors() {

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    echo "You have CORS!";
}
cors();