<?php
    ob_start();

    if(!empty($_SESSION['alert'])) :
?> 

<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
    <?= $_SESSION['alert']['msg'] ?>    
</div>

<?php 
    unset($_SESSION['alert']);
    endif;
?>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Title</th>
        <th>Nbr Pages</th>
        <th colspan="2">Actions</th>
    </tr>

    <?php 
        $books = $bookManager->getBooks();
        for($i=0; $i < count($books); $i++) : 
    ?>
    <tr>
        <td class="align-middle"><img src="/public/images/<?= $books[$i]->getImage(); ?>" width="60px;"></td>
        <td class="align-middle"><a href="<?= URL ?>books/b/<?= $books[$i]->getId(); ?>"><?= $books[$i]->getTitle(); ?></td>
        <td class="align-middle"><?= $books[$i]->getNbPages(); ?></td>
        <td class="align-middle"><a href="<?= URL ?>books/u/<?= $books[$i]->getId(); ?>" class="btn btn-warning">Update</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>books/d/<?= $books[$i]->getId(); ?>"onSubmit="return confirm('Do you really want to delete this book ?');">
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>    
</table>
<a href="<?= URL ?>books/a" class="btn btn-success d-block">Add</a>

<?php
    $content = ob_get_clean();
    $title = "BOOKS FROM OUR LIBRARY";
    require "template.php";
?>