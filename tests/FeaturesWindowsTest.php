<?php

namespace Ezc\Base\Tests;

use Ezc\Base\Features;
use Ezc\Base\Exceptions\ExtensionNotFoundException;

/**
 * @package Base
 * @subpackage Tests
 */
class FeaturesWindowsTest extends \ezcTestCase
{
    protected function setUp()
    {
        $uname = php_uname( 's' );
        if ( substr( $uname, 0, 7 ) != 'Windows' )
        {
            $this->markTestSkipped( 'Windows tests' );
        }
    }

    public function testSupportsLink()
    {
        $this->assertFalse( Features::supportsLink() );
    }

    public function testSupportsSymLink()
    {
        $this->assertFalse( Features::supportsSymLink() );
    }

    public function testSupportsUserId()
    {
        $this->assertFalse( Features::supportsUserId() );
    }

/*  // Need to find a way to make this test work, as setting global enviroment variables
    // is not working (putenv( "PATH=" ) doesn't unset $_ENV["PATH"])
    // One solution would be to use in the Features::getPath():
    // getenv( 'PATH' ) instead of $_ENV['PATH'] (but that won't work under IIS).
    public function testHasImageIdentifyNoPath()
    {
        $envPath = getenv( 'PATH' );
        putenv( "PATH=" );
        $this->assertEquals( false, Features::hasImageIdentify() );
        putenv( "PATH={$envPath}" );
    }
*/

    public function testHasImageConvert()
    {
        $this->assertTrue( Features::hasImageConvert() );
    }

    public function testGetImageConvertExecutable()
    {
        $this->assertNotNull( Features::getImageConvertExecutable() );
    }

    public function testGetImageIdentifyExecutable()
    {
        $this->assertNotNull( Features::getImageIdentifyExecutable() );
    }

    public function testHasImageIdentify()
    {
        $this->assertTrue( Features::hasImageIdentify() );
    }

    public function testHasExtensionSupport1()
    {
        $this->assertTrue( Features::hasExtensionSupport( 'standard' ) );
    }

    public function testHasExtensionSupportNotFound1()
    {
        $this->assertEquals( false, Features::hasExtensionSupport( 'non_existent_extension' ) );
        try
        {
            throw new ExtensionNotFoundException( 'non_existent_extension', null, 'This is just a test.' );
        }
        catch ( ExtensionNotFoundException $e )
        {
            $this->assertEquals( "The extension 'non_existent_extension' could not be found. This is just a test.",
                                 $e->getMessage() );
        }
    }

    public function testHasExtensionSupportNotFound2()
    {
        $this->assertEquals( false, Features::hasExtensionSupport( 'non_existent_extension' ) );
        try
        {
            throw new ExtensionNotFoundException( 'non_existent_extension', '1.2', 'This is just a test.' );
        }
        catch ( ExtensionNotFoundException $e )
        {
            $this->assertEquals( "The extension 'non_existent_extension' with version '1.2' could not be found. This is just a test.",
                                 $e->getMessage() );
        }
    }

    public function testHasFunction1()
    {
        $this->assertEquals( true, Features::hasFunction( 'function_exists' ) );
    }

    public function testHasFunction2()
    {
        $this->assertEquals( false, Features::hasFunction( 'non_existent_function_in_php' ) );
    }

    public function testHasExtensionSupport2()
    {
        $this->assertEquals( true, Features::hasExtensionSupport( 'date', '5.1.0' ) );
    }

    public function testClassExists()
    {
        $this->assertEquals( true, Features::classExists( 'Exception', false ) );
    }

    public function testClassExistsAutoload()
    {
        $this->assertEquals( true, Features::classExists( 'ezcBaseFeatures' ) );
    }

    public function testClassExistsNotFound()
    {
        $this->assertEquals( false, Features::classExists( 'ezcBaseNonExistingClass', false ) );
    }

    public function testClassExistsNotFoundAutoload()
    {
        $this->assertEquals( false, Features::classExists( 'ezcBaseNonExistingClass' ) );
    }
}
