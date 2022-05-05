<?php
declare(strict_types=1);

    /**
     * Cette fonction permet de récupérer le contenu de la vue 
     * et de retourner à la méthode du contrôleur,
     * une chaine de caractères contenant du code HTML 
     *
     * @param string $view_path
     * @return string
     */
    function render(string $view_path) : string
    {
        ob_start();
        require TEMPLATES . $view_path;
        $content = ob_get_clean();

        ob_start();
        require TEMPLATES . $layout;
        $page = ob_get_clean();

        return (string) $page;
    }


    function extends_of($layout_path)
    {
        return $layout_path;
    }