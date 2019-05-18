<?php

require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Loan repayment');
$app->initLayout('Centered');

$bank_account = new Bank_account($db);

foreach ($bank_account as $testc) {
  if ($testc['client_id']==$_SESSION['client_id']) {
    $b[] = $testc['account_number'];
  }
}

$n = new \atk4\data\Model;
  $n->addField('account_number', ['enum'=>$b]);
  $n->addField('sum_to_return');


$form = $app->layout->add('Form');
$form->setModel($n);
$form->onSubmit(function($form) use ($bank_account,$n,$db) {

  $user = new Client($db);
  $user->load($_SESSION['client_id']);

  $bank1= new Bank_account($db);
  $bank1->tryLoadby('account_number',$form->model['account_number']);

  if($_SESSION['client_id']==$bank1['client_id']) {
    if ($form->model['sum_to_return'] <= $bank1['credit']){

      $bank1['money'] = $bank1['money']-$bank1['credit'];
      $bank1['credit'] = $bank1['credit']-$form->model['sum_to_return'];
      $bank1->save();

      return new \atk4\ui\jsExpression('document.location = "main.php"');
    } else {
      $bank1->unload();
      throw new \atk4\data\ValidationException(['sum_to_return'=>'Such transaction is unavailable!']);
    }
  } else {
      $user->unload();
      $er = (new \atk4\ui\jsNotify('That is not your account...'));
      $er->setColor('red');
      return $er;
  }
});

$button = $app->add(['Button','Back', 'green']);
$button->link('main.php');
