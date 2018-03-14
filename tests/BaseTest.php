<?php

use Ezc\Base\Base;
use Ezc\Base\Exceptions\DoubleClassRepositoryPrefixException;
use Ezc\Base\Exceptions\FileException;
use Ezc\Base\Exceptions\FileIoException;
use Ezc\Base\Exceptions\FileNotFoundException;
use Ezc\Base\Exceptions\FilePermissionException;
use Ezc\Base\Exceptions\PropertyNotFoundException;
use Ezc\Base\Exceptions\PropertyPermissionException;
use Ezc\Base\Exceptions\SettingNotFoundException;
use Ezc\Base\Exceptions\SettingValueException;
use Ezc\Base\Exceptions\ValueException;
use Ezc\Base\Options\AutoloadOptions;

/**
 *
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 *
 * @package Base
 * @subpackage Tests
 * @version //autogentag//
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
/**
 * @package Base
 * @subpackage Tests
 */
class ezcBaseTest extends ezcTestCase
{
    /*
     * For use with the method testInvalidClass().
     */
    private $errorMessage = null;

    public function testConfigExceptionUnknownSetting()
    {
        try
        {
            throw new SettingNotFoundException( 'broken' );
        }
        catch ( SettingNotFoundException $e )
        {
            $this->assertEquals( "The setting 'broken' is not a valid configuration setting.", $e->getMessage() );
        }
    }

    public function testConfigExceptionOutOfRange1()
    {
        try
        {
            throw new SettingValueException( 'broken', 42 );
        }
        catch ( SettingValueException $e )
        {
            $this->assertEquals( "The value '42' that you were trying to assign to setting 'broken' is invalid.", $e->getMessage() );
        }
    }

    public function testConfigExceptionOutOfRange2()
    {
        try
        {
            throw new SettingValueException( 'broken', 42, "int, 40 - 48" );
        }
        catch ( SettingValueException $e )
        {
            $this->assertEquals( "The value '42' that you were trying to assign to setting 'broken' is invalid. Allowed values are: int, 40 - 48", $e->getMessage() );
        }
    }

    public function testConfigExceptionOutOfRange3()
    {
        try
        {
            throw new SettingValueException( 'broken', array(1, 1, 3, 4, 5), 'int' );
        }
        catch ( SettingValueException $e )
        {
            $this->assertEquals( "The value 'a:5:{i:0;i:1;i:1;i:1;i:2;i:3;i:3;i:4;i:4;i:5;}' that you were trying to assign to setting 'broken' is invalid. Allowed values are: int", $e->getMessage() );
        }
    }

    public function testFileIoException1()
    {
        try
        {
            throw new FileIoException( 'testfile.php', FileException::READ );
        }
        catch ( FileIoException $e )
        {
            $this->assertEquals( "An error occurred while reading from 'testfile.php'.", $e->getMessage() );
        }
    }

    public function testFileIoException2()
    {
        try
        {
            throw new FileIoException( 'testfile.php', FileException::WRITE );
        }
        catch ( FileIoException $e )
        {
            $this->assertEquals( "An error occurred while writing to 'testfile.php'.", $e->getMessage() );
        }
    }

    public function testFileIoException3()
    {
        try
        {
            throw new FileIoException( 'testfile.php', FileException::WRITE, "Extra extra" );
        }
        catch ( FileIoException $e )
        {
            $this->assertEquals( "An error occurred while writing to 'testfile.php'. (Extra extra)", $e->getMessage() );
        }
    }

    public function testFileNotFoundException1()
    {
        try
        {
            throw new FileNotFoundException( 'testfile.php' );
        }
        catch ( FileNotFoundException $e )
        {
            $this->assertEquals( "The file 'testfile.php' could not be found.", $e->getMessage() );
        }
    }

    public function testFileNotFoundException2()
    {
        try
        {
            throw new FileNotFoundException( 'testfile.php', 'INI' );
        }
        catch ( FileNotFoundException $e )
        {
            $this->assertEquals( "The INI file 'testfile.php' could not be found.", $e->getMessage() );
        }
    }

    public function testFileNotFoundException3()
    {
        try
        {
            throw new FileNotFoundException( 'testfile.php', 'INI', "Extra extra" );
        }
        catch ( FileNotFoundException $e )
        {
            $this->assertEquals( "The INI file 'testfile.php' could not be found. (Extra extra)", $e->getMessage() );
        }
    }

