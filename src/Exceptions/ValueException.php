<?php

namespace Ezc\Base\Exceptions;

/**
 * ValueException is thrown whenever the type or value of the given
 * variable is not as expected.
 *
 * @package Base
 * @version //autogen//
 */
class ValueException extends Exception
{
    /**
     * Constructs a new ValueException on the $name variable.
     *
     * @param string  $settingName The name of the setting where something was
     *                wrong with.
     * @param mixed   $value The value that the option was tried to be set too.
     * @param string  $expectedValue A string explaining the allowed type and value range.
     * @param string  $variableType  What type of variable was tried to be set (setting, argument).
     */
    function __construct( $settingName, $value, $expectedValue = null, $variableType = 'setting' )
    {
        $type = gettype( $value );
        if ( in_array( $type, array( 'array', 'object', 'resource' ) ) )
        {
            $value = serialize( $value );
        }
        $msg = "The value '{$value}' that you were trying to assign to $variableType '{$settingName}' is invalid.";
        if ( $expectedValue )
        {
            $msg .= " Allowed values are: " . $expectedValue . '.';
        }
        parent::__construct( $msg );
    }
}
