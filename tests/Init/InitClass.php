<?php

use Ezc\Base\Init;

/**
 * Test class for ezcBaseInitTest.
 *
 * @package Base
 * @subpackage Tests
 */
class testBaseInitClass
{
    public $configured = false;
    public static $instance;

    public static function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new testBaseInitClass();
            Init::fetchConfig( 'testBaseInit', self::$instance );
        }
        return self::$instance;
    }
}
?>
