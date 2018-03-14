<?php

namespace Ezc\Base\Tests;

use Ezc\Base\Exceptions\PropertyNotFoundException;
use Ezc\Base\Exceptions\ValueException;
use Ezc\Base\Options\AutoloadOptions;

/**
 * @package Base
 * @subpackage Tests
 */
class OptionsTest extends \ezcTestCase
{

    public function testGetAccessFailure()
    {
        $opt = new TestOptions();
        try
        {
            echo $opt->properties;
        }
        catch ( PropertyNotFoundException $e )
        {
            return;
        }
        $this->fail( "PropertyNotFoundException not thrown on access to forbidden property \$properties" );
    }

    public function testGetOffsetAccessFailure()
    {
        $opt = new TestOptions();
        try
        {
            echo $opt["properties"];
        }
        catch ( PropertyNotFoundException $e )
        {
            return;
        }
        $this->fail( "PropertyNotFoundException not thrown on access to forbidden property \$properties" );
    }

    public function testSetOffsetAccessFailure()
    {
        $opt = new TestOptions();
        try
        {
            $opt["properties"] = "foo";
        }
        catch ( PropertyNotFoundException $e )
        {
            return;
        }
        $this->fail( "PropertyNotFoundException not thrown on access to forbidden property \$properties" );
    }

    public function testConstructorWithParameters()
    {
        $options = new TestOptions( array( 'foo' => 'xxx' ) );
        $this->assertEquals( 'xxx', $options->foo );
    }

    public function testMerge()
    {
        $options = new TestOptions();
        $this->assertEquals( 'bar', $options->foo );
        $options->merge( array( 'foo' => 'xxx' ) );
        $this->assertEquals( 'xxx', $options->foo );
    }

    public function testOffsetExists()
    {
        $options = new TestOptions();
        $this->assertEquals( true, $options->offsetExists( 'foo' ) );
        $this->assertEquals( false, $options->offsetExists( 'bar' ) );
    }

    public function testOffsetSet()
    {
        $options = new TestOptions();
        $this->assertEquals( 'bar', $options->foo );
        $options->offsetSet( 'foo', 'xxx' );
        $this->assertEquals( 'xxx', $options->foo );
    }

    public function testOffsetUnset()
    {
        $options = new TestOptions();
        $this->assertEquals( 'bar', $options->foo );
        $options->offsetUnset( 'foo' );
        $this->assertEquals( null, $options->foo );
        $this->assertEquals( true, $options->offsetExists( 'foo' ) );
    }

    public function testAutoloadOptions()
    {
        $options = new AutoloadOptions();

        try
        {
            $options->no_such_property = 'value';
            $this->fail( 'Expected exception was not thrown.' );
        }
        catch ( PropertyNotFoundException $e )
        {
            $this->assertEquals( "No such property name 'no_such_property'.", $e->getMessage() );
        }

        try
        {
            $options->preload = 'wrong value';
            $this->fail( 'Expected exception was not thrown.' );
        }
        catch ( ValueException $e )
        {
            $this->assertEquals( "The value 'wrong value' that you were trying to assign to setting 'preload' is invalid. Allowed values are: bool.", $e->getMessage() );
        }
    }

    public function testIterator()
    {
        $options = new TestOptions();

        $expectedArray = array( "foo" => "bar", "baz" => "blah" );

        $resultArray = array();

        foreach( $options as $key => $option )
        {
            $resultArray[$key] = $option;
        }

        $this->assertEquals( $expectedArray, $resultArray );
    }
}

?>