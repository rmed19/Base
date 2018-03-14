<?php

namespace Ezc\Base\Exceptions;

/**
 * FilePermissionException is thrown whenever a permission problem with
 * a file, directory or stream occurred.
 *
 * @package Base
 * @version //autogen//
 */
class FilePermissionException extends FileException
{
    /**
     * Constructs a new ezcPropertyPermissionException for the property $name.
     *
     * @param string $path The name of the file.
     * @param int    $mode The mode of the property that is allowed
     *               (FileException::READ, FileException::WRITE,
     *               FileException::EXECUTE,
     *               FileException::CHANGE or
     *               FileException::REMOVE).
     * @param string $message A string with extra information.
     */
    function __construct( $path, $mode, $message = null )
    {
        switch ( $mode )
        {
            case FileException::READ:
                $operation = "The file '{$path}' can not be opened for reading";
                break;
            case FileException::WRITE:
                $operation = "The file '{$path}' can not be opened for writing";
                break;
            case FileException::EXECUTE:
                $operation = "The file '{$path}' can not be executed";
                break;
            case FileException::CHANGE:
                $operation = "The permissions for '{$path}' can not be changed";
                break;
            case FileException::REMOVE:
                $operation = "The file '{$path}' can not be removed";
                break;
            case ( FileException::READ || FileException::WRITE ):
                $operation = "The file '{$path}' can not be opened for reading and writing";
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

