<?php
require_once('./controllers/view.php');
$view = new Animal($_SERVER['REQUEST_URI']);
$view->renderView(true);
