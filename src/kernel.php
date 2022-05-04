<?php

    /**
     * ---------------------------------------------------------
     *                          Kernel
     * 
     * Ce fichier représente le noyau de l'application
     * 
     * @author Jean-Claude AZIAHA <aziaha.formations@gmail.com>
     * 
     * @version 1.0.0
     * ---------------------------------------------------------
    */


    // Initialisation du routeur
    require __DIR__ . "/zion/routing/router.php";


    // Chargement des routes dont l'application attend la réception
    require __DIR__ . "/../config/routes.php";


    // Exécution du routeur
    $data = run();

    var_dump($data); die();