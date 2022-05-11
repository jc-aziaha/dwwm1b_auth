<?php
declare(strict_types=1);

// Ce contrôleur fait appel au contrôleur abstrait afin d'utilser ses méthodes
require ABSTRACT_CONTROLLER;



    /**
     * Cette méthode permet de retourner au noyau, une chaîne de caractères
     * qui représente la page d'inscription.
     * 
     * La chaine de carcatères retournée se trouve dans le fichier register.html.php, 
     * à son emplacement.
     *
     * @return string
     */
    function register() : string
    {
        if ( $_SERVER['REQUEST_METHOD'] === "POST" ) 
        {
            require VALIDATOR;

            $errors = makeValidation($_POST, 
            [
                "firstName"             => ["requiredString", "string", "max::255"],
                "lastName"              => ["requiredString", "string", "max::255"],
                "email"                 => ["requiredString", "string", "min::5", "max::255", "email", "exists::user,email"],
                "password"              => ["requiredString", "string", "min::8", "max::255"],
                "confirmPassword"       => ["requiredString", "string", "min::8", "max::255", "same::password"]
            ], 
            [
                "firstName.requiredString"          => "Le prénom est obligatoire.",
                "firstName.string"                  => "Veuillez entrer une chaîne de caractères.",
                "firstName.max"                     => "Le prénom doit contenir au maximum 255 caractères.",

                "lastName.requiredString"           => "Le nom est obligatoire.",
                "lastName.string"                   => "Veuillez entrer une chaîne de caractères.",
                "lastName.max"                      => "Le nom doit contenir au maximum 255 caractères.",

                "email.requiredString"              => "L'email est obligatoire.",
                "email.string"                      => "Veuillez entrer une chaîne de caractères.",
                "email.min"                         => "L'email doit contenir au minimum 5 caractères.",
                "email.max"                         => "L'email doit contenir au maximum 255 caractères.",
                "email.email"                       => "Veuillez entrer un email valide.",
                "email.exists"                      => "Impossible de créer un compte avec cet email.",

                "password.requiredString"           => "Le mot de passe est obligatoire.",
                "password.string"                   => "Veuillez entrer une chaîne de caractères.",
                "password.min"                      => "Le mot de passe doit contenir au minimum 5 caractères.",
                "password.max"                      => "Le mot de passe doit contenir au maximum 255 caractères.",

                "confirmPassword.requiredString"    => "La confirmation du mot de passe est obligatoire.",
                "confirmPassword.string"            => "Veuillez entrer une chaîne de caractères.",
                "confirmPassword.min"               => "La confirmation du mot de passe doit contenir au minimum 5 caractères.",
                "confirmPassword.max"               => "La confirmation du mot de passe doit contenir au maximum 255 caractères.",
                "confirmPassword.same"              => "Le mot de passe doit être identique à sa confirmation.",
            ]);

            if ( count($errors) > 0 ) 
            {
                $_SESSION['old'] = inputsCleaner1($_POST);
                $_SESSION['formErrors'] = $errors;
                
                return redirectBack();
            }

            require USER;

            $data_clean = inputsCleaner1($_POST);
            createUser($data_clean);

            return header("Location: /login");
        }
        
        return render("visitor/registration/register.html.php");
    }