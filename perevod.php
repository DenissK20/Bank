<?php
require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Money transfer');
$app->initLayout('Centered');

$bank_account = new Bank_account($db);

  foreach ($bank_account as $testc) {
    $c[] = $testc['account_number'];
    if ($testc['client_id']==$_SESSION['client_id']) {
      $d[] = $testc['account_number'];
    }
  }

  $n = new \atk4\data\Model;
    $n->addField('sender', ['enum'=>$d]);
    $n->addField('receiver', ['enum'=>$c]);
    $n->addField('money');

$form = $app->layout->add('Form');
$form->setModel($n);
$form->onSubmit(function($form) use($db) {

  $bank1= new Bank_account($db);
  $bank2= new Bank_account($db);
  $bank1->addHook('afterLoad',function($bank1) use($form, $bank2) {
    if (($bank1['money'] < $form->model['money']) OR ($form->model['money'] <= 0)) {
      $bank1->unload();
      $_SESSION['check'] = false;
      throw new \atk4\data\ValidationException(['money'=>'Such transaction is unavailable!']);
    } else {
      $bank1['money']= $bank1['money']-$form->model['money'];
      $bank2['money']= $bank2['money']+$form->model['money'];
      $bank1->save();
      $bank2->save();
      $_SESSION['check'] = true;
    }
  });

$user = new Client($db);
$user->load($_SESSION['client_id']);

$bank2->loadBy('account_number',$form->model['receiver']);
$bank1->loadBy('account_number',$form->model['sender']);


  if ($bank1['client_id']==$_SESSION['client_id']) {
      if($_SESSION['check']){
        $tr = new \atk4\ui\jsExpression('document.location = "main.php"');
        return $tr;
      } else {
        return true;
      }
  } else {
    $user->unload();
    $er = (new \atk4\ui\jsNotify('That is not your account...'));
    $er->setColor('red');
    return $er;
  }

});

$app->add(["ui"=>"hidden divider"]);

$button2 = $app->add(['Button','Back','green']);
$button2->link('main.php');
