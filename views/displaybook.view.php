<?php ob_start(); ?>

<div class="row">
    <div class="col-6">
        <img src="<?= URL ?>public/images/<?= $book->getImage() ?>">
    </div>
    <div class="col-6">
        <p>Title : <?= $book->getTitle() ?></p>
        <p>Nb pages : <?= $book->getNbPages() ?></p>
    </div>
</div>

<?php
    $content = ob_get_clean();
    $title = $book->getTitle();
    require "template.php";
?>