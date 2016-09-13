<?php

require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/control_session.php';
if (!array_key_exists('INSERT', $_SESSION )) {
    header('Location: ../denegado.php');
    die();
}

/* @var $_POST type */
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
$nacionalidad = (int) $_POST['nacionalidad'];

$errores = [];

if (strlen($nombre) == 0) {
    $errores["nombre"] = "El nombre es requerido";
}

if (strlen($apellido) == 0) {
    $errores["apellido"] = "El apellido es requerido";
}

if (empty($fecha_nacimiento)) {
    $errores["fecha_nacimiento"] = "La fecha de nacimiento es requerido";
}


if (strcmp($nacionalidad, "0") == 0) {
    $errores["nacionalidad"] = "La nacionalidad es requerida";
}


if (count($errores) > 0) {

    require '../alta_formulario_vista.php';
    die();
} else {
    try {
        $pdo = getConnection();

        $sql = "INSERT INTO clientes ( apellido, nombre, fecha_nacimiento, activo, nacionalidad_id) VALUES
                    ( UPPER( :apellido ), UPPER( :nombre ), :fecha_nacimiento , 1, :nacionalidad)";

        $stmt = $pdo->prepare($sql);

        //especid¿ficamos la salida como un array
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //podria ser PDO::FETCH_OBJ

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':nacionalidad', $nacionalidad);
        //ejecutamos la consulta
        
        $_SESSION['agregaado'] = true;
        $stmt->execute();

        //redirecion a inicio
        header("Location: ../index.php");
        //require '../index.php';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}


