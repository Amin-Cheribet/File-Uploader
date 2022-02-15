# File-Uploader

Simple Easy To use PHP File Uploader
## install Via composer :
```composer require mohamed-amine/file-uploader```
## How To Use :
#### Html :
##### Single file upload :
```html

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" /><br>
    <input type="submit" value="Upload File"/>
</form>

```
##### Multi files upload :
```html
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile[]" /><br>
    <input type="file" name="myfile[]" /><br>
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
$data = $file->save('myDirectory');

var_dump($data);

// this will output an array which contains uploaded files data
// [
//      'id' => 'sf23s6sdf23s',
//      'name' => 'myFileName',
//      'path' => 'document/images/photo.jpg'
// ]
// 
// Or in case of multi file upload
//
// [
//      [
//          'id' => 'er23sfd3p4uo ',
//          'name' => 'photo1',
//          'path' => 'document/images/photo1.jpg'
//      ],
//      [
//          'id' => 'sf23s6sdf23s',
//          'name' => 'photo2',d
//          'path' => 'document/images/photo2.jpg'
//      ]
// ]
//
```

 ### Validation:
 Available validation methods are: 
 - size(float $min, float $max) min & max are in MB
 - extension(array $allowed)
 - number(int $min, int $max = null)
```php
$file = Upload\Upload('myfile');

// validate
$file->validate()->extension(['jpg', 'gif'])->size(0.5, 10)->number(2);

// check for validation errors
if ($file->isValide()) {
    var_dump($file->getErrors();
}

// upload files
$file->save('myDirectory');
```

### Processing uploaded files:
Note: this function require php-gd to be installed on the server.
currently only images can be processed, available methods are:
- compress(int $quality)
    NOTE : compresssion level 0 to 100 lower is the most compressed and lowest quality
- resize(int $width, int $height)
- setName(array $names)

```php
$file->process()->compress(75)->resize(500, 800)->setName(['firstname', 'secondname']);

// or

$file->process()->compress(75);
$file->process()->resize(500, 800);
$file->process()->setName(['firstname', 'secondname']);

$file->save('myDirectory');
```
## contribution
  any contribution will be welcomed.
