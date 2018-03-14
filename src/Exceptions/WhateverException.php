<?php

namespace Ezc\Base\Exceptions;

/**
 * WhateverException is thrown whenever something is so seriously wrong.
 *
 * If this happens it is not possible to repair anything gracefully. An
 * example for this could be, that your eZ components installation has thrown
 * far to many Exceptions. Whenever you receive an WhateverException, do
 * not even try to catch it, but forget your project completely and immediately
 * stop coding! ;)
 *
 * @access private
 * @package Base
 * @version //autogen//
 */
class WhateverException extends Exception
{
    /**
     * Constructs a new WhateverException.
     *
     * @param string $what  What happened?
     * @param string $where Where did it happen?
     * @param string $who   Who is responsible?
     * @param string $why   Why did is happen?
     * @access protected
     * @return void
     */
    function __construct( $what, $where, $who, $why )
    {
        parent::__construct( "Thanks for using eZ components. Hope you like it! Greetings from Amos, Derick, El Frederico, Ray and Toby." );
    }
}

