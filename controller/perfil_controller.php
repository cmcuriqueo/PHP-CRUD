<?php
	require_once __DIR__ . '/control_session.php';
	require_once __DIR__.'/db_connect.php';

	if(empty($_POST)){
	    try{
	            $pdo = getConnectionUser();
	            $sql = "SELECT nombre, apellido, dni, fecha_nacimiento FROM persona WHERE id = :id ;";
	            $stmt = $pdo->prepare($sql);
	            //especid¿ficamos la salida como un array
	            $stmt->setFetchMode(PDO::FETCH_ASSOC); //podria ser PDO::FETCH_OBJ

	            $stmt->bindParam(':id', $_SESSION['id_usuario']);

	            $stmt->execute();

				$perfil = $stmt->fetch();

				require '../perfil.php';
				die();

	    } catch (Exception $ex) {
			echo $ex->getMessage();
	    }
	} else {
		header("Location: ../500.php");
		die();
	}

	
