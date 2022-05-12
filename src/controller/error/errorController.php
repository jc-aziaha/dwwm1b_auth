<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    /**
     * Cette méthode permet de retourner la page prévue pour, 
     * si l'application ne s'attend pas à recevoir l'information 
     * qui se trouve au niveau de la barre d'url 
     *
     * @return string
     */
    function notFound() : string
    {
        return render("error/not_found.html.php");
    }