<?php
    require_once __DIR__.'/db_connect.php';
    require __DIR__ . '/control_session.php';
    if($_SESSION['UPDATE'] != true ) {
        header('Location: ../denegado.php');
        die();
    }

    if(!empty($_GET)){

        $_SESSION['id_cliente'] =  $_GET['id'];;

    }
    try{
        $pdo = getConnection();
        $sql = "SELECT 
                    clientes.id as id_cliente,
                    LOWER( apellido ) as apellido, 
                    LOWER( nombre ) as nombre, 
                    DATE_FORMAT(fecha_nacimiento,'%d-%m-%Y') as fecha_nacimiento,
                    activo,
                    LOWER(nacionalidades.descripcion) as nacionalidad,
                    nacionalidades.id as id_nacionalidad
                FROM clientes 
                    join nacionalidades 
                    on clientes.nacionalidad_id = nacionalidades.id
                WHERE clientes.id = :id";

        $stmt = $pdo->prepare($sql);

        //especid¿ficamos la salida como un array
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //podria ser PDO::FETCH_OBJ

        $stmt->bindParam(':id',  $_SESSION['id_cliente']);
        //ejecutamos la consulta
        $stmt->execute();

        //recuperamos los datos de el array asoc.
        $results = $stmt->fetch();

        require '../modificacion_vista.php';
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }