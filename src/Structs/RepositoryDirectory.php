<?php

namespace Ezc\Base\Structs;

/**
 * Struct which defines a repository directory.
 *
 * @package Base
 * @version //autogentag//
 */
class RepositoryDirectory extends Struct
{
    /**
     * Specifies that the entry is for the eZ Components repository.
     */
    const TYPE_INTERNAL = 0;

    /**
     * Specifies that the entry is for an external (user defined) repository.
     */
    const TYPE_EXTERNAL = 1;

    /**
     * The $type is one of the two TYPE_* constants defined in this class.
     *
     * @var string
     */
    public $type;

    /**
     * The path to the configured repository.
     *
     * @var string
     */
    public $basePath;

    /**
     * The path to the autoload files.
     *
     * @var string
     */
    public $autoloadPath;

    /**
     * Constructs a new RepositoryDirectory of type $type with base path
     * $basePath and autoload path $autoloadPath.
     *
     * @param string $type
     * @param string $basePath
     * @param string $autoloadPath
     */
    public function __construct( $type, $basePath, $autoloadPath )
    {
        $this->type = $type;
        $this->basePath = $basePath;
        $this->autoloadPath = $autoloadPath;
    }

    /**
     * Returns a new instance of this class with the data specified by $array.
     *
     * $array contains all the data members of this class in the form:
     * array('member_name'=>value).
     *
     * __set_state makes this class exportable with var_export.
     * var_export() generates code, that calls this method when it
     * is parsed with PHP.
     *
     * @param array(string=>mixed) $array
     * @return RepositoryDirectory
     */
    static public function __set_state( array $array )
    {
        return new RepositoryDirectory( $array['type'], $array['basePath'], $array['autoloadPath'] );
    }
}

