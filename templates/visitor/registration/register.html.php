<?php $layout = extends_of("layout/base_visitor.html.php") ?>

<?php $title = "Inscription"; ?>

<h1 class="text-center my-3 display-5">Inscription</h1>

<div class="container my-5">
    <form action="/register" method="POST">
        <div class="mb-3">
            <label for="firstName">Prénom</label>
            <?= formErrors('firstName') ?>
            <input type="text" class="form-control" id="firstName" name="firstName" autofocus value="<?= old('firstName') ?>" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="lastName">Nom</label>
            <?= formErrors('lastName') ?>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $_SESSION['old']['lastName'] ?? ''; unset($_SESSION['old']['lastName']); ?>" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <?= formErrors('email') ?>
            <input type="text" class="form-control" id="email" name="email" value="<?= $_SESSION['old']['email'] ?? ''; unset($_SESSION['old']['email']); ?>" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <?= formErrors('password') ?>
            <input type="text" class="form-control" id="password" name="password" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="confirmPassword">Confirmation du mot de passe</label>
            <?= formErrors('confirmPassword') ?>
            <input type="text" class="form-control" id="confirmPassword" name="confirmPassword" />
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success" value="S'inscrire" />
        </div>
    </form>
</div>