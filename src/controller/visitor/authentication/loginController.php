<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    /**
     * Cette méthode permet de retourner la page de connexion 
     * et de traiter les données du formulaire qui s'y trouve.
     *
     * @return string
     */
    function login() : string
    {

        if ( $_SERVER['REQUEST_METHOD'] === "POST") 
        {
            require VALIDATOR;

            $errors = makeValidation($_POST, 
            [
                "email"         => ["requiredString", "string", "min::5", "max::255", "email"],
                "password"      => ["requiredString", "string", "min::8", "max::255"]
            ], 
            [
                "email.requiredString"      => "L'email est obligatoire.",
                "email.string"              => "Veuillez entrer une chaîne de caractères valides.",
                "email.min"                 => "L'email doit contenir au minimum 5 caractères.",
                "email.max"                 => "L'email doit contenir au maximum 255 caractères.",
                "email.email"               => "Veuillez entrer un email valide.",

                "password.requiredString"   => "Le mot de passe est obligatoire.",
                "password.string"           => "Veuillez entrer une chaîne de caractères valides.",
                "password.min"              => "Le mot de passe doit contenir au minimum 8 caractères.",
                "password.max"              => "Le mot de passe doit contenir au maximum 255 caractères."
            ]);

            if (count($errors) > 0) 
            {
                $_SESSION['old']        = inputsCleaner1($_POST);
                $_SESSION['formErrors'] = $errors;
                return redirectBack();
            }

            require AUTH_AUTHENTICATOR;

        }

        return render("visitor/authentication/login.html.php");
    }