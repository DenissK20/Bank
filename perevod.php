<?php
require 'models.php';

if (empty($_SESSION['client_id'])) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Money transfer');
$app->initLayout('Centered');

$form = $app->layout->add('Form');
$form->addField('sender');
$form->addField('receiver');
$form->addField('money');

$form->onSubmit(function($form) use($db) {

  $bank1= new Bank_account($db);
  $bank2= new Bank_account($db);

  $bank1->loadBy('account_number',$form->model['sender']);
  $bank2->loadBy('account_number',$form->model['receiver']);
  $bank1['money']= $bank1['money']-$form->model['money'];
  $bank2['money']= $bank2['money']+$form->model['money'];

  $bank1->save();
  $bank2->save();

  return new \atk4\ui\jsExpression('document.location = "main.php"');

});
