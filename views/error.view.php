<?php ob_start(); ?>

<?= $msg; ?>

<?php
    $content = ob_get_clean();
    $title = "Error !!!";
    require "template.php";
?>