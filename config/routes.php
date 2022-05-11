<?php

    /**
     * -----------------------------------------------------
     * Les routes
     * 
     * Ce fichier est réservé pour la déclaration
     * des routes dont l'application attend la réception
     * -----------------------------------------------------
    */


    
    get("/",            ["visitor/welcome/welcomeController", "index"]);


                    // -------------Auth-----------
    get("/register",    ["visitor/registration/registerController", "register"]);
    post("/register",   ["visitor/registration/registerController", "register"]);

    get("/login",       ["visitor/authentication/loginController", "login"]);
    post("/login",      ["visitor/authentication/loginController", "login"]);

    get("/logout",      ["visitor/authentication/loginController", "logout"]);


                    // -------------Home-----------
    get("/home",        ["user/home/homeController", "index"]);
    




