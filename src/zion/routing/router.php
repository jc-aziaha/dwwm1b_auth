<?php
declare(strict_types=1);

    /**
     * -------------------------------------------------
     * Le routeur
     * -------------------------------------------------
    */


    /**
     * Cette méthode permet de recenser les routes dont l'application
     * attend la réception via la méthode "GET"
     *
     * @param string $uri_route
     * @param array $action_route
     * @return void
     */
    function get(string $uri_route, array $action_route) : void
    {
        addRoute("GET", $uri_route, $action_route);
    }

    /**
     * Cette méthode permet de recenser les routes dont l'application
     * attend la réception via la méthode "POST"
     *
     * @param string $uri_route
     * @param array $action_route
     * @return void
     */
    function post(string $uri_route, array $action_route) : void
    {
        addRoute("POST", $uri_route, $action_route);
    }


    /**
     * Cette méthode permet d'ajouter la route que le router lui donne 
     * à une armoire à routes.
     *
     * @param string $request_method
     * @param string $uri_route
     * @param array $action_route
     * @return void
     */
    function addRoute(string $request_method, string $uri_route, array $action_route) : void
    {
        // Armoire à routes
        global $routes;
        $route = [];

        $route[] = $uri_route;
        $route[] = $action_route;

        $routes[$request_method][] = $route;
    }

    /**
     * Cette méthode permet d'exécuter le routeur
     * et de retourner au noyau : 
     *      - soit un tableau contenant le controller et ses données
     *      - soit null
     *
     * @return array|null
     */
    function run() : ?array
    {
        global $routes;

        // echo "<pre>";
        // var_dump($routes); die();
        // echo "</pre>";

        // On parcours chaque clé de "$routes"
        foreach ($routes[$_SERVER['REQUEST_METHOD']] as $route) 
        {
            // Et pour chaque route,

            // On récupère son uri
            $uri_route = $route[0];

            // On récupère l'uri provenant de la barre d'url
            $uri_url   = strip_tags(urldecode(parse_url(trim($_SERVER['REQUEST_URI']), PHP_URL_PATH)));

            // Et ensuite, on va comparer les 2 uri

            // Et pour ça, on prepare un pattern
            $pattern = preg_replace("#{[a-z]+}#", "([a-zA-Z0-9-_]+)", $uri_route);
            $pattern = "#^$pattern$#";

            // Si le pattern match avec l'uri_url, 
            // c'est que la route existe 
            if ( preg_match($pattern, $uri_url, $matches) ) 
            {
                // On supprime le premier indice du tableau, 
                // qui contient par défautt l'uri de l'url
                array_shift($matches);
                $parameters = $matches;

                // On récupère le controller et l'action à retourner au noyau
                $controller = $route[1][0];
                $action     = $route[1][1];

                // Si le tableau $parameters n'est pas vide, 
                // C'est que il y a des données dynamiques passées à la route
                if ( $parameters ) 
                {
                    // On retourne au noyau le controller correspondant
                    // ainsi que son action et le ou les paramètres
                    return [
                        "controller" => $controller,
                        "action"     => $action,
                        "parameters" => $parameters
                    ];
                }

                // Sinon, on retourne uniquement le controller et son action à executer
                return [
                    "controller" => $controller,
                    "action"     => $action,
                ];
            }
        }

        // Si la route ne match pas, le routeur retourne null comme valeur au kernel
        return null;
    }