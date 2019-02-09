<?php

require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Welcome to our mini game, where you can earn easy money!');
$app->initLayout('Centered');

$_SESSION['result'] = $_SESSION['one'] * $_SESSION['two'];

$form = $app->layout->add('Form');
$form->addField('answer',['caption'=> $_SESSION['one'].'*'.$_SESSION['two'].'=?']);
$form->addField('bank_number');

$form->onSubmit(function($form) use($db) {
  if($_SESSION['result']==$form->model['answer']) {


    $bank1= new Bank_account($db);
    $bank1->loadby('account_number',$form->model['bank_number']);
    $bank1['money']= $bank1['money']+10;
    $bank1->save();

    return new \atk4\ui\jsExpression('document.location="main.php"');
  } else {
    return $form->error('answer', 'You need to go back to school!!! ', $_SESSION['result']);
  }
});

$button1 = $app->add(['Button', 'Back on main']);
$button1->link('main.php');
