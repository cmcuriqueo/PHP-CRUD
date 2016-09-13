<?php 
    require_once __DIR__.'/db_connect.php';
    session_start();
    
    if(!array_key_exists('UPDATE', $_SESSION ) ) {
        header('Location: ../denegado.php');
    }
    if(!empty($_POST)){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
        $nacionalidad = (int)$_POST['nacionalidad'];
         
        $errores = [];
        $valores = [];
        
        $valores['activo'] = $_POST['activo'];
        $valores['fecha_nacimiento'] = $fecha_nacimiento;

        if (strlen($nombre) == 0) {
            $errores["nombre"] = "El nombre es requerido";
        } else {
            $valores['nombre'] = $nombre;
        }

        if (strlen($apellido) == 0) {
            $errores["apellido"] = "El apellido es requerido";
        } else {
            $valores['apellido'] = $apellido;
        }
        
        if (strcmp($nacionalidad, "0") == 0) {
            $errores["nacionalidad"] = "La nacionalidad es requerida";
        } else {
            $valores['nacionalidad'] = $nacionalidad;
        }


        if (count($errores) > 0) {

            require __DIR__.'/modificacion_controller.php';
            die();

        } else {
            try {
                $pdo = getConnection();

                $sql = "UPDATE clientes 
                        SET apellido = UPPER( :apellido ), 
                            nombre = UPPER( :nombre), 
                            fecha_nacimiento = :fecha_nacimiento, 
                            activo = :activo, 
                            nacionalidad_id = :nacionalidad
                        WHERE clientes.id = :id";


                $stmt = $pdo->prepare($sql);
                //especid¿ficamos la salida como un array
                $stmt->setFetchMode(PDO::FETCH_ASSOC); //podria ser PDO::FETCH_OBJ

                $stmt->bindParam(':id', $_SESSION['id_cliente']);
                $stmt->bindParam(':nombre', $valores['nombre']);
                $stmt->bindParam(':apellido', $valores['apellido']);
                $stmt->bindParam(':activo', $valores['activo']);
                $stmt->bindParam(':fecha_nacimiento', $valores['fecha_nacimiento']);
                $stmt->bindParam(':nacionalidad', $valores['nacionalidad']);

                //ejecutamos la consulta
                $stmt->execute();
                
                $_SESSION['modificado'] = true;
                //redirecion a inicio
                header("Location: ../index.php");

            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    }


