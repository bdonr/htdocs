<?php
$REST = array(
    '/' => array(
      'script' => function($DB){
          $json = $DB->testQuery(true);
          echo json_encode($json);
      }
    ),
    '/login' => array(
      'script' => function($DB){
        $state = array('login' => false);
        $send_data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($state);
      }
    ),
    '/task' => array(
      'script' => function($DB){
        if(!isset($_SESSION['user'])){
          // TODO: turn error-codes in to a function
          echo json_encode(array('err' =>'Not logged in'));
          die();
        }
        // TODO: there is no data validation by now; either no injection check
        $method = $_SERVER['REQUEST_METHOD'];
        $send_data = json_decode(file_get_contents('php://input'), true);

        switch ($method) {
          case 'GET':
          break;
          case 'PUT':
          break;
          case 'POST':
          break;
          case 'DELETE':
          break;
        }
      }
    )
  );
?>
