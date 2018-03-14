<?php

require_once '../vendor/autoload.php';

\Ezc\Base\Base::addClassRepository( './repos', './repos/autoloads' );
$myVar1 = new erMyClass2();
$myVar1->toString();
$yourVar1 = new erYourClass1();
$yourVar1->toString();
?>
