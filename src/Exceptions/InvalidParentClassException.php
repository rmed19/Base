<?php

namespace Ezc\Base\Exceptions;

/**
 * Exception that is thrown if an invalid class is passed as custom class.
 *
 * @package Base
 * @version //autogen//
 */
class InvalidParentClassException extends Exception
{
    /**
     * Constructs an InvalidParentClassException for custom class $customClass
     *
     * @param string $expectedParentClass
     * @param string $customClass
     */
    function __construct( $expectedParentClass, $customClass )
    {
        parent::__construct( "Class '{$customClass}' does not exist, or does not inherit from the '{$expectedParentClass}' class." );
    }
}

