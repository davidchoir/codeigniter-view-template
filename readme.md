# Codeigniter View Template
A simple layout management, setup once then use it several times and can be done in one line on the controller.
## Requirement
Codeigniter 3.x.x
## Installation
Download, then copy and paste in the `application/library` directory.
## Configuration
Set `template` value inside autoload library `application/config/autoload.php`
```php
$autoload['libraries'] = array('template');
```
## How to use?
### Controller
You can render page by calling this method in your controller
```php
$this->template->view('your_view', $data);
```
### View
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title><?= $title . ' | ' . $subtitle ?></title>
    <?= $_css ?>
</head>
<body>
<div id="container">
    <?= $content ?>
    <?= $_script ?>
    <?= $_footer ?>
</div>
</body>
</html>
```
Your file name layout part must begin with an *underscore*, like `_css.php, _footer.php, _script.php` etc. your *variable* name is based on your file name without `.php` extension, example : `$_css, $_footer, $_script` etc.
### Title segment
Title segment is your website title, by default this library generate title based on segment 1 and subtitle based on segment 2.
`http://example.com/index.php/<title>/<subtitle>`
But you can custom title and subtitle based on other segment using code below:
```php
$this->template->title_segment(2, 3);
```
or you can custom generate title only based on segment 2
```php
$this->template->title_segment(2);
```
or you can custom generate subtitle only based on segment 3
```php
$this->template->title_segment(NULL, 3);
```
or you can overwrite title and subtitle page by using code below in your controller.
```php
$data['title']		= 'Welcome to Codeigniter View Template';
$data['subtitle']	= 'Example subtitle';

$this->template->view('your_view', $data);
```
### Layout
Layout is directory of all your part template, example: app, css, or script. By default the directory points to `application/views/layouts`. But you can custom your layout directory, if you want points to `application/views/your_layouts` you can use code below:
```php
$this->template->layout('your_layouts');
```
### Main layout
File name of main template by default is `app.php` inside directory `application/views/layouts`. But you can custom your main layout, if you want points to `application/views/layouts/your_app.php` you can use code below:
```php
$this->template->app('your_app');
```
### Stack
If you have a css or script for specific page, you can push part of layout by code below in your controller:
```php
$this->template->push('_your_css', 'css');
```
first parameter is your layout part directory, then second parameter is your stack name. You can call a function inside your main layout `application/views/layouts/app.php` like this:
```php
<?= $this->template->stack('css') ?>
```
Full code example on your main layout view:
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title><?= $title . ' | ' . $subtitle ?></title>
    <?= $_css ?>
    <?= $this->template->stack('css') ?>
</head>
<body>
<div id="container">
    <?= $content ?>
    <?= $_script ?>
    <?= $_footer ?>
    <?= $this->template->stack('script') ?>
</div>
</body>
</html>
```