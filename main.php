<?php
require 'models.php';

if (empty($_SESSION['client_id'])) {
  header('location: index.php');
}

$user = new Client($db);
$user ->load($_SESSION['client_id']);

$app = new \atk4\ui\App('Wellcome, '.$user['name']);
$app->initLayout('Centered');

$account = $user ->ref('Bank_account');
$grid = $app->add('Grid');
$grid->setModel($account,['account_number','money']);
$grid->addDecorator('account_number', new \atk4\ui\TableColumn\Link('notrand.php?clients_id={$id}'));

$button1 = $app->add(['Button', 'Add new account', 'green']);
$button1->link('new_account.php');

$button2 = $app->add(['Button', 'Log out', 'blue']);
$button2->link('log_out.php');

$button3 = $app->add(['Button', 'money transfer', 'yellow']);
$button3->link('perevod.php');
