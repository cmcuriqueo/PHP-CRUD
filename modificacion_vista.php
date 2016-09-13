<?php
require __DIR__ . '/header.php';
require_once __DIR__ . '/controller/nacionalidades_controller.php';
if (!array_key_exists('UPDATE', $_SESSION)) {
    header('Location: ../denegado.php');
    die();
}
?>
    <title>Modificación</title>
    <script type="text/javascript" src="<?php echo $bower; ?>/jquery-validation/jquery.ui.datepicker.validation.min.js"></script>
    <script type="text/javascript">
        $().ready(function () {
            jQuery.validator.addMethod('selectcheck', function (value) {
                return (value != '0');
            }, "Campo obligatorio");

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
                    },
                    nacionalidad: {
                        selectcheck: true
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
    <form class="form-horizontal" method="POST" action="update_controller.php" id="formulario_modificacion">
        <div class="container">
            <div class="row-flow">
                <p></p>
                <div class="col-md-10">
                    <div class="panel panel-success">

                        <div class="panel-body">Formulario de Alta</div>

                        <div class="panel-footer">
                            <ul class="list-group">
                                <div class="form-group">
                                    <div class="col-sm-4"><input class="form-control" type="hidden" name="id" value="<?php echo $id_cliente; ?>"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nombre">Nombre : </label>
                                    <div class="col-sm-4"> <input class="form-control" name="nombre" type="text" value="<?php echo $results['nombre'] ?>"/></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="apellido">Apellido : </label>
                                    <div class="col-sm-4"> <input class="form-control" name="apellido" type="text" value="<?php echo $results['apellido'] ?>"/></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="fecha_nacimiento">Fecha de Nacimiento : </label><br/>
                                    <div class="col-sm-4"><input class="form-control" name="fecha_nacimiento" type="text" id="datepicker" value="<?php echo $results['fecha_nacimiento'] ?>"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nacionalidad">Nacionalidad : </label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="nacionalidad" name="nacionalidad">
                                            <optgroup>
                                                <option value="<?php echo $results['id_nacionalidad']; ?>" selected><?php echo $results['nacionalidad']; ?></option>
                                            </optgroup>
                                            <optgroup label="-------------------------------------">
                                                <?php foreach ($nacionalidades as $value): ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['descripcion']; ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Activo">Activo : </label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="activo">
                                            <?php if ($results['activo']): ?>
                                                <option value="1" selected>activo</option>
                                                <option value="0">no activo</option>
                                            <?php else: ?>
                                                <option value="1" >activo</option>
                                                <option value="0" selected>no activo</option>
                                            <?php endif; ?>   
                                        </select>
                                    </div>
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
                                                        <a href="../index.php" class="btn btn-danger">Continuar</a>
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
    