<?php
require_once __DIR__.'/db_connect.php';
    //sql
try {
    $pdo = getConnection();
    $sql = "SELECT 
                clientes.id,
                LOWER( apellido ) as apellido, 
                LOWER( nombre ) as nombre, 
                TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) as edad,
                activo,
                LOWER(nacionalidades.descripcion) as nacionalidad
            FROM clientes 
                join nacionalidades 
                on clientes.nacionalidad_id = nacionalidades.id";

    $stmt = $pdo->prepare($sql);

    //especid¿ficamos la salida como un array
    $stmt->setFetchMode(PDO::FETCH_ASSOC); //podria ser PDO::FETCH_OBJ

    //ejecutamos la consulta
    $stmt->execute();

    //recuperamos los datos de el array asoc.
    $results = $stmt->fetchAll();
} catch (Exception $ex){
    echo $ex->getMessage();
}