<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
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
    <?= $_footer ?>
    <?= $_script ?>
    <?= $this->template->stack('script') ?>
</div>

</body>
</html>