<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    /**
     * Cette méthode permet de retourner au noyau, une chaîne de caractères
     * qui représente la page d'accueil.
     * 
     * La chaine de carcatères retournée se trouve dans le fichier index.html.php, 
     * à son emplacement.
     *
     * @return string
     */
    function index() : string
    {
        return render("visitor/welcome/index.html.php");
    }


    
    