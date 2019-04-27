<?php
require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Fast credit!');
$app->initLayout('Centered');

$client = new Client($db);
$client->Load($_SESSION['client_id']);
$account = $client->ref('Bank_account');

foreach ($account as $testb) {
  $a[] = $testb['account_number'];
}


$m = new \atk4\data\Model;
  $m->addField('sum');
  $m->addField('days');
  $m->addField('account_number', ['enum'=>$a]);


$form = $app->layout->add('Form');
$form->setModel($m);
$form->onSubmit(function($form) use ($m,$db){
  $i=0.15;
  $bank1= new Bank_account($db);
  $bank1->tryLoadby('account_number',$form->model['account_number']);

  if($_SESSION['client_id']==$bank1['client_id']) {
    $c = $form->model['sum']*(1+$i*$form->model['days']);
    $bank1['credit'] = $bank1['credit']+$c;
    $bank1['money'] = $bank1['money']+$form->model['sum'];

    $bank1->save();



    return new \atk4\ui\jsExpression('document.location = "main.php"');

  } else {

    return $form->error('bank_number', 'Wrong account number! ');

  }



});
