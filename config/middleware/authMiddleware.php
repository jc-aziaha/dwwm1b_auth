<?php

    function handle()
    {
        if ( !isset($_SESSION['auth']) || empty($_SESSION['auth']) ) 
        {

            session_destroy();
            unset($_SESSION);
            $_SESSION = [];

            return redirectToUrl('/login');
        }
    }

    handle();