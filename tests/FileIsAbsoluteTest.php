<?php

namespace Ezc\Base\Tests;

use Ezc\Base\Features;
use Ezc\Base\File;

/**
 * @package Base
 * @subpackage Tests
 */
class FileIsAbsoluteTest extends \ezcTestCase
{
    public static function testAbsoluteWindows1()
    {
        self::assertEquals( true, File::isAbsolutePath( 'c:\\winnt\\winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:\winnt\winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:\\winnt', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:\\winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:\winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:\\winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:\table.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:winnt', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c\\winnt.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '\\winnt.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '\winnt.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'winnt.sys', 'Windows' ) );

        self::assertEquals( false, File::isAbsolutePath( '\\server\share\foo.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\server\share\foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '\\tequila\share\foo.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\tequila\share\foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '\\tequila\thare\foo.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\tequila\thare\foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '\\server\\share\foo.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\server\\share\foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '\\tequila\\share\foo.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\tequila\\share\foo.sys', 'Windows' ) );

        self::assertEquals( false, File::isAbsolutePath( '\etc\init.d\apache', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '\\etc\\init.d\\apache', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc\init.d\apache', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc\\init.d\\apache', 'Windows' ) );
    }

    public static function testAbsoluteWindows2()
    {
        self::assertEquals( true, File::isAbsolutePath( 'c://winnt//winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:/winnt/winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c://winnt', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c://winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:/winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c://winnt.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:/table.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:winnt', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c//winnt.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '//winnt.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '/winnt.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'winnt.sys', 'Windows' ) );

        self::assertEquals( true, File::isAbsolutePath( '//server/share/foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '////server/share/foo.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila/share/foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '////tequila/share/foo.sys', 'Windows' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila/thare/foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '////tequila/thare/foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '//server//share/foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '////server//share/foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '//tequila//share/foo.sys', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '////tequila//share/foo.sys', 'Windows' ) );

        self::assertEquals( false, File::isAbsolutePath( '/etc/init.d/apache', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( '//etc//init.d//apache', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc/init.d/apache', 'Windows' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc//init.d//apache', 'Windows' ) );
    }

    public static function testAbsoluteWindows3()
    {
        if ( Features::os() !== 'Windows' )
        {
            self::markTestSkipped( 'Test is for Windows only' );
        }

        self::assertEquals( true, File::isAbsolutePath( 'c://winnt//winnt.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:/winnt/winnt.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c://winnt' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c://winnt.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:/winnt.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c://winnt.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( 'c:/table.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:winnt' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c//winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '//winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '/winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'winnt.sys' ) );

        self::assertEquals( true, File::isAbsolutePath( '//server/share/foo.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '////server/share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila/share/foo.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '////tequila/share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila/thare/foo.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '////tequila/thare/foo.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '//server//share/foo.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '////server//share/foo.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '//tequila//share/foo.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( '////tequila//share/foo.sys' ) );

        self::assertEquals( false, File::isAbsolutePath( '/etc/init.d/apache' ) );
        self::assertEquals( false, File::isAbsolutePath( '//etc//init.d//apache' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc/init.d/apache' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc//init.d//apache' ) );
    }

    public static function testAbsoluteLinux1()
    {
        self::assertEquals( false, File::isAbsolutePath( 'c:\\winnt\\winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:\winnt\winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:\\winnt', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:\\winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:\winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:\\winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:\table.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:winnt', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c\\winnt.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\winnt.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'winnt.sys', 'Linux' ) );

        self::assertEquals( true, File::isAbsolutePath( '\\server\share\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\server\share\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\tequila\share\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\tequila\share\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\tequila\thare\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\tequila\thare\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\server\\share\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\server\\share\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\tequila\\share\foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\\\tequila\\share\foo.sys', 'Linux' ) );

        self::assertEquals( true, File::isAbsolutePath( '\etc\init.d\apache', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '\\etc\\init.d\\apache', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc\init.d\apache', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc\\init.d\\apache', 'Linux' ) );
    }

    public static function testAbsoluteLinux2()
    {
        self::assertEquals( false, File::isAbsolutePath( 'c://winnt//winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:/winnt/winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c://winnt', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c://winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:/winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c://winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:/table.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:winnt', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c//winnt.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '//winnt.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '/winnt.sys', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'winnt.sys', 'Linux' ) );

        self::assertEquals( true, File::isAbsolutePath( '//server/share/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '////server/share/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila/share/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '////tequila/share/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila/thare/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '////tequila/thare/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '//server//share/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '////server//share/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila//share/foo.sys', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '////tequila//share/foo.sys', 'Linux' ) );

        self::assertEquals( true, File::isAbsolutePath( '/etc/init.d/apache', 'Linux' ) );
        self::assertEquals( true, File::isAbsolutePath( '//etc//init.d//apache', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc/init.d/apache', 'Linux' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc//init.d//apache', 'Linux' ) );
    }

    public static function testAbsoluteLinux3()
    {
        if ( Features::os() === 'Windows' )
        {
            self::markTestSkipped( 'Test is for unix-like systems only' );
        }

        self::assertEquals( false, File::isAbsolutePath( 'c://winnt//winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:/winnt/winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c://winnt' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c://winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:/winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c://winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:/table.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c:winnt' ) );
        self::assertEquals( false, File::isAbsolutePath( 'c//winnt.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '//winnt.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '/winnt.sys' ) );
        self::assertEquals( false, File::isAbsolutePath( 'winnt.sys' ) );

        self::assertEquals( true, File::isAbsolutePath( '//server/share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '////server/share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila/share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '////tequila/share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila/thare/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '////tequila/thare/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '//server//share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '////server//share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '//tequila//share/foo.sys' ) );
        self::assertEquals( true, File::isAbsolutePath( '////tequila//share/foo.sys' ) );

        self::assertEquals( true, File::isAbsolutePath( '/etc/init.d/apache' ) );
        self::assertEquals( true, File::isAbsolutePath( '//etc//init.d//apache' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc/init.d/apache' ) );
        self::assertEquals( false, File::isAbsolutePath( 'etc//init.d//apache' ) );
    }

    public static function testAbsoluteStreamWrapper()
    {
        self::assertEquals( true, File::isAbsolutePath( 'phar://test.phar/foo' ) );
        self::assertEquals( true, File::isAbsolutePath( 'http://example.com/file' ) );
    }
}
