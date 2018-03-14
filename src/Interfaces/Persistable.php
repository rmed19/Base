<?php

namespace Ezc\Base\Interfaces;

/**
 * This class provides the interface that classes need to implement to be able
 * to be used by the PersistentObject and Search components.
 *
 * @package Base
 * @version //autogen//
 */
interface Persistable
{
    /**
     * The constructor for the object needs to be able to accept no arguments.
     *
     * The data is later set through the setState() method.
     */
    public function __construct();

    /**
     * Returns all the object's properties so that they can be stored or indexed.
     *
     * @return array(string=>mixed)
     */
    public function getState();

    /**
     * Accepts an array containing data for one or more of the class' properties.
     *
     * @param array $properties
     */
    public function setState( array $properties );
}
