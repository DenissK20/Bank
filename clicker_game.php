<?php

require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Welcome to our clicker game, where you can earn easy money!');
$app->initLayout('Centered');

if(!isset($_SESSION['flag'])){
  $_SESSION['timer'] = time();
}

if($_SESSION['flag2']){
  $button1 = $app->add(['Button','Click!', 'massive green']);

  $button1->on('click', function($action){
    $now = time();
    $_SESSION['t'] = $now - $_SESSION['timer'];
    $_SESSION['ch'] = $_SESSION['ch']+1;
    return $action->text($_SESSION['ch']);
  });
} else {
  $form = $app->layout->add('Form');
  $form->addField('bank_number');

  $form->onSubmit(function($form) use($db) {
    $bank1= new Bank_account($db);
    $bank1->tryLoadby('account_number',$form->model['bank_number']);

    if($_SESSION['client_id']==$bank1['client_id']) {
      $_SESSION['flag2']=true;
      return new \atk4\ui\jsExpression('document.location = "clicker_game.php"');

    } else {
      return $form->error('bank_number', 'Wrong account number! ');
    }
  });

}




/*
if ((@$_SESSION['t']>10) && ($_SESSION['ch']>=50)) {
  $bank1= new Bank_account($db);
  $bank1->loadby('account_number',$form->model['bank_number']);
  $bank1['money']= $bank1['money']+10;
  $bank1->save();

  return new \atk4\ui\jsExpression('document.location="main.php"');
} else {
  unset($_SESSION['t']);
  unset($_SESSION['timer']);
  unset($_SESSION['flag']);
  return new \atk4\ui\jsExpression('document.location="clicker_game.php"');
}*/

/*$button2 = $app->add(['Button', 'disabled'=>true]);

$button2->on('click', function($action){
  $_SESSION['flag'] = true;
  return $action->text($_SESSION['t']);
}); */



$button3 = $app->add(['Button', 'Back on main']);
$button3->link('main.php');
