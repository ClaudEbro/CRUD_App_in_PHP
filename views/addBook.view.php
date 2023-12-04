<?php ob_start(); ?>

<form method="POST" action="<?= URL ?>books/va" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title : </label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="nbPages">Nbr Pages : </label>
    <input type="number" class="form-control" id="nbPages" name="nbPages">
  </div>
  <div class="form-group">
    <label for="image">Image : </label><br>
    <input type="file" class="form-control-file" id="image" name="image">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Validate</button>
</form>

<?php
    $title = "Add a Book";
    $content = ob_get_clean() ;
    require "template.php";
?>