<?php

namespace Ezc\Base\Exceptions;

/**
 * InitCallbackConfiguredException is thrown when you try to assign a
 * callback clasname to an identifier, while there is already a callback class
 * configured for this identifier.
 *
 * @package Base
 * @version //autogen//
 */
class InitCallbackConfiguredException extends Exception
{
    /**
     * Constructs a new InitCallbackConfiguredException.
     *
     * @param string $identifier
     * @param string $originalCallbackClassName
     */
    function __construct( $identifier, $originalCallbackClassName )
    {
        parent::__construct( "The '{$identifier}' is already configured with callback class '{$originalCallbackClassName}'." );
    }
}

