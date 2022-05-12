<?php
declare(strict_types=1);


    /**
     * Cette méthode permet au validateur de valider les données 
     * et de retourner un tableau d'erreurs.
     *
     * @param array $data
     * @param array $validation_rules
     * @param array $messages
     * 
     * @return array
     */
    function makeValidation(array $data, array $validation_rules, array $messages) : array
    {
        $errors = [];

        // Contre les failles XSS
        $data_clean = inputsCleaner1($data);

        // Validation des données
        foreach ($validation_rules as $input_name => $rules) 
        {
            if ( array_key_exists($input_name, $data_clean) ) 
            {
                foreach ($rules as $rule) 
                {
                    foreach ($messages as $key => $message) 
                    {
                        
                        if ( ($rule === "requiredString") && ($key === "$input_name.requiredString") ) 
                        {
                            if ( requiredString_($data_clean[$input_name]) ) 
                            {
                                $errors[$input_name][] = $message;
                            }
                        }
                        else if ( ($rule === "string") && ($key === "$input_name.string") ) 
                        {
                            if ( string_($data_clean[$input_name]) ) 
                            {
                                $errors[$input_name][] = $message;
                            }
                        }
                        else if( (substr($rule, 0, 3) === "max") && ($key === "$input_name.max") )
                        {
                            if ( max_($data_clean[$input_name], $rule) ) 
                            {
                                $errors[$input_name][] = $message;
                            }
                        }
                        else if( (substr($rule, 0, 3) === "min") && ($key === "$input_name.min") )
                        {
                            if ( min_($data_clean[$input_name], $rule) ) 
                            {
                                $errors[$input_name][] = $message;
                            }
                        }
                        else if( ($rule === "email") && ($key === "$input_name.email") )
                        {
                            if ( email_($data_clean[$input_name]) ) 
                            {
                                $errors[$input_name][] = $message;
                            }
                        }
                        else if( (substr($rule, 0, 6) === "exists") && ($key === "$input_name.exists") )
                        {
                            if ( exists_($data_clean[$input_name], $rule) ) 
                            {
                                $errors[$input_name][] = $message;
                            }
                        }
                        else if( (substr($rule, 0, 4) === "same") && ($key === "$input_name.same") )
                        {
                            if ( same_($data_clean[$input_name], $rule, $data_clean) ) 
                            {
                                $errors[$input_name][] = $message;
                            }
                        }
                        else if( (substr($rule, 0, 14) === "existsInUpdate") && ($key === "$input_name.existsInUpdate") )
                        {
                            if ( existsInUpdate_($data_clean[$input_name], $rule) ) 
                            {
                                $errors[$input_name][] = $message;
                            }
                        }
                        
                    }
                }
            }
        }

        return $errors;
    }


