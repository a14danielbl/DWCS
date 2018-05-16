<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App;

//obtener todos los productos
$app->get('/api/empleados', function(Request $request, Response $response){
    $consulta = "SELECT * FROM empleados";
    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $empleados = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($empleados);

    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/api/empleado/{id}', function(Request $request, Response $response, array $args){
    $id = $args['id'];
    $consulta = "SELECT * FROM empleados WHERE id = '$id'";
    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $empleados = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($empleados);

    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->post('/api/crear', function(Request $request,Response $response){
    $id = $request->getParam('id');
    $nombre = $request->getParam('nombre');
    $direccion = $request->getParam('direccion');
    $telefono = $request->getParam('telefono');
    try{
        $db = new db();
        $db = $db->conectar();
        $sentencia = $db->prepare("INSERT INTO empleados (id, nombre, direccion, telefono) VALUES (:id, :nombre, :direccion, :telefono)");
        $datos = array('id'=>$id,'nombre'=>$nombre, 'direccion'=>$direccion, 'telefono'=>$telefono);
        $sentencia->execute($datos);
        $db=null;
    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->put('/api/actualizar/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $nombre = $request->getParam('nombre');
    $direccion = $request->getParam('direccion');
    $telefono = $request->getParam('telefono');
    try{
        $db = new db();
        $db = $db->conectar();
        $sentencia = $db->prepare("UPDATE empleados SET nombre=:nombre, direccion=:direccion, telefono=:telefono WHERE id = :id");
        $datos = array('id'=>$id,'nombre'=>$nombre, 'direccion'=>$direccion, 'telefono'=>$telefono);
        $sentencia->execute($datos);
        $db=null;
    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->delete('/api/eliminar/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    try{
        $db = new db();
        $db = $db->conectar();
        $sentencia = $db->prepare("DELETE FROM empleados WHERE id = :id");
        $datos = array('id'=>$id);
        $sentencia->execute($datos);
        $db=null;
    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

?>
