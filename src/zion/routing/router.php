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

        foreach ($routes[$_SERVER['REQUEST_METHOD']] as $route) 
        {
            $uri_route = $route[0];
            $uri_url   = strip_tags(urldecode(parse_url(trim($_SERVER['REQUEST_URI']), PHP_URL_PATH)));

            $pattern = preg_replace("#{[a-z]+}#", "([a-zA-Z0-9-_]+)", $uri_route);
            $pattern = "#^$pattern$#";

            if ( preg_match($pattern, $uri_url, $matches) ) 
            {
                array_shift($matches);
                $parameters = $matches;

                $controller = $route[1][0];
                $action     = $route[1][1];

                if ( $parameters ) 
                {
                    return [
                        "controller" => $controller,
                        "action"     => $action,
                        "parameters" => $parameters
                    ];
                }

                return [
                    "controller" => $controller,
                    "action"     => $action,
                ];
            }
        }

        return null;
    }