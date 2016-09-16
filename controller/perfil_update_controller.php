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

				require '../perfil_formulario.php';
				die();

	    } catch (Exception $ex) {
			echo $ex->getMessage();
	    }
	} else {
		$nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
		$errores = [];

        if (strlen($nombre) == 0) {
            $errores["nombre"] = "El nombre es requerido";
        }

        if (strlen($apellido) == 0) {
            $errores["apellido"] = "El apellido es requerido";
        }

        if (fecha_nacimiento == null || strlen($fecha_nacimiento) == 0) {
            $errores["fecha_nacimiento"] = "El nombre es requerido";
        }

        if (count($errores) > 0) {

            require __DIR__.'/perfil_formulario.php';
            die();

        } else {
			try{
		    	$pdo = getConnectionUser();
		    	$sql = "UPDATE usuario.persona SET nombre = :nombre, apellido= :apellido, dni= :dni, fecha_nacimiento = :fecha_nacimiento WHERE id = :id ;";
		    	$stmt = $pdo->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
		        $stmt->bindParam(':id', $_SESSION['id_usuario']);
				$stmt->bindParam(':nombre', $nombre);
				$stmt->bindParam(':apellido', $apellido);
				$stmt->bindParam(':dni', $dni);
				$stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);

		        $stmt->execute();

		        header("Location: perfil_controller.php");
		        die();

		    } catch (Exception $ex){
		    	echo $ex->getMessage();
		    	header("Location: ../500.php");
		    }
		}

	}

	
