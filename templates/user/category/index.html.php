<?php $layout = extends_of('layout/base_user.html.php'); ?>

<?php $title = "Espace d'administration / Liste des catégories"; ?>

<h1 class="text-center my-3 display-5">Liste des catégories</h1>

<div class="d-flex justify-content-end align-items-center my-3">
    <a href="/user/category/create" class="btn btn-primary">Nouvelle catégorie</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered text-center">
        <thead class="bg-dark text-white">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Créé le</th>
                <th>Modifié le</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $category) : ?>
                <tr>
                    <td><?= htmlspecialchars(addslashes($category->id)) ?></td>
                    <td><?= htmlspecialchars(addslashes($category->name)) ?></td>
                    <td><?= htmlspecialchars(addslashes($category->created_at)) ?></td>
                    <td><?= htmlspecialchars(addslashes($category->updated_at)) ?></td>
                    <td>
                        <a href="/user/category/<?= htmlspecialchars(addslashes($category->id)) ?>/edit" class="btn btn-sm btn-secondary">Modifier</a>
                        <a href="/user/category/<?= htmlspecialchars(addslashes($category->id)) ?>/delete" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression? ')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>