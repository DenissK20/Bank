<?php

require 'vendor/autoload.php';
require 'models.php';

$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if ($_SESSION['flag2']){
  $form = $app->layout->add('Form');
  $form->addField('bank_number');

  $form->onSubmit(function($form) use($db) {
    $bank1= new Bank_account($db);
    $bank1->tryLoadby('account_number',$form->model['bank_number']);


  if($_SESSION['client_id']==$bank1['client_id']) {
    $_SESSION['flag2']=false;
    $_SESSION['bank_number']=$form->model['bank_number'];
    return new \atk4\ui\jsExpression('document.location = "clicker_game_v2.php"');

  } else {

    return $form->error('bank_number', 'Wrong account number! ');

  }
 });

} else {

  $now = time();

  if (!isset($_SESSION['flag'])){
    $_SESSION['timer'] = time();
  }

  $_SESSION['t'] = $now -$_SESSION['timer'];
   $button = $app ->add(['Button','Touch me','big red']);
   $button -> on('click', function($action)use($db){
     if (($_SESSION['t'] <= 10) and ($_SESSION['ch'] >= 50)) {

       $bank1= new Bank_account($db);
       $bank1->tryLoadby('account_number',$_SESSION['bank_number']);
       $bank1['money']= $bank1['money']+10;
       $bank1->save();

       return new \atk4\ui\jsExpression('document.location="prize.php"');

     }
     if ($_SESSION['t'] > 10) {

        return new \atk4\ui\jsExpression('document.location="lose.php"');

     }

     $_SESSION['ch']=$_SESSION['ch']+1;
     $_SESSION['flag'] = false;
     return $action->text($_SESSION['ch'].' '.'time left: '.(10-$_SESSION['t']));

   });
}
