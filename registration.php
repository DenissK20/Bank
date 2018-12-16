<?php
require 'models.php';

$app = new \atk4\ui\App('Dinidele');
$app->initLayout('Centered');

$client = new Client($db);
 $form = $app->layout->add('Form');
$form->setModel(new Client($db));
$form->buttonSave->set('check in');

$button1 = $app->add(['Button', 'Back on main', 'blue']);
$button1->link('index.php');
