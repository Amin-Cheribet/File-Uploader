<?php
require 'autoload.php';

if (isset($_POST['submit'])) {
  $file = new upload\File('myfile');
  $file->setName("MyNewFileName");
  $file->size(1000000)->Extension('jpg,png,jpeg')->Exist();
  $file->Upload($_SERVER["DOCUMENT_ROOT"]) or var_dump($file->errors);
}

 ?>
<form action="#" method="post" enctype="multipart/form-data">
  <input type="file" name="myfile"><br>

  <input type="submit" name="submit" value="submit">
</form>
