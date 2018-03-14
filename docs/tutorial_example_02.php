<?php

require_once '../vendor/autoload.php';

$data = \Ezc\Base\File::findRecursive(
	"/dat/dev/ezcomponents",
	array( '@src/.*_autoload.php$@' ),
	array( '@/autoload/@' )
);
var_dump( $data );

?>
