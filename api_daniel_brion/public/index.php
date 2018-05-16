<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//echo("<h1>Pagina de gestion API REST de la aplicacion de Daniel Brion</h1>");
require '../vendor/autoload.php';

require '../src/config/db.php';

$app = new \Slim\App;
require '../src/rutas/empleados.php';
$app->get('/', function (Request $request, Response $response) {

    $response->getBody()->write("<h1>Pagina de gestion API REST de la aplicacion de Daniel Brion</h1>");

    return $response;
});

$app->run();
?>
