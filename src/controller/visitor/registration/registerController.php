<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    function register() : string
    {
        return render("visitor/registration/register.html.php");
    }