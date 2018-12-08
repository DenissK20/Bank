<?php

require 'models.php';

$client = new Client($db);
 $form = $app->layout->add('Form');
$form->setModel(new Client($db));
$form->buttonSave->set('check in');
