<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

require AUTH_MIDDLEWARE;

    function index()
    {
        return render("user/home/index.html.php");
    }