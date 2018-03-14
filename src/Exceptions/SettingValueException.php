<?php

namespace Ezc\Base\Exceptions;

/**
 * SettingValueException is thrown whenever a value to a class'
 * configuration option is either of the wrong type, or has a wrong value.
 *
 * @package Base
 * @version //autogen//
 */
class SettingValueException extends Exception
{
    /**
     * Constructs a new SettingValueException
     *
     * @param string  $settingName The name of the setting where something was
     *                wrong with.
     * @param mixed   $value The value that the option was tried to be set too.
     * @param string  $expectedValue A string explaining the allowed type and value range.
     */
    function __construct( $settingName, $value, $expectedValue = null )
    {
        $type = gettype( $value );
        if ( in_array( $type, array( 'array', 'object', 'resource' ) ) )
        {
            $value = serialize( $value );
        }
        $msg = "The value '{$value}' that you were trying to assign to setting '{$settingName}' is invalid.";
        if ( $expectedValue )
        {
            $msg .= " Allowed values are: " . $expectedValue;
        }
        parent::__construct( $msg );
    }
}