    public function testFilePermissionException1()
    {
        try
        {
            throw new FilePermissionException( 'testfile.php', FileException::READ );
        }
        catch ( FilePermissionException $e )
        {
            $this->assertEquals( "The file 'testfile.php' can not be opened for reading.", $e->getMessage() );
        }
    }

    public function testFilePermissionException2()
    {
        try
        {
            throw new FilePermissionException( 'testfile.php', FileException::WRITE );
        }
        catch ( FileException $e )
        {
            $this->assertEquals( "The file 'testfile.php' can not be opened for writing.", $e->getMessage() );
        }
    }

    public function testFilePermissionException3()
    {
        try
        {
            throw new FilePermissionException( 'testfile.php', FileException::EXECUTE );
        }
        catch ( \Ezc\Base\Exceptions\Exception $e )
        {
            $this->assertEquals( "The file 'testfile.php' can not be executed.", $e->getMessage() );
        }
    }

    public function testFilePermissionException4()
    {
        try
        {
            throw new FilePermissionException( 'testfile.php', FilePermissionException::CHANGE, "Extra extra" );
        }
        catch ( \Ezc\Base\Exceptions\Exception $e )
        {
            $this->assertEquals( "The permissions for 'testfile.php' can not be changed. (Extra extra)", $e->getMessage() );
        }
    }

    public function testFilePermissionException5()
    {
        try
        {
            throw new FilePermissionException( 'testfile.php', FilePermissionException::READ | FilePermissionException::WRITE, "Extra extra" );
        }
        catch ( \Ezc\Base\Exceptions\Exception $e )
        {
            $this->assertEquals( "The file 'testfile.php' can not be opened for reading and writing. (Extra extra)", $e->getMessage() );
        }
    }

    public function testFilePermissionException6()
    {
        try
        {
            throw new FilePermissionException( 'testfile.php', FilePermissionException::REMOVE, "Extra extra" );
        }
        catch ( \Ezc\Base\Exceptions\Exception $e )
        {
            $this->assertEquals( "The file 'testfile.php' can not be removed. (Extra extra)", $e->getMessage() );
        }
    }

    public function testPropertyNotFoundException()
    {
        try
        {
            throw new PropertyNotFoundException( 'broken' );
        }
        catch ( PropertyNotFoundException $e )
        {
            $this->assertEquals( "No such property name 'broken'.", $e->getMessage() );
        }
    }

    public function testPropertyPermissionException1()
    {
        try
        {
            throw new PropertyPermissionException( 'broken', PropertyPermissionException::READ );
        }
        catch ( \Ezc\Base\Exceptions\Exception $e )
        {
            $this->assertEquals( "The property 'broken' is read-only.", $e->getMessage() );
        }
    }

    public function testPropertyPermissionException2()
    {
        try
        {
            throw new PropertyPermissionException( 'broken', PropertyPermissionException::WRITE );
        }
        catch ( \Ezc\Base\Exceptions\Exception $e )
        {
            $this->assertEquals( "The property 'broken' is write-only.", $e->getMessage() );
        }
    }

    public function testBaseValue1()
    {
        try
        {
            throw new ValueException( 'broken', array( 42 ) );
        }
        catch ( ValueException $e )
        {
            $this->assertEquals( "The value 'a:1:{i:0;i:42;}' that you were trying to assign to setting 'broken' is invalid.", $e->getMessage() );
        }
    }

    public function testBaseValue2()
    {
        try
        {
            throw new ValueException( 'broken', "string", "strings" );
        }
        catch ( ValueException $e )
        {
            $this->assertEquals( "The value 'string' that you were trying to assign to setting 'broken' is invalid. Allowed values are: strings.", $e->getMessage() );
            $this->assertEquals( "The value 'string' that you were trying to assign to setting 'broken' is invalid. Allowed values are: strings.", $e->originalMessage );
        }
    }

    public function testExtraDirNotFoundException()
    {
        try
        {
            Base::addClassRepository( 'wrongDir' );
        }
        catch ( FileNotFoundException $e )
        {
            $this->assertEquals( "The base directory file 'wrongDir' could not be found.", $e->getMessage() );
        }
    }

