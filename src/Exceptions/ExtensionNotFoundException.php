<?php

namespace Ezc\Base\Exceptions;

/**
 * ExtensionNotFoundException is thrown when a requested PHP extension was not found.
 *
 * @package Base
 * @version //autogen//
 */
class ExtensionNotFoundException extends Exception
{
    /**
     * Constructs a new ExtensionNotFoundException.
     *
     * @param string $name The name of the extension
     * @param string $version The version of the extension
     * @param string $message Additional text
     */
    function __construct( $name, $version = null, $message = null )
    {
        if ( $version === null )
        {
            parent::__construct( "The extension '{$name}' could not be found. {$message}" );
        }
        else
        {
            parent::__construct( "The extension '{$name}' with version '{$version}' could not be found. {$message}" );
        }
    }
}

