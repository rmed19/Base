<?php

namespace Ezc\Base\Tests\Init;

use Ezc\Base\Init;

/**
 * Test class for InitClass.
 *
 * @package Base
 * @subpackage Tests
 */
class InitClass
{
    public $configured = false;
    public static $instance;

    public static function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new InitClass();
            Init::fetchConfig( 'InitTest', self::$instance );
        }
        return self::$instance;
    }
}
