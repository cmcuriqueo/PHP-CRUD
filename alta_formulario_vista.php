<?php
require __DIR__ . '/controller/control_session.php';
require __DIR__ . '/header.php';
require __DIR__ . '/controller/nacionalidades_controller.php';

?>
    <title>Alta</title>
    <script type="text/javascript" src="<?php echo $bower; ?>/jquery-validation/jquery.ui.datepicker.validation.min.js"></script>
    <script type="text/javascript">
        $().ready(function () {
            jQuery.validator.addMethod('selectcheck', function (value) {
                return (value != '0');
            }, "Campo obligatorio");

            $("#formulario_alta").validate({
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
    <form class="form-horizontal" method="POST" action="<?php echo $controller ?>/alta_controller.php" id="formulario_alta">
        <div class="container">
            <div class="row-flow">
                <p></p>
                <div class="col-md-10">
                    <div class="panel panel-success">

                        <div class="panel-body">Formulario de Alta</div>

                        <div class="panel-footer">
                            <ul class="list-group">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nombre">Nombre : </label>
                                    <div class="col-sm-4"> <input class="form-control" name="nombre" type="text" > </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="apellido">Apellido : </label>
                                    <div class="col-sm-4"> <input class="form-control" name="apellido" type="text"> </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="fecha_nacimiento">Fecha de Nacimiento : </label>
                                    <div class="col-sm-4"><input class="form-control" name="fecha_nacimiento" type="text" id="datepicker"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nacionalidad">Nacionalidad : </label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="nacionalidad" name="nacionalidad">
                                            <option value="0">nacionalidad</option>
                                            <!--<option selected></option>-->
                                            <?php foreach ($nacionalidades as $value): ?>
                                                <option value="<?php echo $value['id']; ?>"><?php echo $value['descripcion']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-default" type="submit">Guardar</button>

                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Cancelar</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Cancelar creacion de cliente</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Se perderan todos los datos completados<br/>¿Esta seguro de continuar?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <a href="index.php" class="btn btn-danger">Continuar</a>

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
    