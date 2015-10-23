# File-Uploader

Simple Easy To use PHP File Uploader

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
  
  // single File upload
  
  $file = new upload\File('myfile');
  $file->Upload('/MyDirectory');
  
  // Multi File upload
  
  $file = new upload\MultiFile('myfiles');
  $file = upload('/MyDirectory');
  // optional 
  
        // validation  max Size Allowed Extensions and if user selected a file
  $file->size(9999999)->Extension('jpg,png,jpeg'>Exist();
        // New Name (Only for signl File upload)
  $file->setName('myfile');
        // Get Name
  $file->getName();
        // New Extension
  $file->setExtension('pdf');
        // Get Extension
  $file->getExtension();
  
  
```

## contribution
  any contribution is welcome
