<?php

    /**
     * Cette méthode permet d'authentifier les utilisateurs de l'application
     *
     * @param array $data_clean
     * @return void
     */
    function authenticateUser(array $data_clean)
    {
        // Etablissons une connexion avec la base de données
        require DB;

        $table = "user";

        // Faisons une requête pour vérifier si l'email envoyé par l'utilisateur existe dans la table
        $req = $db->prepare("SELECT * FROM {$table} WHERE email=:email");

        // On passe les vraies valeurs à la requête préparée
        $req->bindValue(":email", $data_clean['email']);

        // On éxécute la requête
        $req->execute();

        // On recupère le nombre d'enregistrements ou d'utilisateurs
        $row = $req->rowCount();

        // Si le nombre récupéré n'est pas égal à 1, c'est mort
        // On retourne la valeur null au controller
        if ($row != 1) 
        {
            return null;
        }

        // Dans le cas contraire, on récupère les données de l'utilisateur 
        $user = $req->fetch();

        // On vérifie ensuite son mot de passe
        // Si ça ne match pas, c'est mort
        // On retourne la valeur null au controller
        if ( ! password_verify($data_clean['password'], $user->password) ) 
        {
            return null;
        }

        // Dans le cas contraire, on retourne au controller les données de l'utilisateur
        return $user;

        
        
    } 