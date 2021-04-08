<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
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