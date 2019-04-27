<?php
require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$user = new Client($db);
$user ->load($_SESSION['client_id']);

$app = new \atk4\ui\App('Wellcome, '.$user['name']);
$app->initLayout('Centered');

$account = $user ->ref('Bank_account');
$grid = $app->add('Grid');
$grid->setModel($account,['account_number','money','credit']);
$grid->addDecorator('account_number', new \atk4\ui\TableColumn\Link('notrand.php?clients_id={$id}'));

$button1 = $app->add(['Button', 'Add new account', 'green']);
$button1->link('new_account.php');

$button2 = $app->add(['Button', 'Log out', 'blue']);
$button2->link('log_out.php');

$button3 = $app->add(['Button', 'Money transfer', 'yellow']);
$button3->link('perevod.php');

$button4 = $app->add(['Button', 'Bank account replenishment', 'grey']);
$button4->link('izi_money.php');

$button5 = $app->add(['Button', 'Money converter', 'teal']);
$button5->link('converter.php');

$button6 = $app->add(['Button', 'Fast credit!', 'purple']);
$button6->link('credit.php');

$button7 = $app->add(['Button', 'Loan repayment', 'teal']);
$button7->link('repayment.php');
