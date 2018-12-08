<?php
require 'models.php';

$app = new \atk4\ui\App('Admin');
$app->initLayout('Centered');

$crud1 = $app->layout->add('CRUD');
$crud1->setModel(new Client($db));

$crud2 = $app->layout->add('CRUD');
$crud2->setModel(new Bank_account($db));


$button = $app->add(['Button','Log out','blue']);
$button->link('index.php');
