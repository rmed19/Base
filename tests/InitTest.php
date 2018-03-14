<?php

namespace Ezc\Base\Tests;

use Ezc\Base\Init;
use Ezc\Base\Tests\Init\InitCallback;
use Ezc\Base\Tests\Init\InitClass;

/**
 * @package Base
 * @subpackage Tests
 */
class InitTest extends \ezcTestCase
{
    public function setUp()
    {
        InitClass::$instance = null;
    }

    public function testCallbackWithClassThatDoesNotExists()
    {
        try
        {
            Init::setCallback( 'InitTest', 'classDoesNotExist' );
            $this->fail( "Expected exception not thrown." );
        }
        catch ( \Ezc\Base\Exceptions\InitInvalidCallbackClassException $e )
        {
            $this->assertEquals( "Class 'classDoesNotExist' does not exist, or does not implement the 'ConfigurationInitializer' interface.", $e->getMessage() );
        }
    }

    public function testCallbackWithClassThatDoesNotImplementTheInterface()
    {
        try
        {
            Init::setCallback( 'InitTest', \Ezc\Base\Features::class );
            $this->fail( "Expected exception not thrown." );
        }
        catch ( \Ezc\Base\Exceptions\InitInvalidCallbackClassException $e )
        {
            $this->assertEquals( "Class 'Ezc\Base\Features' does not exist, or does not implement the 'ConfigurationInitializer' interface.", $e->getMessage() );
        }
    }

    public function testCallback1()
    {
        $obj = InitClass::getInstance();
        $this->assertEquals( false, $obj->configured );
    }

    public function testCallback2()
    {
        Init::setCallback( 'InitTest', InitCallback::class);
        $obj = InitClass::getInstance();
        $this->assertEquals( true, $obj->configured );
    }
    
    public function testCallback3()
    {
        try
        {
            Init::setCallback( 'InitTest', InitCallback::class );
            $this->fail( "Expected exception not thrown." );
        }
        catch ( \Ezc\Base\Exceptions\InitCallbackConfiguredException $e )
        {
            $this->assertEquals( "The 'InitTest' is already configured with callback class 'Ezc\Base\Tests\Init\InitCallback'.", $e->getMessage() );
        }
    }
}
