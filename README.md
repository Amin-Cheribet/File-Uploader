# File-Uploader
PHP File Uploader 
Simple Easy To use PHP File Uploader

## How To Use : 
### Html : 
```html
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" value=""/><br>
    <input type="submit" value="Upload File"/>
</form>
```

### PHP : 

```php
<?php
    // Basic Use :
  require 'autoload.php';
  
  $file = new upload\File('myfile');
  $file->Upload('MyDirectory');
  
  // optional 
  
        // validation  
  $file->size(9999999)->Extension('jpg,png,jpeg');
        // New Name
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
