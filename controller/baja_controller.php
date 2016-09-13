<?php
require_once __DIR__.'/db_connect.php';
    require __DIR__ . '/control_session.php';
    if(!array_key_exists('DELETE', $_SESSION )) {
        header('Location: ../denegado.php');
        die();
    }

$id_cliente = (int)$_GET['id'];

try {
    $pdo = getConnection();
    $sql = "DELETE FROM 
                clientes
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    //especid¿ficamos la salida como un array
    $stmt->setFetchMode(PDO::FETCH_ASSOC); //podria ser PDO::FETCH_OBJ
    $stmt->bindParam(':id', $id_cliente);
    $stmt->execute();
    
    $_SESSION['eliminado'] = true;
    header("Location: ../index.php");
    die();

} catch (Exception $ex){
    echo $ex->getMessage();
}