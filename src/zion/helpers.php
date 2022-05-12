<?php

    /**
     * Cette fonction affiche le contenu qu'on lui donne 
     * et arrête l'exécution du script
     *
     * @param mixed $data
     * @return mixed
     */
    function dd(mixed $data) : mixed
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";

        die();
    }


    /**
     * Cette fonction affiche le contenu qu'on lui donne 
     * mais n'arrête pas l'exécution du script
     *
     * @param  $data
     */
    function dump($data) 
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }


    /**
     * Cette fonction retourne le premier message d'erreur du tableau d'erreurs liés au formulaire.
     *
     * @param string $input_name
     */
    function formErrors(string $input_name)
    {
        if ( isset($_SESSION['formErrors'][$input_name]) && !empty($_SESSION['formErrors'][$input_name]) ) 
        {
            $data = $_SESSION['formErrors'][$input_name];
            unset($_SESSION['formErrors'][$input_name]);

            foreach ($data as $value) 
            {
                return <<<HTML
<div class="text-danger">$value</div>
HTML;
            }
            
        }
    }



    /**
     * Cette fonction permet de retourner la valeur d'un champs de formulaire.
     *
     * @param string $input_name
     */
    function old(string $input_name)
    {

        if (isset($_SESSION['old'][$input_name]) && !empty($_SESSION['old'][$input_name])) 
        {
            $data = $_SESSION['old'][$input_name];
            unset($_SESSION['old'][$input_name]);

            return $data;
        }
    }