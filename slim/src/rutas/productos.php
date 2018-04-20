<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App;
//obtener todos los productos
$app->get('/api/productos', function(Request $request, Response $response){
    $consulta = 'SELECT * FROM producto';
    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $productos = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($productos);
    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
?>
