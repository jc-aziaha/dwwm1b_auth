<?php

    /**
     * -----------------------------------------------------
     * Les routes
     * 
     * Ce fichier est réservé pour la déclaration
     * des routes dont l'application attend la réception
     * -----------------------------------------------------
    */


    
    get("/", ["visitor/welcome/welcomeController", "index"]);


                    // -------------Auth-----------
    get("/register", ["visitor/registration/registerController", "register"]);

