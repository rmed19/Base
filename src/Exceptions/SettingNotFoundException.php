<?php

namespace Ezc\Base\Exceptions;

/**
 * SettingNotFoundException is thrown whenever there is a name passed as
 * part as the Options array to setOptions() for an option that doesn't exist.
 *
 * @package Base
 * @version //autogen//
 */
class SettingNotFoundException extends Exception
{
    /**
     * Constructs a new SettingNotFoundException for $settingName.
     *
     * @param string $settingName The name of the setting that does not exist.
     */
    function __construct( $settingName )
    {
        parent::__construct( "The setting '{$settingName}' is not a valid configuration setting." );
    }
}

