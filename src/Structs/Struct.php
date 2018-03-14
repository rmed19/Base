<?php

namespace Ezc\Base;

use Ezc\Base\Exceptions\PropertyNotFoundException;

/**
 * Base class for all Struct classes.
 *
 * @package Base
 * @version //autogentag//
 */
class Struct
{
    /**
     * Throws a BasePropertyNotFound exception.
     *
     * @param string $name
     * @param mixed $value
     * @ignore
     */
    final public function __set( $name, $value )
    {
        throw new PropertyNotFoundException( $name );
    }

    /**
     * Throws a BasePropertyNotFound exception.
     *
     * @param string $name
     * @ignore
     */
    final public function __get( $name )
    {
        throw new PropertyNotFoundException( $name );
    }
}
