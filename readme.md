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
## Usage
You can render page by calling this method in your controller
```php
$this->template->view('your-directory-layouts', 'your-view', $data);
```
Your layout html file is in directory `your-directory-layouts/app.php`
**Note :** Your file name must be `app.php`
```html
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<title> { title } </title>
		
		{ _css }
		
</head>
<body>

<div id="container">

		{ content }
		{ _script }
		{ _footer }
		
</div>

</body>
</html>
```
Your file name layout part must begin with an *underscore*, like `_css.php, _footer.php, _script.php` etc. your *variable* name is based on your file name without `.php` extension.
Your current view *variable* name must be `{ content }` and title page must be `{ title }`. 
Page title will be generated automatically based on segment URI, but you can overwrite page title by using code below in your controller.
```php
$data['title'] = 'Welcome to Codeigniter View Template';
$this->template->view('your-directory-layouts', 'your-view', $data);
```