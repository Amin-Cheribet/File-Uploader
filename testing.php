<?php
require 'autoload.php';
error_reporting(-1);
// Single file upload test

if (isset($_POST['submit'])) {
    $file = new upload\File('myfile');

    $file->setName('MyNewFileName');
    $file->size(1000000)->Extension('jpg,png,jpeg')->Exist();
    $file->Compress(75);

    $data = $file->Upload($_SERVER['DOCUMENT_ROOT']);

    if (empty($file->Errors)) {
        var_dump($data);
        /*
        $data['name'] -> uploaded file name
        $data['dir'] -> uploaded file directory in server
        */
    } else {
        var_dump($file->Errors);
    }
}

    ?>
<form action="#" method="post" enctype="multipart/form-data">
  <input type="file" name="myfile"><br>

  <input type="submit" name="submit" value="submit">
</form>
<?php
// Multi file upload test

if (isset($_POST['submit2'])) {
    $files = new upload\MultiFile('myfiles');

    $files->size(99900999)->extension('png,jpg')->compress(70)->min(3)->max(3);
    $files->setNames(['amine', 'test', 'mohamed']);

    $data = $files->Upload($_SERVER['DOCUMENT_ROOT']);
    if (!$data) { // if there is some error
        $Errors = $files->getErrors();
        var_dump($Errors);
    } else {              // if every thing went right
        var_dump($data);
        /*
        $data[0]['name'] -> first uploaded file name
        $data[1]['name'] -> second uploaded file name
        $data[0]['dir'] -> first uploaded file directory in server
        $data[1]['dir'] -> second uploaded file directory in server
        */
    }
}
    ?>

 <form method="POST" enctype="multipart/form-data">
     <input type="file" name="myfiles[]"/><br>
     <input type="file" name="myfiles[]"/><br>
     <input type="file" name="myfiles[]"/><br>
     <input type="submit" name="submit2" value="Upload File"/>
 </form>
