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


                    // -------------User-----------
    get("/user/home",                ["user/home/homeController", "index"]);
    
    get("/user/category/index",      ["user/category/categoryController", "index"]);
    get("/user/category/create",     ["user/category/categoryController", "create"]);
    post("/user/category/create",    ["user/category/categoryController", "create"]);
    get("/user/category/{id}/edit",    ["user/category/categoryController", "edit"]);
    post("/user/category/{id}/edit",    ["user/category/categoryController", "edit"]);
    get("/user/category/{id}/delete",    ["user/category/categoryController", "delete"]);
    




