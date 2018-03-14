<?php

namespace Ezc\Base\Exceptions;

/**
 * PropertyNotFoundException is thrown whenever a non existent property
 * is accessed in the Components library.
 *
 * @package Base
 * @version //autogen//
 */
class PropertyNotFoundException extends Exception
{
    /**
     * Constructs a new PropertyNotFoundException for the property
     * $name.
     *
     * @param string $name The name of the property
     */
    function __construct( $name )
    {
        parent::__construct( "No such property name '{$name}'." );
    }
}

