<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


				<!--Name of partial-->
<? Template::partial('header', $header) ?>
<?= $yield ?>
<? Template::partial('footer', $footer) ?>

