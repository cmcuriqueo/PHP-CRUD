<?php
   
    //recuperar la session actual
    session_start();
    
    //cierro la session
    session_unset();
    
    session_destroy();

    //redireccion al index
    header("Location: ../login_vista.php");

