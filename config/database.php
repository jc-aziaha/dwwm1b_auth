<?php

    /* Connexion à une base MySQL avec l'invocation de pilote */
    $dsn_db = 'mysql:dbname=dwwm1b_auth;host=127.0.0.1';
    $user_db = 'root';
    $password_db = '';

    try
    {
        $db = new PDO($dsn_db, $user_db, $password_db);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    catch(\PDOException $e)
    {
        die("Error: " . $e->getMessage());
    }

?>