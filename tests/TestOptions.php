<?php

namespace Ezc\Base\Tests;

use Ezc\Base\Options\Options;
use Ezc\Base\Exceptions\PropertyNotFoundException;

class TestOptions extends Options
{
    protected $properties = array( "foo" => "bar", "baz" => "blah" );

    public function __set( $propertyName, $propertyValue )
    {
        if ( $this->__isset( $propertyName ) )
        {
            $this->properties[$propertyName] = $propertyValue;
        }
        else
        {
            throw new PropertyNotFoundException( $propertyName );
        }
    }
}
?>