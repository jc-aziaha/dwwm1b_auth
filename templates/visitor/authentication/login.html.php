<?php $layout = extends_of("layout/base_visitor.html.php"); ?>

<?php $title = "Connexion"; ?>

<h1 class="text-center my-3 display-5">Connexion</h1>

<div class="container my-5">
    <form action="/login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <?= formErrors('email') ?>
            <input type="text" id="email" name="email" class="form-control" autofocus value="<?= old('email') ?>" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <?= formErrors('password') ?>
            <input type="text" id="password" name="password" class="form-control" value="<?= old('password') ?>" />
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success" value="Se connecter" />
        </div>
    </form>
</div>