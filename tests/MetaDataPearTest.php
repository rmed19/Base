<?php

use Ezc\Base\MetaData\MetaData;
use Ezc\Base\MetaData\PearReader;

/**
 * @package Base
 * @subpackage Tests
 */
class ezcBaseMetaDataPearTest extends ezcTestCase
{
    public function setUp()
    {
        $this->markTestSkipped('Only work when Zeta Components is installed as pear package.');
    }

    public static function testConstruct()
    {
        $r = new MetaData( 'pear' );
        self::assertInstanceOf( MetaData::class, $r );
        self::assertInstanceOf( PearReader::class, self::readAttribute( $r, 'reader' ) );
    }

    public static function testGetBundleVersion()
    {
        $r = new MetaData( 'pear' );
        $release = $r->getBundleVersion();
        self::assertInternalType( 'string', $release );
        self::assertRegexp( '@[0-9]{4}\.[0-9](\.[0-9])?@', $release );
    }

    public static function testIsComponentInstalled()
    {
        $r = new MetaData( 'pear' );
        self::assertTrue( $r->isComponentInstalled( 'Base' ) );
        self::assertFalse( $r->isComponentInstalled( 'DefinitelyNot' ) );
    }

    public static function testGetComponentVersion()
    {
        $r = new MetaData( 'pear' );
        $release = $r->getComponentVersion( 'Base' );
        self::assertInternalType( 'string', $release );
        self::assertRegexp( '@[0-9]\.[0-9](\.[0-9])?@', $release );
        self::assertFalse( $r->getComponentVersion( 'DefinitelyNot' ) );
    }

    public static function testGetComponentDependencies1()
    {
        $r = new MetaData( 'pear' );
        $deps = array_keys( $r->getComponentDependencies() );
        self::assertContains( 'Base', $deps );
        self::assertContains( 'Cache', $deps );
        self::assertContains( 'Webdav', $deps );
        self::assertNotContains( 'Random', $deps );
    }

    public static function testGetComponentDependencies2()
    {
        $r = new MetaData( 'pear' );
        self::assertSame( array(), $r->getComponentDependencies( 'Base' ) );
        self::assertSame( array( 'Base' ), array_keys( $r->getComponentDependencies( 'Template' ) ) );
    }

    public static function testGetComponentDependencies3()
    {
        $r = new MetaData( 'pear' );
        self::assertContains( 'Base', array_keys( $r->getComponentDependencies( 'TemplateTranslationTiein' ) ) );
        self::assertContains( 'Template', array_keys( $r->getComponentDependencies( 'TemplateTranslationTiein' ) ) );
        self::assertContains( 'Translation', array_keys( $r->getComponentDependencies( 'TemplateTranslationTiein' ) ) );
    }

    public static function suite()
    {
        return new PHPUnit_Framework_TestSuite( 'ezcBaseMetaDataPearTest' );
    }
}
?>
