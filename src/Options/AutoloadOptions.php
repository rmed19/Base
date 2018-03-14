<?php

namespace Ezc\Base\Options;

use Ezc\Base\Exceptions\PropertyNotFoundException;
use Ezc\Base\Exceptions\ValueException;

/**
 * Class containing the basic Options for ezcBase' autoload.
 *
 * @property bool $preload
 *           If component preloading is enabled then as soon as one of the
 *           classes of a component is request, all other classes in the
 *           component are loaded as well (except for Exception classes).
 * @property bool $debug
 *           If debug is enabled then the autoload method will show Exceptions
 *           when a class can not be found. Because Exceptions are ignored by
 *           PHP in the autoload handler, you have to catch them in autoload()
 *           yourself and do something with the exception message.
 *
 * @package Base
 * @version //autogen//
 */
class AutoloadOptions extends Options
{
    /**
     * Constructs an object with the specified values.
     *
     * @throws PropertyNotFoundException
     *         if $Options contains a property not defined
     * @throws ValueException
     *         if $Options contains a property with a value not allowed
     * @param array(string=>mixed) $Options
     */
    public function __construct( array $options = array() )
    {
        $this->preload = false;
        $this->debug = false;

        parent::__construct( $options );
    }

    /**
     * Sets the option $name to $value.
     *
     * @throws PropertyNotFoundException
     *         if the property $name is not defined
     * @throws ValueException
     *         if $value is not correct for the property $name
     * @param string $name
     * @param mixed $value
     * @ignore
     */
    public function __set( $name, $value )
    {
        switch ( $name )
        {
            case 'debug':
            case 'preload':
                if ( !is_bool( $value ) )
                {
                    throw new ValueException( $name, $value, 'bool' );
                }
                $this->properties[$name] = $value;
                break;

            default:
                throw new PropertyNotFoundException( $name );
        }
    }
}

