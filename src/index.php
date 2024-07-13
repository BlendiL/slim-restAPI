<?php
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:X-Request-With');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
//require '../src/config/db.php';

$app = new \Slim\App();
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});


$app->run();


?>