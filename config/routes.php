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

    get("/category/{id}", ["visitor/welcome/welcomeController", "index"]);
    