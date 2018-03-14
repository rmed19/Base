<?php

namespace Ezc\Base\Tests\Init;

/**
 * Test class for InitCallback.
 *
 * @package Base
 * @subpackage Tests
 */
class InitCallback implements \Ezc\Base\Interfaces\ConfigurationInitializer
{
    static public function configureObject( $objectToConfigure )
    {
        $objectToConfigure->configured = true;
    }
}
