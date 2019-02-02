<?php
require 'models.php';

//echo $_SESSION['answer'];

$app = new \atk4\ui\App('Dinidele');
$app->initLayout('Centered');

$client= new Client($db);
  $form = $app->layout->add('Form');
$form->setModel(new Client($db),['login','password']);
$form->buttonSave->set('Sign in');
$form->onSubmit(function($form) use ($client) {
  $client->tryLoadBy('login',$form->model['login']);
  If ($client['password'] == $form->model['password']) {
    $_SESSION['client_id'] = $client->id;
    return new \atk4\ui\jsExpression('document.location="main.php"');
  } else {
    $person->unload();
    $er = (new \atk4\ui\jsNotify('No such user.'));
    $er->setColor('red');
    return $er;
  }
});




$button1 = $app->add(['Button', 'Registration', 'green']);
$button1->link('registration.php');

$button2 = $app->add(['Button', 'Admin', 'blue']);
$button2->link('check.php');

$label1 = $app->add(['Label', '22822822', 'small teal', 'icon'=>'phone']);
