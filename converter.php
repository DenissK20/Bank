<?php
require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Money converter');
$app->initLayout('Centered');



$currency = new Currency($db);
  foreach ($currency as $testa) {
    $a[] = $testa['name'];
  }

$m = new \atk4\data\Model;
  $m->addField('sum');
  $m->addField('from', ['enum'=>$a]);
  $m->addField('to', ['enum'=>$a]);



  $form = $app->layout->add('Form');
  $form->setModel($m);
  $form->onSubmit(function($form) use ($currency,$m) {
    $currency->tryLoadBy('name',$form->model['from']);
    $from=$currency['coef'];
    $currency->tryLoadBy('name',$form->model['to']);
    $to=$currency['coef'];
    if ($m['sum']>0) {

      $res=($form->model['sum']*$from)/$to;

      $currency->unload();
      $er = (new \atk4\ui\jsNotify('Your result '.$res));
      $er->setColor('green');
      return $er;
    } else {
      $currency->unload();
      $er = (new \atk4\ui\jsNotify('Money should be positive!'));
      $er->setColor('red');
      return $er;
    }
  });
