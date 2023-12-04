<?php ob_start(); ?>

HERE IS HOME PAGE

<?php
    $title = "ACE BOOKSTORE";
    $content = ob_get_clean() ;
    require "template.php";
?>