<?php
require 'models.php';

if (empty($_SESSION['client_id'])) {
  header('location: index.php');
}

$user = new Client($db);
$user ->load($_SESSION['client_id']);

$app = new \atk4\ui\App('Добро пожаловать, '.$user['name']);
$app->initLayout('Centered');

$account = $user ->ref('Bank_account');
$grid = $app->add('Grid');
$grid->setModel($account,['account_number','money']);
$grid->addDecorator('account_number', new \atk4\ui\TableColumn\Link('notrand.php?clients_id={$id}'));

$button = $app->add(['Button', 'Add new account', 'green']);
$button->link('new_account.php');

$button = $app->add(['Button', 'Log out', 'blue']);
$button->link('log_out.php');
