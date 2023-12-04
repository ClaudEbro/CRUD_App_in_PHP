<?php ob_start(); ?>

<form method="POST" action="<?= URL ?>books/vu" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title : </label>
    <input type="text" class="form-control" id="title" name="title" value="<?= $book->getTitle() ?>">
  </div>
  <div class="form-group">
    <label for="nbPages">Nbr Pages : </label>
    <input type="number" class="form-control" id="nbPages" name="nbPages" value="<?= $book->getNbPages() ?>">
  </div>
  <h3>Image : </h3>
  <img src="<?= URL ?>public/images/<?= $book->getImage() ?>">
  <div class="form-group">
    <label for="image">Change image : </label><br>
    <input type="file" class="form-control-file" id="image" name="image">
  </div>
  <br>
  <input type="hidden" name="ident" value="<?= $book->getId() ?>">
  <button type="submit" class="btn btn-primary">Validate</button>
</form>

<?php
    $content = ob_get_clean();
    $title = "UPDATING BOOK : ".$book->getId();
    require "template.php";
?>