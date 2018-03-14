<?php

namespace Ezc\Base\Exceptions;

/**
 * The FunctionalityNotSupportedException is thrown when a requested
 * PHP function was not found.
 *
 * @package Base
 * @version //autogen//
 */
class FunctionalityNotSupportedException extends Exception
{
    /**
     * Constructs a new FunctionalityNotSupportedException.
     *
     * @param string $message The message to throw
     * @param string $reason The reason for the exception
     */
    function __construct( $message, $reason )
    {
        parent::__construct( "{$message} is not supported. Reason: {$reason}." );
    }
}

