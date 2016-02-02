<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost', //provide your mysql host
    'database'  => 'live_comment', //provide your mysql database
    'username'  => 'root', //provide your mysql user
    'password'  => 'nothing', //provide your mysql password
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();