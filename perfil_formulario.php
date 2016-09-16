<?php
require_once __DIR__ . '/controller/control_session.php';
require __DIR__ . '/header.php';
?>
    <title>Modificación de Perfil</title>
    <script type="text/javascript" src="<?php echo $bower; ?>/jquery-validation/jquery.ui.datepicker.validation.min.js"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#formulario_modificacion").validate({
                rules: {
                    nombre: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    apellido: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    fecha_nacimiento: { 
                        required: true, 
                        dpDate: true 
                    }
                },
                messages: {
                    nombre: {
                        required: "Campo obligatorio",
                        minlength: "Longitud minima 3 carácteres",
                        maxlength: "Longitud maxima 20 carácteres"
                    },
                    apellido: {
                        required: "Campo obligatorio",
                        minlength: "Longitud minima 3 carácteres",
                        maxlength: "Longitud maxima 20 carácteres"
                    },
                    fecha_nacimiento: { 
                        required: "Campo obligatorio"
                    }
                }
            });
        });
        $(function () {
            $("#datepicker").datepicker({minDate: new Date('1920-01-01'), maxDate: new Date(), changeYear: true, changeMonth: true, dateFormat: 'dd-mm-yy'});
        });
    </script>
    </head>
    <body> 
    <form class="form-horizontal" method="POST" action="perfil_update_controller.php" id="formulario_modificacion">
        <div class="container">
            <div class="row-flow">
                <p></p>
                <div class="col-md-10">
                    <div class="panel panel-success">

                        <div class="panel-body">Modificacion de perfil</div>

                        <div class="panel-footer">
                            <ul class="list-group">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nombre">Nombre </label>
                                    <div class="col-sm-4"> <input class="form-control" name="nombre" type="text" value="<?php echo $perfil['nombre']; ?>"/></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="apellido">Apellido </label>
                                    <div class="col-sm-4"> <input class="form-control" name="apellido" type="text" value="<?php echo $perfil['apellido']; ?>"/></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="dni">Dni </label>
                                    <div class="col-sm-4"><input class="form-control" name="dni" type="text" value="<?php echo $perfil['dni']; ?>"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="fecha_nacimiento">Fecha de Nacimiento </label><br/>
                                    <div class="col-sm-4"><input class="form-control" name="fecha_nacimiento" type="text" id="datepicker" value="<?php echo $perfil['fecha_nacimiento']; ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default" >Guardar</button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Cancelar</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Cancelar Modificacion</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Se perderan todas las modificaciones realizadas<br/>¿Esta seguro de continuar?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <a href="perfil_controller.php" class="btn btn-danger">Continuar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php if (isset($errores)): ?>
                                        <p>Error al prosesar el formulario</p>
                                        <ul>
                                            <?php foreach ($errores as $valor): ?>
                                                <li style="color: red;"><?php echo $valor; ?></li>
                                                <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    require __DIR__ . '/footer.php';
    