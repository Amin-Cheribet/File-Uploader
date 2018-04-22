# File-Uploader

Simple Easy To use PHP File Uploader
## install Via composer :
```composer require mohamed-amine/file-uploader```
## How To Use :
#### Html :
```html
NOTE: you must always use '[]' after the name in html for both single and multi file uploads

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile[]" /><br>
    <input type="submit" value="Upload File"/>
</form>

```

### Simple File upload:

NOTE: every validation or other process should be done before uploading (calling save() method).

```php
<?php
// create uploader instance
$file = Upload\Upload('myfile');

// upload files to defined directory
$file->save('myDirectory');

$data = $file->getUploadedFilesData();
var_dump($data);

// this will output an array which contains uploaded files data
// [
//      'id' => 'sf23s6sdf23s',
//      'name' => 'myFileName',
//      'path' => 'document/images/photo.jpg'
// ]
```

 ### Validation:
 Available validation methods are: 
 - size(float $min, float $max) min & max are in MB
 - extension(array $allowed)
 - number(int $min, int $max = null)
```php
$file = Upload\Upload('myfile');

// validate
$file->extension(['jpg', 'gif'])->size(0.5, 10)->number(2);

// check for validation errors
if ($file->isValide()) {
    var_dump($file->getErrors();
}

// upload files
$file->save('myDirectory');
```

### Processing uploaded files:
currently only images can be processed, available methods are:
- compress(int $quality)
    NOTE : compresssion level 0 to 100 lower is the most compressed and lowest quality
- resize(int $width, int $height)
- setName(array $names)

```php
$file->compress(75)->resize(500, 800)->setName(['firstname', 'secondname']);

// or

$file->compress(75);
$file->resize(500, 800);
$file->setName(['firstname', 'secondname']);

$file->save('myDirectory');
```
## contribution
  any contribution will be welcomed.
