<?php

namespace Ezc\Base\Exceptions;

/**
 * MetaDataReaderException is thrown whenever a non existent property
 * is accessed in the Components library.
 *
 * @package Base
 * @version //autogen//
 */
class MetaDataReaderException extends Exception
{
    /**
     * Constructs a new MetaDataReaderException for the property
     * $name.
     *
     * @param string $installMethod
     */
    function __construct( $installMethod )
    {
        parent::__construct( "Unknown install method  '{$installMethod}'." );
    }
}