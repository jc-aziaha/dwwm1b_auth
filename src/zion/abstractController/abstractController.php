<?php
declare(strict_types=1);

    /**
     * Cette méthode du contrôleur abstrait permet de récupérer sous forme de chaîne de caractères, la page à afficher
     * et ensuite, de retourner cette chaîne à la méthode du contrôleur qui la lui demande.
     * 
     * *** En utilisant cette méthode, l'on se place automatiquement à la racine du dossier "templates" ***
     *
     * @param string $view_path
     * @return string
     */
    function render(string $view_path) : string
    {
        // 1) Déclenchement de la temporisation de sortie avec ob_start(),
        // 2) et chargement dans cette mémoire du fichier contenant le code HTML de la vue
        // 3) Récupération du contenu du fichier grâce à ob_get_clean() et sauvegarde de ce dernier dans $content
        // parce que ob_get_clean() détruit le contenu juste après l'avoir lu.
        ob_start();
        require TEMPLATES . $view_path;
        $content = ob_get_clean();

        // 5) Déclenchement d'une nouvelle temporisation de sortie avec ob_start(),
        // 6) et chargement dans cette mémoire du fichier contenant le code HTML du layout
        // 7) Récupération du contenu du fichier grâce à ob_get_clean() et sauvegarde de ce dernier dans $page
        // parce que ob_get_clean() détruit le contenu juste après l'avoir lu.
        ob_start();
        require TEMPLATES . $layout;
        $page = ob_get_clean();

        // Au final, c'est la page qui est retournée au contrôleur
        return (string) $page;
    }


    /**
     * 4- Cette méthode permet de récupérer le layout dont hérite une vue
     * 
     * Cette méthode est activée dans la mémoire tampon
     * 
     * @param string $layout_path
     * @return string
     */
    function extends_of(string $layout_path) : string
    {
        return $layout_path;
    }


    /**
     * Cette fonction permet d'effectuer une redirection 
     * vers la page de laquelle proviennent les données 
     *
     * @return void
     */
    function redirectBack() : void
    {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }