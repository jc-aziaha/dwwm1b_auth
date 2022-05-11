<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    function index()
    {
        return render("user/home/index.html.php");
    }