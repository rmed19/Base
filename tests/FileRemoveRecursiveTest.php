<?php

namespace Ezc\Base\Tests;

use Ezc\Base\File;
use Ezc\Base\Exceptions\FilePermissionException;

/**
 * @package Base
 * @subpackage Tests
 */
class FileRemoveRecursiveTest extends \ezcTestCase
{
    private $tempDir;

    protected function setUp()
    {
        $this->tempDir = $this->createTempDir( 'ezcBaseFileRemoveFileRecursiveTest' );
        mkdir( $this->tempDir . '/dir1' );
        mkdir( $this->tempDir . '/dir2' );
        mkdir( $this->tempDir . '/dir2/dir1' );
        mkdir( $this->tempDir . '/dir2/dir1/dir1' );
        mkdir( $this->tempDir . '/dir2/dir2' );
        mkdir( $this->tempDir . '/dir4' );
        mkdir( $this->tempDir . '/dir5' );
        mkdir( $this->tempDir . '/dir6' );
        mkdir( $this->tempDir . '/dir7' );
        mkdir( $this->tempDir . '/dir7/dir1' );
        mkdir( $this->tempDir . '/dir8' );
        mkdir( $this->tempDir . '/dir8/dir1' );
        mkdir( $this->tempDir . '/dir8/dir1/dir1' );
        file_put_contents( $this->tempDir . '/dir1/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir1/file2.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir1/.file3.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir2/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir2/dir1/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir2/dir1/dir1/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir2/dir1/dir1/file2.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir2/dir2/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir4/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir4/file2.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir5/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir5/file2.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir6/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir6/file2.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir7/dir1/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir8/dir1/file1.txt', 'test' );
        file_put_contents( $this->tempDir . '/dir8/dir1/dir1/file1.txt', 'test' );
        chmod( $this->tempDir . '/dir4/file1.txt', 0 );
        chmod( $this->tempDir . '/dir5', 0 );
        chmod( $this->tempDir . '/dir6', 0400 );
        chmod( $this->tempDir . '/dir7', 0500 );
        chmod( $this->tempDir . '/dir8/dir1', 0500 );
    }

    protected function tearDown()
    {
        chmod( $this->tempDir . '/dir5', 0700 );
        chmod( $this->tempDir . '/dir6', 0700 );
        chmod( $this->tempDir . '/dir7', 0700 );
        chmod( $this->tempDir . '/dir8/dir1', 0700 );
        $this->removeTempDir();
    }

    public function testRecursive1()
    {
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
        File::removeRecursive( $this->tempDir . '/dir1' );
        self::assertEquals( 12, count( File::findRecursive( $this->tempDir ) ) );
        File::removeRecursive( $this->tempDir . '/dir2' );
        self::assertEquals( 7, count( File::findRecursive( $this->tempDir ) ) );
    }

    public function testRecursive2()
    {
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
        try
        {
            File::removeRecursive( $this->tempDir . '/dir3' );
        }
        catch ( \Ezc\Base\Exceptions\FileNotFoundException $e )
        {
            self::assertEquals( "The directory file '{$this->tempDir}/dir3' could not be found.", $e->getMessage() );
        }
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
    }

    public function testRecursive3()
    {
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
        try
        {
            File::removeRecursive( $this->tempDir . '/dir4' );
        }
        catch ( FilePermissionException $e )
        {
            self::assertEquals( "The file '{$this->tempDir}/dir5' can not be opened for reading.", $e->getMessage() );
        }
        self::assertEquals( 13, count( File::findRecursive( $this->tempDir ) ) );
    }

    public function testRecursive4()
    {
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
        try
        {
            File::removeRecursive( $this->tempDir . '/dir5' );
        }
        catch ( FilePermissionException $e )
        {
            self::assertEquals( "The file '{$this->tempDir}/dir5' can not be opened for reading.", $e->getMessage() );
        }
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
    }

    public function testRecursive5()
    {
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
        try
        {
            File::removeRecursive( $this->tempDir . '/dir6' );
        }
        catch ( FilePermissionException $e )
        {
            // Make no asumption on which file is tried to be removed first
            self::assertEquals(
                1,
                preg_match(
                    "(The file '{$this->tempDir}/dir6/file[12].txt' can not be removed.)",
                    $e->getMessage()
                )
            );
        }
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
    }

    public function testRecursiveNotWritableParent()
    {
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
        try
        {
            File::removeRecursive( $this->tempDir . '/dir7/dir1' );
        }
        catch ( FilePermissionException $e )
        {
            self::assertEquals( "The file '{$this->tempDir}/dir7' can not be opened for writing.", $e->getMessage() );
        }
        self::assertEquals( 15, count( File::findRecursive( $this->tempDir ) ) );
    }
}
?>
