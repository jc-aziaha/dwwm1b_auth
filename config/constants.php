<?php

    /**
     * --------------------------------------------
     * Les constantes
     * 
     * Ce fichier regroupe les différentes constantes
     * dont l'application a besoin pour fonctionner
     * --------------------------------------------
    */

    /**
     * Cette constante est un raccourci qui permet de se positionner 
     * automatiquement dans le dossier "templates"
     */
    const TEMPLATES             = __DIR__ . "/../templates/";


    /**
     * Cette constante est un raccourci qui permet de charger le contrôleur abstrait
     */
    const ABSTRACT_CONTROLLER   = __DIR__ . "/../src/zion/abstractController/abstractController.php";


    /**
     * Cette constante est un raccourci qui permet d'appeler le validateur
     */
    const VALIDATOR             = __DIR__ . "/../src/zion/validation/validator.php";


    

    /**
     * Cette constante est un raccourci qui permet de charger l'authentificateur de l'application
     */
    const AUTH_AUTHENTICATOR    = __DIR__ . "/../src/security/authAuthenticator.php";


    /**
     * Cette constante est un raccourci qui permet de charger le "middleware" d'authentification
     */
    const AUTH_MIDDLEWARE       = __DIR__ . "/middleware/authMiddleware.php";






// ---------------------------------------------Start Model-----------------------------------------------

    /**
     * Cette constante est un raccourci qui permet d'établir une connexion avec la base de données
     */
    const DB                    = __DIR__ . "/database.php";


    /**
     * Cette constante est un raccourci qui permet de charger le manager de table "user"
     */
    const USER                  = __DIR__ . "/../src/manager/user.php"; 


    /**
     * Cette constante est un raccorci qui permet de charger le manager de la table "category"
     */
    const CATEGORY              = __DIR__ . "/../src/manager/category.php";

