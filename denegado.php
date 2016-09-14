<?php
require __DIR__ . '/controller/control_session.php';
require __DIR__ . '/header.php';
require_once __DIR__.'/BaseVistas.php';
?>
<title>Permiso Denegado</title>

</head>
<body> 
    <div class="container">
        <div class="row-fluid">
            <div class="alert alert-danger" role="alert" >Acceso denagado.<br/>No tiene permiso de acceso a esta funcionalidad.</div>
            <a href="index.php" class="btn btn-danger " >Inicio</a>
        </div>
    </div>
    <?php

    require __DIR__ . '/footer.php';
 