    public function testExtraDirBaseNotFoundException()
    {
        try
        {
            Base::addClassRepository( '.', './wrongAutoloadDir' );
        }
        catch ( FileNotFoundException $e )
        {
            $this->assertEquals( "The autoload directory file './wrongAutoloadDir' could not be found.", $e->getMessage() );
        }
    }
    
    public function testBaseAddAndGetAutoloadDirs1()
    {
        Base::addClassRepository( __DIR__ );
        $resultArray = Base::getRepositoryDirectories();

        if ( count( $resultArray ) != 2 ) 
        {
            $this->fail( "Duplicating or missing extra autoload dirs while adding." );
        }

        if ( !isset( $resultArray['ezc'] ) ) 
        {
           $this->fail( "No packageDir found in result of getRepositoryDirectories()" );
        }

        if ( !isset( $resultArray[0] ) || $resultArray[0]->basePath != __DIR__ )
        {
            $this->fail( "Extra base dir '{$resultArray[0]->basePath}' is added incorrectly" );
        }

        if ( !isset( $resultArray[0] ) || $resultArray[0]->autoloadPath != __DIR__ . '/autoload' )
        {
            $this->fail( "Extra autoload dir '{$resultArray[0]->autoloadPath}' is added incorrectly" );
        }
    }

    // this test is sorta obsolete, but we keep it around for good measure
    public function testBaseAddAndGetAutoloadDirs2()
    {
        Base::addClassRepository( __DIR__, __DIR__ . '/autoload' );
        Base::addClassRepository( __DIR__ . '/test_repository', __DIR__ . '/test_repository/autoload_files' );
        Base::addClassRepository( __DIR__ . '/test_repository', __DIR__ . '/test_repository/autoload_files' );
        $resultArray = Base::getRepositoryDirectories();

        if ( count( $resultArray ) != 5 )
        {
            $this->fail( "Duplicating or missing extra autoload dirs while adding." );
        }

        if ( !isset( $resultArray['ezc'] ) )
        {
           $this->fail( "No packageDir found in result of getRepositoryDirectories()" );
        }

        if ( !isset( $resultArray[2] ) || $resultArray[2]->autoloadPath != __DIR__ . '/test_repository/autoload_files' )
        {
            $this->fail( "Extra autoload dir '{$resultArray[2]->autoloadPath}' is added incorrectly" );
        }

        self::assertEquals( true, class_exists( 'trBasetestClass', true ) );
        self::assertEquals( true, class_exists( 'trBasetestClass2', true ) );

        try
        {
            self::assertEquals( false, class_exists( 'trBasetestClass3', true ) );
            self::fail( 'The expected exception was not thrown.' );
        }
        catch ( AutoloadException $e )
        {
            self::assertStringStartsWith( "Could not find a class to file mapping for 'trBasetestClass3'. Searched for basetest_class3_autoload.php, basetest_autoload.php, autoload.php in:", $e->getMessage());
        }

        self::assertEquals( true, class_exists( 'trBasetestLongClass', true ) );

        try
        {
            class_exists( 'trBasetestClass4', true );
            self::fail( 'The expected exception was not thrown.' );
        }
        catch ( FileNotFoundException $e )
        {
            self::assertEquals( "The file '" . __DIR__ . "/test_repository/TestClasses/base_test_class_number_four.php' could not be found.", $e->getMessage() );
        }
    }

    public function testBaseAddAndGetAutoloadDirs3()
    {
        Base::addClassRepository( __DIR__ . '/extra_repository', null, 'ext' );

        $resultArray = Base::getRepositoryDirectories();
        self::assertEquals( true, array_key_exists( 'ezc', $resultArray ) );
        self::assertEquals( true, array_key_exists( 'ext', $resultArray ) );

        //self::assertEquals( true, class_exists( 'extTranslationTest', true ) );
        //self::assertEquals( true, class_exists( 'ezcTranslationTsBackend', true ) );
    }

