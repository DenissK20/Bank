<?php
require 'models.php';

$user = new Client($db);
$user ->load($_SESSION['client_id']);
$app = new \atk4\ui\App('Добро пожаловать, '.$user['name']);
$app->initLayout('Centered');
