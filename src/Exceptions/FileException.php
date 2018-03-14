<?php

namespace Ezc\Base\Exceptions;

/**
 * FileException is the exception from which all file related Exceptions
 * inherit.
 *
 * @package Base
 * @version //autogen//
 */
abstract class FileException extends Exception
{
    const READ    = 1;
    const WRITE   = 2;
    const EXECUTE = 4;
    const CHANGE  = 8;
    const REMOVE  = 16;
}

