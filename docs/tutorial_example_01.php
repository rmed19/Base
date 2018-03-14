<?php

require_once __DIR__.'/../vendor/autoload.php';

use Ezc\Base\Base;

Base::addClassRepository( __DIR__.'/repos', __DIR__.'/repos/autoloads' );
Base::autoload('erMyClass2');
Base::autoload('erYourClass1');

$myVar1 = new erMyClass2();
$myVar1->toString();
$yourVar1 = new erYourClass1();
$yourVar1->toString();
?>