    public function testBaseAddAndGetAutoloadDirs4()
    {
        Base::addClassRepository( __DIR__ . '/test_repository', __DIR__ . '/test_repository/autoload_files', 'tr' );

        try
        {
            Base::addClassRepository( __DIR__ . '/test_repository', __DIR__ . '/test_repository/autoload_files', 'tr' );
        }
        catch ( DoubleClassRepositoryPrefixException $e )
        {
            self::assertEquals( "The class repository in '" . __DIR__ . "/test_repository' (with autoload dir '" . __DIR__ . "/test_repository/autoload_files') can not be added because another class repository already uses the prefix 'tr'.", $e->getMessage() );
        }

        $resultArray = Base::getRepositoryDirectories();
        self::assertEquals( 7, count( $resultArray ) );

        self::assertEquals( true, array_key_exists( 'ezc', $resultArray ) );
        self::assertEquals( true, array_key_exists( 'tr', $resultArray ) );

        self::assertEquals( __DIR__ . '/test_repository', $resultArray['tr']->basePath );
        self::assertEquals( __DIR__ . '/test_repository/autoload_files', $resultArray['tr']->autoloadPath );
    }

    public function testNoPrefixAutoload()
    {
        Base::addClassRepository( __DIR__ . '/test_repository', __DIR__ . '/test_repository/autoload_files' );
        ezc_autoload( 'Objet' );
        if ( !class_exists( 'Objet' ) )
        {
            $this->fail( "Autoload does not handle classes with no prefix" );
        }
    }

    public function testNoPrefixAutoload2()
    {
        Base::addClassRepository( __DIR__ . '/issue15896' );
        ezc_autoload( 'ab' );
    }

    public function testCheckDependencyExtension()
    {
        Base::checkDependency( 'Tester', Base::DEP_PHP_EXTENSION, 'standard' );
    }

    public function testCheckDependencyVersion()
    {
        Base::checkDependency( 'Tester', Base::DEP_PHP_VERSION, '5.1.1' );
    }

    public function testInvalidClass()
    {
        $this->setExpectedException( 'AutoloadException', "Could not find a class to file mapping for 'ezcNoSuchClass'. Searched for no_such_autoload.php, no_autoload.php, autoload.php in:" );
        self::assertEquals( false, class_exists( 'ezcNoSuchClass', true ) );
    }

    public function testDebug()
    {
        try
        {
            class_exists( 'ezcTestingOne' );
            self::fail( "There should have been an exception" );
        }
        catch ( AutoloadException $e )
        {
        }
    }

    public function testNoDebug()
    {
        try
        {
            $options = new AutoloadOptions;
            $options->debug = false;
            Base::setOptions( $options );

            class_exists( 'ezcTestingOne' );
        }
        catch ( Exception $e )
        {
            self::fail( "There should not have been an exception. Found one: " . $e->getMessage() );
        }
    }

    public function testGetInstallationPath()
    {
        $this->markTestSkipped( 'What should behavior be in a composer installed environment?' );

        $path = Base::getInstallationPath();
        $pathParts = explode( DIRECTORY_SEPARATOR, $path );
        self::assertEquals( array( 'trunk', '' ), array_splice( $pathParts, -2 ) );
        self::assertEquals( DIRECTORY_SEPARATOR, substr( $path, -1 ) );
    }

    public function testSetInvalidRunMode()
    {
        try
        {
            Base::setRunMode( -3 );
            self::fail( "Expected exception not thrown." );
        }
        catch ( ValueException $e )
        {
            self::assertEquals( "The value '-3' that you were trying to assign to setting 'runMode' is invalid. Allowed values are: Base::MODE_PRODUCTION or Base::MODE_DEVELOPMENT.", $e->getMessage() );
        }
    }

    public function testSetGetRunMode()
    {
        self::assertEquals( Base::MODE_DEVELOPMENT, Base::getRunMode() );
        self::assertEquals( true, Base::inDevMode() );

        Base::setRunMode( Base::MODE_PRODUCTION );
        self::assertEquals( Base::MODE_PRODUCTION, Base::getRunMode() );
        self::assertEquals( false, Base::inDevMode() );

        Base::setRunMode( Base::MODE_DEVELOPMENT );
        self::assertEquals( Base::MODE_DEVELOPMENT, Base::getRunMode() );
        self::assertEquals( true, Base::inDevMode() );
    }

    public function testGetInstallMethod()
    {
        self::assertEquals( 'custom', Base::getInstallMethod() );
    }

    public function setup()
    {
        $options = new AutoloadOptions;
        $options->debug = true;
        Base::setOptions( $options );
    }

    public function teardown()
    {
        $options = new AutoloadOptions;
        $options->debug = true;
        Base::setOptions( $options );
    }

    public static function suite()
    {
        return new PHPUnit_Framework_TestSuite("ezcBaseTest");
    }
}
?>
