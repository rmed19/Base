<?php

namespace Ezc\Base\Exceptions;

/**
 * Exception that is thrown if an invalid class is passed as callback class for
 * delayed object configuration.
 *
 * @package Base
 * @version //autogen//
 */
class InitInvalidCallbackClassException extends Exception
{
    /**
     * Constructs a new InitInvalidCallbackClassException for the $callbackClass.
     *
     * @param string $callbackClass
     * @return void
     */
    function __construct( $callbackClass )
    {
        parent::__construct( "Class '{$callbackClass}' does not exist, or does not implement the 'ConfigurationInitializer' interface." );
    }
}

