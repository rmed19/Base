<?php

namespace Ezc\Base\Exceptions;

/**
 * Exception is a container from which all other Exceptions in the
 * components library descent.
 *
 * @package Base
 * @version //autogen//
 */
abstract class Exception extends \Exception
{
    /**
     * Original message, before escaping
     */
    public $originalMessage;

    /**
     * Constructs a new Exception with $message
     *
     * @param string $message
     */
    public function __construct( $message )
    {
        $this->originalMessage = $message;

        if ( php_sapi_name() == 'cli' )
        {
            parent::__construct( $message );
        }
        else
        {
            parent::__construct( htmlspecialchars( $message ) );
        }
    }
}

