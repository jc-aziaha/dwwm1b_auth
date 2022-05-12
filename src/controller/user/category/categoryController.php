<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

require AUTH_MIDDLEWARE;


    /**
     * Cette méthode permet de retourner la page correspondante 
     * à la liste des catégories
     *
     * @return string
     */
    function index() : string
    {
        // On fait appel au manager de la table "category"
        require CATEGORY;

        // On fait la requête pour récupérer toutes les catégories de la table "category"
        $categories = findAllCategories();

        // Et on retourne à cette vue, ces catégories
        return render("user/category/index.html.php", ["categories" => $categories]);
        // return render("user/category/index.html.php", array("categories" => $categories));
        // return render("user/category/index.html.php", compact("categories"));
    }


    /**
     * Cette méthode permet de retourner la page correspondante 
     * à la création d'une catégorie
     *
     * @return string
     */
    function create() : string
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") 
        {
            require VALIDATOR;
            $errors = makeValidation($_POST, 
            [
                "name" => ["requiredString", "string", "max::255", "exists::category,name"],
            ],
            [
                "name.requiredString"   => "Le nom est obligatoire",
                "name.string"           => "Veuillez entrer une chaîne de caractères.",
                "name.max"              => "Le nom doit contenir au maximum 255 caractères.",
                "name.exists"           => "Cette catégorie existe déjà; Veuillez en choisir une autre.",
            ]);

            if (count($errors) > 0) 
            {
                $_SESSION['old']        = inputsCleaner1($_POST);
                $_SESSION['formErrors'] = $errors;
                return redirectBack();
            }

            require CATEGORY;
            createCategory(inputsCleaner1($_POST));

            return redirectToUrl("/user/category/index");
        }

        return render("user/category/create.html.php");
    }


    function edit($data)
    {
        $id = (int) strip_tags(htmlspecialchars($data[0]));

        require CATEGORY;
        $category = findCategoryBy(["id" => $id]);

        if ( ! $category ) 
        {
            return redirectToUrl("/user/category/index");
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") 
        {
            require VALIDATOR;
            $errors = makeValidation($_POST, 
            [
                "name" => ["requiredString", "string", "max::255", "existsInUpdate::category,name,$category->id"],
            ],
            [
                "name.requiredString"   => "Le nom est obligatoire",
                "name.string"           => "Veuillez entrer une chaîne de caractères.",
                "name.max"              => "Le nom doit contenir au maximum 255 caractères.",
                "name.existsInUpdate"   => "Cette catégorie existe déjà; Veuillez en choisir une autre.",
            ]);

            if (count($errors) > 0) 
            {
                $_SESSION['old']        = inputsCleaner1($_POST);
                $_SESSION['formErrors'] = $errors;
                return redirectBack();
            }

            updateCategory(inputsCleaner1($_POST), $category->id);

            return redirectToUrl("/user/category/index");
        }

        return render("user/category/edit.html.php", compact('category'));
    }


    function delete($data)
    {
        $id = (int) strip_tags(htmlspecialchars($data[0]));

        require CATEGORY;
        $category = findCategoryBy(["id" => $id]);

        if ( ! $category ) 
        {
            return redirectToUrl("/user/category/index");
        }

        deleteCategory($category->id);

        return redirectToUrl("/user/category/index");

    }