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


    // Chargement des constantes
    require __DIR__ . "/../config/constants.php";


    // Initialisation du routeur
    require __DIR__ . "/zion/routing/router.php";


    // Chargement des routes dont l'application attend la réception
    require __DIR__ . "/../config/routes.php";


    // Exécution du routeur
    $router_data = run();


    // Le noyau demande au controller de lui retourner les données générées
    return getControllerData($router_data);


    function getControllerData($router_data)
    {
        if (NULL == $router_data) 
        {
            require __DIR__ . "/controller/error/errorController.php";
            return notFound();
        }

        $controller = $router_data['controller'];
        $action     = $router_data['action'];

        if ( isset($router_data['parameters']) && !empty($router_data['parameters']) ) 
        {
            $parameters = $router_data['parameters'];

            require __DIR__ . "/controller/$controller.php";
            return $action($parameters);
        }

        require __DIR__ . "/controller/$controller.php";
        return $action();
    }