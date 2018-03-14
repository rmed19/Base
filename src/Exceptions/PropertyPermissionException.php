<?php

namespace Ezc\Base\Exceptions;

/**
 * PropertyPermissionException is thrown whenever a read-only property
 * is tried to be changed, or when a write-only property was accessed for reading.
 *
 * @package Base
 * @version //autogen//
 */
class PropertyPermissionException extends Exception
{
    /**
     * Used when the property is read-only.
     */
    const READ  = 1;

    /**
     * Used when the property is write-only.
     */
    const WRITE = 2;

    /**
     * Constructs a new ezcPropertyPermissionException for the property $name.
     *
     * @param string $name The name of the property.
     * @param int    $mode The mode of the property that is allowed (::READ or ::WRITE).
     */
    function __construct( $name, $mode )
    {
        parent::__construct( "The property '{$name}' is " .
            ( $mode == self::READ ? "read" : "write" ) .
            "-only." );
    }
}

