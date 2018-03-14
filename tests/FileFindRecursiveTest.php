<?php

namespace Ezc\Base\Tests;

use Ezc\Base\Exceptions\FileNotFoundException;
use Ezc\Base\File;

/**
 * @package Base
 * @subpackage Tests
 */
class FileFindRecursiveTest extends \ezcTestCase
{
    public function testRecursive1()
    {
        $expected = array(
            0 => 'src/Base.php',
            1 => 'src/Exceptions/AutoloadException.php',
            2 => 'src/Exceptions/DoubleClassRepositoryPrefixException.php',
            3 => 'src/Exceptions/Exception.php',
            4 => 'src/Exceptions/ExtensionNotFoundException.php',
            5 => 'src/Exceptions/FileException.php',
            6 => 'src/Exceptions/FileIoException.php',
            7 => 'src/Exceptions/FileNotFoundException.php',
            8 => 'src/Exceptions/FilePermissionException.php',
            9 => 'src/Exceptions/FunctionalityNotSupportedException.php',
            10 => 'src/Exceptions/InitCallbackConfiguredException.php',
            11 => 'src/Exceptions/InitInvalidCallbackClassException.php',
            12 => 'src/Exceptions/InvalidParentClassException.php',
            13 => 'src/Exceptions/MetaDataReaderException.php',
            14 => 'src/Exceptions/PropertyNotFoundException.php',
            15 => 'src/Exceptions/PropertyPermissionException.php',
            16 => 'src/Exceptions/SettingNotFoundException.php',
            17 => 'src/Exceptions/SettingValueException.php',
            18 => 'src/Exceptions/ValueException.php',
            19 => 'src/Exceptions/WhateverException.php',
            20 => 'src/Features.php',
            21 => 'src/File.php',
            22 => 'src/Init.php',
            23 => 'src/Interfaces/ConfigurationInitializer.php',
            24 => 'src/Interfaces/Exportable.php',
            25 => 'src/Interfaces/Persistable.php',
            26 => 'src/Metadata/MetaData.php',
            27 => 'src/Metadata/PearReader.php',
            28 => 'src/Metadata/TarballReader.php',
            29 => 'src/Options/AutoloadOptions.php',
            30 => 'src/Options/Options.php',
            31 => 'src/Structs/FileFindContext.php',
            32 => 'src/Structs/RepositoryDirectory.php',
            33 => 'src/Structs/Struct.php',
        );

        $files = File::findRecursive( "src", array(), array( '@/docs/@', '@svn@', '@\.swp$@', '@git@' ), $stats );
        self::assertEquals( $expected, $files );
        self::assertEquals( array( 'size' => 97042, 'count' => 34 ), $stats );
    }

    public function testRecursive2()
    {
        $expected = array(
            0 => 'vendor/zetacomponents/unit-test/CREDITS',
            1 => 'vendor/zetacomponents/unit-test/ChangeLog',
            2 => 'vendor/zetacomponents/unit-test/NOTICE',
            3 => 'vendor/zetacomponents/unit-test/composer.json',
            4 => 'vendor/zetacomponents/unit-test/design/class_diagram.png',
            5 => 'vendor/zetacomponents/unit-test/src/constraint/image.php',
            6 => 'vendor/zetacomponents/unit-test/src/regression_suite.php',
            7 => 'vendor/zetacomponents/unit-test/src/regression_test.php',
            8 => 'vendor/zetacomponents/unit-test/src/test/case.php',
            9 => 'vendor/zetacomponents/unit-test/src/test/image_case.php',
            10 => 'vendor/zetacomponents/unit-test/src/test_autoload.php',
        );

        self::assertEquals( $expected, File::findRecursive( "vendor/zetacomponents/unit-test", array( '@^vendor/zetacomponents/unit-test/@' ), array( '@/docs/@', '@\.git@', '@\.swp$@' ), $stats ) );
        self::assertEquals( array( 'size' => 191166, 'count' => 11 ), $stats );
    }

    public function testRecursive3()
    {
        $expected = array (
            0 => 'vendor/zetacomponents/unit-test/design/class_diagram.png',
        );
        self::assertEquals( $expected, File::findRecursive( "vendor/zetacomponents/unit-test", array( '@\.png$@' ), array( '@\.svn@' ), $stats ) );
        self::assertEquals( array( 'size' => 166066, 'count' => 1 ), $stats );
    }

    public function testRecursive4()
    {
        $expected = array (
            0 => 'vendor/zetacomponents/unit-test/design/class_diagram.png',
        );
        self::assertEquals( $expected, File::findRecursive( "vendor/zetacomponents/unit-test", array( '@/design/@' ), array( '@\.svn@' ), $stats ) );
        self::assertEquals( array( 'size' => 166066, 'count' => 1 ), $stats );
    }

    public function testRecursive5()
    {
        $expected = array (
            0 => 'vendor/zetacomponents/unit-test/design/class_diagram.png',
            1 => 'vendor/zetacomponents/unit-test/src/constraint/image.php',
            2 => 'vendor/zetacomponents/unit-test/src/regression_suite.php',
            3 => 'vendor/zetacomponents/unit-test/src/regression_test.php',
            4 => 'vendor/zetacomponents/unit-test/src/test/case.php',
            5 => 'vendor/zetacomponents/unit-test/src/test/image_case.php',
            6 => 'vendor/zetacomponents/unit-test/src/test_autoload.php',
        );
        self::assertEquals( $expected, File::findRecursive( "vendor/zetacomponents/unit-test", array( '@\.(php|png)$@' ), array( '@/docs/@', '@\.svn@' ) ) );
    }

    public function testRecursive6()
    {
        $expected = array();
        self::assertEquals( $expected, File::findRecursive( "vendor/zetacomponents/unit-test", array( '@xxx@' ) ) );
    }

    public function testNonExistingDirectory()
    {
        $expected = array();
        try
        {
            File::findRecursive( "NotHere", array( '@xxx@' ) );
        }
        catch ( FileNotFoundException $e )
        {
            self::assertEquals( "The directory file 'NotHere' could not be found.", $e->getMessage() );
        }
    }

    public function testStatsEmptyArray()
    {
        $expected = array (
            0 => 'vendor/zetacomponents/unit-test/design/class_diagram.png',
        );

        $stats = array();
        self::assertEquals( $expected, File::findRecursive( "vendor/zetacomponents/unit-test", array( '@/design/@' ), array( '@\.svn@' ), $stats ) );
        self::assertEquals( array( 'size' => 166066, 'count' => 1 ), $stats );
    }
}
