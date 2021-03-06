<?php

namespace Ezc\Base\Structs;

/**
 * Struct which defines the information collected by the file walker for locating files.
 *
 * @package Base
 * @version //autogentag//
 */
class FileFindContext extends Struct
{
    /**
     * The list of files
     *
     * @var array(string)
     */
    public $elements;

    /**
     * The number of files
     *
     * @var int
     */
    public $count;

    /**
     * The total file size of all files found
     *
     * @var int
     */
    public $size;

    /**
     * Constructs a new FileFindContext with initial values.
     *
     * @param array(string) $elements
     * @param int $count
     * @param int $size
     */
    public function __construct( $elements = array(), $count = 0, $size = 0 )
    {
        $this->elements = $elements;
        $this->count = $count;
        $this->size = $size;
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
     * @return FileFindContext
     */
    static public function __set_state( array $array )
    {
        return new FileFindContext( $array['elements'], $array['count'], $array['size'] );
    }
}

