<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    /**
     * Cette méthode index permet d'afficher la page d'accueil
     *
     * @return string
     */
    function index() : string
    {
        return render("visitor/welcome/index.html.php");
    }


    
    