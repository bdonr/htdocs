<?php

require 'vendor/autoload.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
include_once('vendor/classes/User.php');
include_once('vendor/classes/Stadt.php');
$app = new \Slim\App();
$app->get('/hello/{name}', function (Request $request, Response $response,$args) {
    $stadt = new Stadt("hildesheim",31141);
    $stadt1 = new Stadt("hannover",30456);
    $staedte = array($stadt,$stadt1);
    return null;
});

$app->get('/hello', function (Request $request, Response $response, $args) {
    $data = array('name' => 'Bob', 'age' => 40);
    $newResponse = $response->withJson($data);
    return $newResponse;
});

$app->get('/jsontest', function ($request, $response, $args) {
    $response = $response->withStatus(201);
    $response = $response->withJson(['foo' => 'bar']);
    return $response;
});
$app->run();