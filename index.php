    <?php
        require __DIR__ . '/header.php';
        require __DIR__ . '/controller/clientes.php';
        require __DIR__ . '/controller/control_session.php';
        if(!array_key_exists('contador', $_SESSION )){
            $_SESSION['contador'] = 0;
        }
        $_SESSION['contador'] = $_SESSION['contador'] + 1;
    ?>
    <title>Clientes</title>

    </head>
    <body>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default" role="navigation">
              <!-- El logotipo y el icono que despliega el menú se agrupan
                   para mostrarlos mejor en los dispositivos móviles -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                  <span class="sr-only">Desplegar navegación</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Logotipo</a>
              </div>
              <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                   otro elemento que se pueda ocultar al minimizar la barra -->
              <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Menú<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                             <span class="glyphicon glyphicon-user"></span>
                            <?php
                              if(array_key_exists('nombre_usuario', $_SESSION)) {
                                echo $_SESSION['nombre_usuario'];
                              }
                            ?>
                          </a>
                      </li>
                      <li class="divider"></li>
                      <li><a href="controller/cerrar_session.php">Cerrar Session</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
            <div class="col-md-8">
                <h3>Clientes <!-- Boton de insercion  -->
                    <?php if(array_key_exists('INSERT', $_SESSION ))
                        {   echo '<a class="btn btn-large" href="alta_formulario_vista.php">Nuevo</a>'; }
                    ?>
                </h3>
                <table class="table table-condensed">
                    <tr>
                        <td><strong>Nombre</strong></td>
                        <td><strong>Edad</strong></td>
                        <td><strong>Nacionalidad</strong></td>
                        <td><strong>Activo</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php foreach ($results as $fila): ?>
                        <tr>
                            <td><?php echo $fila['apellido'] . ", " . $fila['nombre']; ?></td>
                            <td><?php echo $fila['edad'] ?></td>
                            <td><?php echo $fila['nacionalidad'] ?></td>

                            <?php if ($fila['activo']): ?> <!-- activo -->
                                    <td><span class="glyphicon glyphicon-ok"></span></td>
                            <?php else: ?>
                                    <td><span class="glyphicon glyphicon-remove"></span></td>
                            <?php endif; ?>

                            <td><!-- Boton de modificacion -->
                               <?php if(array_key_exists('UPDATE', $_SESSION )){
                                   echo '<a href="controller/modificacion_controller.php?id='.$fila["id"].'" class="btn btn-default" >
                                                 <span class="glyphicon glyphicon-pencil"></span> Modificar
                                            </a>'; }
                               ?>
                            </td>
                            <td> <!-- Boton de eliminacion -->
                               <?php if(array_key_exists('DELETE', $_SESSION )){
                                   echo '<a class="btn btn-danger" href="controller/baja_controller.php?id='.$fila["id"].'">
                                                    <span class="glyphicon glyphicon-trash" ></span> Eliminar
                                              </a>
                                    '; }
                               ?>
                            </td>
                        </tr>
                    <?php endforeach; ?><!-- Fin de lista de clientes -->
                </table>
            </div>

            <div class="col-md-4"> <!-- Notificaciones de Alta, Baja, Insercion-->
                <?php
                if(array_key_exists('agregaado', $_SESSION )){
                       echo  '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Agregado!</strong> El cliente se ha agregado correctamente..
                                  </div>';
                        unset($_SESSION['agregaado']);

                }
                else if (array_key_exists('eliminado', $_SESSION )&& $_SESSION['eliminado'] == true){
                       echo  '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Eliminado!</strong> El cliente se ha eliminado correctamente..
                                  </div>';
                       unset($_SESSION['eliminar']);
                }
                else if (array_key_exists('modificado', $_SESSION )&& $_SESSION['modificado'] == true){
                       echo  '<div class="alert alert-info">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Modificado!</strong> El cliente se ha modificado correctamente..
                                  </div>';
                       unset($_SESSION['modificado']);
                }
                ?>
            </div>
        </div>
        <div class="row"> <!-- Contador de visitas -->
            <div class="col-md-8">
                <h4> Has visitado esta pagina <?php echo $_SESSION['contador']; ?></h4>
            </div>
        </div>
    </div>
<?php
require __DIR__ . '/footer.php';
