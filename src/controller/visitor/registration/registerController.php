<?php
declare(strict_types=1);

// Ce contr$oleur fait appel au contrôleur abstrait afin d'utilser sa méthode render 
require ABSTRACT_CONTROLLER;



    /**
     * Cette méthode permet de retourner au noyau, une chaîne de caractères
     * qui représente la page d'inscription.
     * 
     * La chaine de carcatères retournée se trouve dans le fichier register.html.php, 
     * à son emplacement.
     *
     * @return string
     */
    function register() : string
    {
        return render("visitor/registration/register.html.php");
    }