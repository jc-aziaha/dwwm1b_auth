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
     * @param mixed $data
     * @return mixed
     */
    function dump(mixed $data) : mixed
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }