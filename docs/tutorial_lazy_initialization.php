<?php

require_once __DIR__.'/../vendor/autoload.php';

use Ezc\Base\Init;
use Ezc\Base\Interfaces\ConfigurationInitializer;

// Create a custom class implementing the singleton pattern
class CustomSingleton
{
    protected static $instance;

    public static function getInstance()
    {
        if ( self::$instance === null )
        {
            self::$instance = new customSingleton();
            Init::fetchConfig( 'customKey', self::$instance );
        }

        return self::$instance;
    }
}

// Implement your configuration class
class CustomSingletonConfiguration implements ConfigurationInitializer
{
    public static function configureObject( $object )
    {
        echo "Configure customSingleton.\n";
        $object->value = 42;
    }
}

// Register for lazy initilization
Init::setCallback( 'customKey', 'CustomSingletonConfiguration' );

// Configure on first initilization
$object = CustomSingleton::getInstance();
var_dump( $object->value );

?>
