<?php
require_once __DIR__.'/db_connect.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getNacionalidades(){

    try {
        $pdo = getConnection();

        $sql = "SELECT id, LOWER(descripcion) as descripcion FROM nacionalidades";

        $stmt = $pdo->prepare($sql);

        //especid¿ficamos la salida como un array
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //podria ser PDO::FETCH_OBJ

        //ejecutamos la consulta
        $stmt->execute();

        //recuperamos los datos de el array asoc.
        $results = $stmt->fetchAll();

        return $results;
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

$nacionalidades = getNacionalidades();