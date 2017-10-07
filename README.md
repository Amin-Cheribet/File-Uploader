# File-Uploader

Simple Easy To use PHP File Uploader
## install Via composer :
```composer require mohamed-amine/file-uploader```
## How To Use :
### Html :
```html

Single File Upload

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" /><br>
    <input type="submit" value="Upload File"/>
</form>

Multi File Upload

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfiles[]"/><br>
    <input type="file" name="myfiles[]"/><br>
    <input type="file" name="myfiles[]"/><br>
    <input type="submit" value="Upload File"/>
</form>
```

### PHP :

```php
<?php
    // Basic Use :
  require 'autoload.php';
    // For composer users :
  require 'vendor/autoload.php';

  // single File upload

  $file = new upload\File('myfile');
  $data = $file->Upload('/MyDirectory');

  // cheking if any problem occured during uploading
  if (!empty($file->Errors)) {
    //$file->Errors is an array that contain errors occured
  }

  /*
  $data is an array wich contains uploaded file informations
  $data['name'] -> uploaded file name
  $data['dir'] -> uploaded file location (directory) on server
  */

  // Multi File upload

  $file = new upload\MultiFile('myfiles');
  $data = $file->Upload('/MyDirectory');

  if (in_array(false, $data)) { // if there is some error
    $Errors = $files->getErrors();
    var_dump($Errors);
  } else {              // if every thing went right
    /*
    $data[0]['name'] -> first uploaded file name
    $data[0]['dir'] -> first uploaded file directory in server

    $data[1]['name'] -> second uploaded file name
    $data[1]['dir'] -> second uploaded file directory in server
    */
  }

  // optional (before excuting $file->upload() both multi or single file upload)

        // compress images (images only)
  $quality = 75;
  $file->compress($quality);

        // validation  max Size, Allowed Extensions and if user selected a file
  $file->Size(9999999)->Extension('jpg,png,jpeg')->Exist();

        // Get Name of single / multi files
  $file->getName(); // for single file return string
  $file->getNames(); // for multi files return array

        // Get Extension of single / multi files
  $file->getExtension(); // for single file return string
  $file->getExtensions(); // for multi files return array

        // Set Name for single / Multi files
  $file->setName('myname'); // for single file
  $file->setNames(['first', 'second', third]); // for multi files


  // options available only for single file upload
        // New Extension
  $file->setExtension('pdf');




```

## contribution
  any contribution will be welcomed
