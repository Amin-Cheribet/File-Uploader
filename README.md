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

  // optional (before excuting $file->Upload() both multi or single file upload)

        // validation  max Size, Allowed Extensions and if user selected a file
  $file->Size(9999999)->Extension('jpg,png,jpeg')->Exist();
  
  // options available only for single file upload
        // New Name 
  $file->setName('myfile');
        // Get Name
  $file->getName();
        // New Extension
  $file->setExtension('pdf');
        // Get Extension
  $file->getExtension();

        //compress images (only images)
  $quality = 75;
  $file->Compress($quality);


```

## contribution
  any contribution will be welcomed
