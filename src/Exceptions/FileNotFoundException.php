<?php

namespace Ezc\Base\Exceptions;

/**
 * FileNotFoundException is thrown when a file or directory was tried to
 * be opened, but did not exist.
 *
 * @package Base
 * @version //autogen//
 */
class FileNotFoundException extends FileException
{
    /**
     * Constructs a new FileNotFoundException.
     *
     * @param string $path The name of the file.
     * @param string $type The type of the file.
     * @param string $message A string with extra information.
     */
    function __construct( $path, $type = null, $message = null )
    {
        $typePart = '';
        if ( $type )
        {
            $typePart = "$type ";
        }

        $messagePart = '';
        if ( $message )
        {
            $messagePart = " ($message)";
        }

        parent::__construct( "The {$typePart}file '{$path}' could not be found.$messagePart" );
    }
}

