<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

require AUTH_MIDDLEWARE;


    /**
     * Cette méthode permet de retourner la page correspondante 
     * à la liste des catégories
     *
     * @return string
     */
    function index() : string
    {
        return render("user/category/index.html.php");
    }



    function create()
    {
        return render("user/category/create.html.php");
    }