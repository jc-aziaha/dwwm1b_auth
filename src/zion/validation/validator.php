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
                    }
                }
            }
        }

        return $errors;
    }


// ------------------------------------------------------------------------------


    function string_($value)
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