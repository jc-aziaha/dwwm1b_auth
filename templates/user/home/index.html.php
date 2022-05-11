<?php $layout = extends_of("layout/base_user.html.php"); ?>

<?php $title = "Espace privé"; ?>

<h1 class="text-center my-3 display-5">Hello <?= $_SESSION['auth']->first_name  ?? '' ?></h1>