<?php $layout = extends_of("layout/base_user.html.php"); ?>

<?php $title = "Espace d'administration / Modification de cette catégorie"; ?>

<h1 class="text-center my-3 display-5">Modification de cette catégorie</h1>

<div class="container mt-5">
    <form action="/user/category/<?= htmlspecialchars($category->id) ?>/edit" method="POST">
        <div class="mb-3">
            <label for="name">Nom</label>
            <?= formErrors('name') ?>
            <input type="text" name="name" class="form-control" id="name" autofocus value="<?= old('name') ?? $category->name ?>" />
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success" value="Créer" />
        </div>
    </form>
</div>