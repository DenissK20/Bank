<?php
require 'models.php';

if (isset($_SESSION['client_id'])) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Admin');
$app->initLayout('Centered');

$crud1 = $app->layout->add('CRUD');
$crud1->setModel(new Client($db));

$crud2 = $app->layout->add('CRUD');
$crud2->setModel(new Bank_account($db));

$crud3 = $app->layout->add('CRUD');
$crud3->setModel(new Currency($db));


$button = $app->add(['Button','Log out','blue']);
$button->link('log_out.php');