// ------------------------------------------------------------------------------


    /**
     * Cette fonction modifie les données d'un enregistrement d'une table.
     * 
     * Lors de la modification, elle ignore l'enregistrement dont les informations 
     * sont en train d'être modifiées.
     *
     * @param string $value
     * @param string $rule
     * 
     * @return bool
     */
    function existsInUpdate_(string $value, string $rule) : bool
    {   

        $cut = strstr($rule, "::");
        $cut = str_replace('::', "", $cut);
        $tab = explode(",", $cut);

        $table   = $tab[0];
        $column  = $tab[1];
        $id      = (int) $tab[2];

        require DB;

        // On récupère tous les enrégistrement de la table souhaitée
        $req = $db->prepare("SELECT * FROM {$table}");
        $req->execute();
        $data = $req->fetchAll();

        // On parcoure le tableau contenant tous les enrégistrements, 
        // Et pour chaque enregistrement
        foreach ($data as $record) 
        {
            // Ignore là oû l'identifiant de l'enregistrement récupéré lors du tour de boucle
            // n'est pas égal à l'identifiant contenu dans la règle de validation

            // Autrement dit, parcours tout le tableau en ignorant l'enregistrement dont l'identifiant
            // n'est pas égal à l'identifiant contentu dans la règle de validation
            if ($record->id != $id) 
            {
                // Si la valeur contenu dans la colonne recherchée est égal à la valeur envoyée 
                // par l'utilisateur depuis le formulaire, c'est qu'il y a une erreur.

                // Autrement dit, le valeur envoyée par l'utilisateur appartient déjà à un enregistrement.
                if ($record->$column == $value ) 
                {
                    return true;
                }    
            }
        }
        
        return false;
    }



    function same_($value, $rule, $data_clean)
    {
        $cut = strstr($rule, "::");
        $cut = str_replace("::", "", $cut);
        
        if ( $value === $data_clean[$cut] ) 
        {
            return false;
        }
        return true;
    }

    /**
     * Cette méthode du validateur permet de vérifier si la valeur envoyée par l'utilisateur 
     * existe déjà dans la table ou non.
     *
     * @param string $value
     * @param string $rule
     * @return boolean
     */
    function exists_(string $value, string $rule) : bool
    {
        // "exists::user,email"

        $cut = strstr($rule, "::");
        $cut = str_replace("::", "", $cut);
        $tab = explode(",", $cut);

        $table  = $tab[0];
        $column = $tab[1];

        require DB;

        $req = $db->prepare("SELECT * FROM {$table} WHERE {$column}=:{$column}");
        $req->bindValue(":{$column}", $value);
        $req->execute();
        $row = $req->rowCount();
        if ($row == 1) 
        {
            return true;
        }
        return false;
    }

    /**
     * Cette méthode du validateur permet de vérifier si l'email est valide ou non.
     *
     * @param string $value
     * 
     * @return boolean
     */
    function email_(string $value) : bool
    {
        if ( ! filter_var($value, FILTER_VALIDATE_EMAIL) )
        {
            return true;
        }
        return false;

        // ------------------

        // if ( filter_var($value, FILTER_VALIDATE_EMAIL) )
        // {
        //     return false;
        // }
        // return true;
    }


    /**
     * Cette méthode du validateur permet de vérifier que le nombre de caractères 
     * envoyé par l'utilisateur soit supérieur à la valeur souhaitée
     *
     * @param string $value
     * @param string $rule
     * 
     * @return boolean
     */
    function min_(string $value, string $rule) : bool
    {

        if(preg_match("/\d+/", $rule, $matches))
        {
            // $max = intval($matches[0]);
            $min = (int) $matches[0];

            if ( mb_strlen($value) < $min ) 
            {
                return true;
            }
            return false;
        }
    }


    /**
     * Cette méthode du validateur permet de vérifier que le nombre de caractères 
     * envoyé par l'utilisateur soit inférieur à la valeur souhaitée
     *
     * @param string $value
     * @param string $rule
     * 
     * @return boolean
     */
    function max_(string $value, string $rule) : bool
    {

        if(preg_match("/\d+/", $rule, $matches))
        {
            // $max = intval($matches[0]);
            $max = (int) $matches[0];

            if ( mb_strlen($value) > $max ) 
            {
                return true;
            }
            return false;
        }
    }


    function string_(string $value) : bool
    {
        if ( ! is_string($value) ) 
        {
            return true;
        }
        return false;
    }

    /**
     * Cette méthode du validateur permet de vérifier si tous les inputs sont remplis
     *
     * @param string $value
     * 
     * @return boolean
     */
    function requiredString_(string $value) : bool
    {
        if ( !isset($value) || empty($value) ) 
        {
            return true;
        }
        return false;
    }

    /**
     * Cette méthode du validateur permet de rendre propre les données provenant du formulaire.
     * Elle permet de se protéger contre les failles de type XSS en supprimant les balises et les espaces
     * vides en début et fin de chaîne de caractères s'il y en a. 
     *
     * @param array $data
     * 
     * @return array
     */
    function inputsCleaner1(array $data) : array
    {
        $tab = [];

        foreach ($data as $key => $value) 
        {
            $tab[$key] = strip_tags(trim($value));
        }

        return $tab;
    }