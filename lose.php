<?php

require 'vendor/autoload.php';

$app = new \atk4\ui\App ('Oupss, You did not managed on time!');
$app->initLayout('Centered');

$button1 = $app->add(['Button', 'Try again?', 'green']);
$button1->link('izi_money.php');

$button1 = $app->add(['Button', 'Go back on main', 'orange']);
$button1->link('main.php');
