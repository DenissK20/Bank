<?php
require 'vendor/autoload.php';

session_start();

$db = \atk4\data\Persistence::connect('mysql:host=127.0.0.1;dbname=bank;charset=utf8', 'root', '');

class Client extends \atk4\data\Model {
  public $table = 'client';
function init() {
  parent::init();
  $this->addField('name');
  $this->addField('surname');
  $this->addField('phone_number');
  $this->addField('email');
  $this->addField('login');
  $this->addField('password',['type'=>'password']);
  $this->addField('personal_code');
  $this->hasMany('Bank_account', new Bank_account);
}
}

class Bank_account extends \atk4\data\Model {
  public $table = 'bank_account';
function init() {
  parent::init();
  $this->addField('account_number');
  $this->addField('money',['type'=>'money']);
  $this->addField('credit',['type'=>'money']);
  $this->hasOne('client_id', new Client)->addTitle();
}
}

class Currency extends \atk4\data\Model {
  public $table = 'currency';
function init() {
  parent:: init();
  $this->addField('name');
  $this->addField('coef');
}
}
