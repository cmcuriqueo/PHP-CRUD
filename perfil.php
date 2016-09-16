<?php
    require_once __DIR__ . '/controller/control_session.php';
    require_once __DIR__ . '/header.php';
?>
    <title>Perfil</title>

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
                	<a class="navbar-brand" href="../index.php"><img src="<?php echo $bower; ?>/avatar.png"></a>
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
                      			<li><a href="cerrar_session.php">Cerrar Session</a></li>
                    		</ul>
                  		</li>
                	</ul>
              	</div>
            </nav>
            <div class="panel panel-success">
            	<div class="panel-body">Usuario <small><?php echo $_SESSION['nombre_usuario']; ?></small></div>
            	<div class="panel-footer">
            		<blockquote>
						<p>Nombre: <?php echo $perfil['nombre']; ?></p>
					</blockquote>
					<blockquote>
						<p>Apellido: <?php echo $perfil['apellido']; ?></p>
					</blockquote>
            		<blockquote>
						<p>DNI: <?php echo $perfil['dni']; ?></p>
					</blockquote>
            		<blockquote>
						<p>Fecha de Nacimiento: <?php echo $perfil['fecha_nacimiento']; ?></p>
					</blockquote>
						<p class="text-center"><a href="perfil_update_controller.php" class="btn btn-info">Modificar</a></p>
            	</div>
            </div>
    	</div>
   	</div>
	<?php 
	    require_once __DIR__ . '/footer.php';
