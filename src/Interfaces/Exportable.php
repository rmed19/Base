<?php

namespace Ezc\Base\Interfaces;

/**
 * Interface for class of which instances can be exported using var_export().
 *
 * In some components, objects can be stored (e.g. to disc) using the var_export() 
 * function. To ensure that an object supports proper importing again, this 
 * interface should be implemented.
 *
 * @see var_export()
 */
interface Exportable
{
    /**
     * Returns an instance of the desired object, initialized from $state.
     *
     * This method must return a new instance of the class it is implemented 
     * in, which has its properties set from the given $state array.
     *
     * @param array $state 
     * @return object
     */
    public static function __set_state( array $state );
}


