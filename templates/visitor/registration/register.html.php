<?php $layout = extends_of("layout/base_visitor.html.php") ?>

<?php $title = "Inscription"; ?>

<h1 class="text-center my-3 display-5">Inscription</h1>

<div class="container my-5">
    <form action="/register" method="POST">
        <div class="mb-3">
            <label for="firstName">Prénom</label>
            <?php if(isset($_SESSION['formErrors']['firstName']) && !empty($_SESSION['formErrors']['firstName'])) : ?>
                <?php foreach($_SESSION['formErrors']['firstName'] as $error) : ?>
                    <div class="text-danger"><?= $error ?></div>
                    <?php break ?>
                <?php endforeach ?>
                <?php unset($_SESSION['formErrors']['firstName']); ?>
            <?php endif ?>
            <input type="text" class="form-control" id="firstName" name="firstName" autofocus value="<?= $_SESSION['old']['firstName'] ?? ''; unset($_SESSION['old']['firstName']); ?>" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="lastName">Nom</label>
            <?php if(isset($_SESSION['formErrors']['lastName']) && !empty($_SESSION['formErrors']['lastName'])) : ?>
                <?php foreach($_SESSION['formErrors']['lastName'] as $error) : ?>
                    <div class="text-danger"><?= $error ?></div>
                    <?php break ?>
                <?php endforeach ?>
                <?php unset($_SESSION['formErrors']['lastName']); ?>
            <?php endif ?>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $_SESSION['old']['lastName'] ?? ''; unset($_SESSION['old']['lastName']); ?>" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <?php if(isset($_SESSION['formErrors']['email']) && !empty($_SESSION['formErrors']['email'])) : ?>
                <?php foreach($_SESSION['formErrors']['email'] as $error) : ?>
                    <div class="text-danger"><?= $error ?></div>
                    <?php break ?>
                <?php endforeach ?>
                <?php unset($_SESSION['formErrors']['email']); ?>
            <?php endif ?>
            <input type="text" class="form-control" id="email" name="email" value="<?= $_SESSION['old']['email'] ?? ''; unset($_SESSION['old']['email']); ?>" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <?php if(isset($_SESSION['formErrors']['password']) && !empty($_SESSION['formErrors']['password'])) : ?>
                <?php foreach($_SESSION['formErrors']['password'] as $error) : ?>
                    <div class="text-danger"><?= $error ?></div>
                    <?php break ?>
                <?php endforeach ?>
                <?php unset($_SESSION['formErrors']['password']); ?>
            <?php endif ?>
            <input type="text" class="form-control" id="password" name="password" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="confirmPassword">Confirmation du mot de passe</label>
            <?php if(isset($_SESSION['formErrors']['confirmPassword']) && !empty($_SESSION['formErrors']['confirmPassword'])) : ?>
                <?php foreach($_SESSION['formErrors']['confirmPassword'] as $error) : ?>
                    <div class="text-danger"><?= $error ?></div>
                    <?php break ?>
                <?php endforeach ?>
                <?php unset($_SESSION['formErrors']['confirmPassword']); ?>
            <?php endif ?>
            <input type="text" class="form-control" id="confirmPassword" name="confirmPassword" />
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-success" value="S'inscrire" />
        </div>
    </form>
</div>