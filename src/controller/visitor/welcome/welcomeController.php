<?php
declare(strict_types=1);

    /**
     * Cette méthode index permet d'afficher la page d'accueil
     *
     * @return string
     */
    function index() : string
    {
        ob_start();
        require TEMPLATES . "visitor/welcome/index.html.php";
        $content = ob_get_clean();

        return (string) $content;
    }
    