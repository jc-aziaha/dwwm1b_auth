<?php



    function createCategory(array $data) : void
    {
        require DB;
        $table = "category";

        $req = $db->prepare("INSERT INTO {$table} (name, created_at, updated_at) VALUES(:name, now(), now() )");
        $req->bindValue(":name", $data['name']);
        $req->execute();
        $req->closeCursor();
    }

    function findAllCategories()
    {
        require DB;
        $table = "category";

        $req = $db->prepare("SELECT * FROM {$table}");
        $req->execute();
        $categories = $req->fetchAll();
        $req->closeCursor();
        return $categories;
    }

    function findCategoryBy(array $criteria)
    {
        require DB;
        $table = "category";

        $column = array_key_first($criteria);

        $req = $db->prepare("SELECT * FROM {$table} WHERE {$column}=:{$column}");
        $req->bindValue(":{$column}", $criteria[$column]);
        $req->execute();
        $category = $req->fetch();
        $req->closeCursor();
        return $category;
    }

    function updateCategory($data, $id)
    {
        require DB;
        $table = "category";

        $req = $db->prepare("UPDATE {$table} SET name=:name, updated_at=now() WHERE id=:id");

        $req->bindValue(":name", $data['name']);
        $req->bindValue(":id", $id);

        $req->execute();
        $req->closeCursor();
    }


    function deleteCategory($id)
    {
        require DB;
        $table = "category";

        $req = $db->prepare("DELETE FROM {$table} WHERE id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        $req->closeCursor(); 
    }