<?php

namespace Ezc\Base\Tests;

use Ezc\Base\Exceptions\PropertyNotFoundException;
use Ezc\Base\Structs\Struct;
use Ezc\Base\Structs\RepositoryDirectory;

/**
 * @package Base
 * @subpackage Tests
 */
class StructTest extends \ezcTestCase
{
    public function testBaseStructGetSet()
    {
        $struct = new Struct();

        try
        {
            $struct->no_such_property = 'value';
            $this->fail( 'Expected exception was not thrown.' );
        }
        catch ( PropertyNotFoundException $e )
        {
            $this->assertEquals( "No such property name 'no_such_property'.", $e->getMessage() );
        }

        try
        {
            $value = $struct->no_such_property;
            $this->fail( 'Expected exception was not thrown.' );
        }
        catch ( PropertyNotFoundException $e )
        {
            $this->assertEquals( "No such property name 'no_such_property'.", $e->getMessage() );
        }
    }

    public function testBaseRepositoryDirectorySetState()
    {
        $dir = RepositoryDirectory::__set_state( array( 'type' => RepositoryDirectory::TYPE_EXTERNAL, 'basePath' => '/tmp', 'autoloadPath' => '/tmp/autoload' ) );
        $this->assertEquals( RepositoryDirectory::TYPE_EXTERNAL, $dir->type );
        $this->assertEquals( '/tmp', $dir->basePath );
        $this->assertEquals( '/tmp/autoload', $dir->autoloadPath );
    }
}
