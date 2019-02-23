<?php

require 'vendor/autoload.php';

$app = new \atk4\ui\App ('You win and You earn 10€!');
$app->initLayout('Centered');

$button1 = $app->add(['Button', 'Try again?', 'green']);
$button1->link('izi_money.php');

$button1 = $app->add(['Button', 'Go back on main', 'orange']);
$button1->link('main.php');
