<?php

    function createUser(array $data)
    {

        require DB;
        $table = "user";

        $req = $db->prepare("INSERT INTO {$table} (first_name, last_name, email, password, created_at, updated_at) VALUES (:first_name, :last_name, :email, :password, now(), now() ) ");

        $req->bindValue(":first_name",  $data['firstName']);
        $req->bindValue(":last_name",   $data['lastName']);
        $req->bindValue(":email",       $data['email']);
        $req->bindValue(":password",    password_hash($data['password'], PASSWORD_BCRYPT));

        $req->execute();
        $req->closeCursor();
    }

    