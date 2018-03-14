<?php

namespace Ezc\Base\Exceptions;

use Ezc\Base\Structs\RepositoryDirectory;

/**
 * AutoloadException is thrown whenever a class can not be found with
 * the autoload mechanism.
 *
 * @package Base
 * @version //autogen//
 */
class AutoloadException extends Exception
{
    /**
     * Constructs a new AutoloadException for the $className that was
     * searched for in the autoload files $fileNames from the directories
     * specified in $dirs.
     *
     * @param string $className
     * @param array(string) $files
     * @param RepositoryDirectory[] $dirs
     */
    function __construct( $className, $files, $dirs )
    {
        $paths = array();
        foreach ( $dirs as $dir )
        {
            $paths[] = realpath( $dir->autoloadPath );
        }
        parent::__construct( "Could not find a class to file mapping for '{$className}'. Searched for ". implode( ', ', $files ) . " in: " . implode( ', ', $paths ) );
    }
}

