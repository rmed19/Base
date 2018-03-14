<?php

/**
 * ezcBaseDoubleClassRepositoryPrefixException is thrown whenever you try to
 * register a class repository with a prefix that has already been added
 * before.
 *
 * @package Base
 * @version //autogen//
 */
class ezcBaseDoubleClassRepositoryPrefixException extends ezcBaseException
{
    /**
     * Constructs a new ezcBaseDoubleClassRepositoryPrefixException for the
     * $prefix that points to $basePath with autoload directory
     * $autoloadDirPath.
     *
     * @param string $prefix
     * @param string $basePath
     * @param string $autoloadDirPath
     */
    function __construct( $prefix, $basePath, $autoloadDirPath )
    {
        parent::__construct( "The class repository in '{$basePath}' (with autoload dir '{$autoloadDirPath}') can not be added because another class repository already uses the prefix '{$prefix}'." );
    }
}
?>
