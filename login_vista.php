<?php require __DIR__ . '/header.php';  ?>
    <title>Login</title>
    <script type="text/javascript">
        $().ready(function () {
            $("#formulario_login").validate({
                rules:{
                    nombre:{required: true,minlength: 3,maxlength: 15},
                    contrasenia:{required: true,minlength: 2,maxlength: 15}
                },
                messages:{
                    nombre:{required:"Campo obligatorio",minlength:"Longitud minima 2 carácteres",maxlength:"Longitud maxima 20 carácteres"},
                    contrasenia:{required:"Campo obligatorio",minlength:"Longitud minima 2 carácteres",maxlength:"Longitud maxima 15 carácteres"}
                }
            });
        });
    </script>
    </head>
    <body> 
    <form class="form-horizontal" method="POST" action="<?php echo $controller ?>/login.php" id="formulario_login">
        <div class="container">
            <div class="row-flow">
                <p></p>
                <div class="col-md-10">
                    <div class="panel panel-success">

                        <div class="panel-body">Inicio de Session</div>

                        <div class="panel-footer">
                            <ul class="list-group">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nombre">Nombre </label>
                                    <div class="col-sm-10"> <input name="nombre" type="text" > </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="contrasenia">Contraseña </label>
                                    <div class="col-sm-10"> <input name="contrasenia" type="password"> </div>
                                </div> 
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Iniciar</button>
                                    </div>   
                                </div>                           
                                <div class="form-group">
                                    <?php if (isset($errores)): ?>
                                        <p>Error al prosesar</p>
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
    