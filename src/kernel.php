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


    // Activation de l'utilisation des sessions
    session_start();


    // Chargement de l'autoloader
    require __DIR__ . "/../vendor/autoload.php";


    // Chargement des constantes
    require __DIR__ . "/../config/constants.php";


    // Initialisation du routeur
    require __DIR__ . "/zion/routing/router.php";


    // Chargement des routes dont l'application attend la réception
    require __DIR__ . "/../config/routes.php";


    // Exécution du routeur
    $router_data = run();


    // Le noyau demande au controller de lui retourner les données générées
    // et il le retourne au frontController
    return getControllerData($router_data);



    /**
     * Cette méthode du noyau permet de retourner la page 
     * sous la forme d'une chaine de caractères;
     * Que la route existe ou non
     *
     * @param array|null $router_data
     * @return string
     */
    function getControllerData( array|null $router_data) : string
    {
        // Si la route n'existe pas, on retourne une page d'erreur au frontController 
        if (NULL == $router_data) 
        {
            require __DIR__ . "/controller/error/errorController.php";
            return notFound();
        }

        // Dans le cas contraire, récupère le contrôleur et son action à exécuter
        $controller = $router_data['controller'];
        $action     = $router_data['action'];

        /*
        * Le noyau récupère également les paramètres s'il y en a.
        * Ensuite, il demande au contrôleur d'exécuter sa méthode chargée de cette tâche en lui passant les paramètres.
        * Puis le contrôleur retourne au noyau, la page correspondante à afficher sous forme de chaîne de caractères.
        * Le noyau récupère la chaine de caractères et la retourne au frontContrôleur
        */
        if ( isset($router_data['parameters']) && !empty($router_data['parameters']) ) 
        {
            $parameters = $router_data['parameters'];

            require __DIR__ . "/controller/$controller.php";
            return $action($parameters);
        }

        /* Et s'il n'y a pas de paramètres, 
         * il demande au contrôleur d'exécuter sa méthode chargée de cette tâche en lui ne passant aucun paramètre.
         * Puis le contrôleur retourne au noyau, la page correspondante à afficher sous forme de chaîne de caractères.
         * Le noyau récupère la chaine de caractères et la retourne au frontContrôleur
        */
        require __DIR__ . "/controller/$controller.php";
        return $action();
    }