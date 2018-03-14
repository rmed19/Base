<?php

namespace Ezc\Base\Exceptions;

/**
 * FileIoException is thrown when a problem occurs while writing
 * and reading to/from an open file.
 *
 * @package Base
 * @version //autogen//
 */
class FileIoException extends FileException
{
    /**
     * Constructs a new FileIoException for the file $path.
     *
     * @param string $path The name of the file.
     * @param int    $mode The mode of the property that is allowed
     *               (FileException::READ, FileException::WRITE,
     *               FileException::EXECUTE or
     *               FileException::CHANGE).
     * @param string $message A string with extra information.
     */
    function __construct( $path, $mode, $message = null )
    {
        switch ( $mode )
        {
            case FileException::READ:
                $operation = "An error occurred while reading from '{$path}'";
                break;
            case FileException::WRITE:
                $operation = "An error occurred while writing to '{$path}'";
                break;
        }

        $messagePart = '';
        if ( $message )
        {
            $messagePart = " ($message)";
        }

        parent::__construct( "$operation.$messagePart" );
    }
}

