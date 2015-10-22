<?php
/**
 *
 * PHP Version 5
 *
 */

$version = '@package_version@';
if (strstr($version, 'package_version')) {
    set_include_path(dirname(dirname(__FILE__)) . ':' . get_include_path());
}
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'HTML_Page2_GetBodyContent_Test::main');
}

if (stream_resolve_include_path('PHPUnit/Framework/TestCase.php')) {
    include_once 'PHPUnit/Framework/TestCase.php';
}

require_once 'HTML/Page2.php';

/**
 * Unit test suite for the XML_RSS package
 *
 * This test suite does not provide tests that make sure that XML_RSS
 * parses XML files correctly. It only ensures that the "infrastructure"
 * works fine.
 *
 * @author  Martin Jansen <mj@php.net>
 * @extends PHPUnit_TestCase
 * @version $Id$
 */
class HTML_Page2_GetBodyContent_Test extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        if (stream_resolve_include_path('PHPUnit/TextUI/TestRunner.php')) {
            include_once 'PHPUnit/TextUI/TestRunner.php';
        }
        PHPUnit_TextUI_TestRunner::run(
            new PHPUnit_Framework_TestSuite('HTML_Page2_GetBodyContent_Test')
        );
    }

    function testIsXML_Parser() {
        $page = new HTML_Page2();
        $this->assertTrue(is_a($page, "HTML_Page2"));
        $html = "<h1>Headline</h1>";
        $page->addBodyContent($html);
        $content = $page->getBodyContent();
        $this->assertEquals((int) (bool) strpos($content, $html), 1);
    }

}

if (PHPUnit_MAIN_METHOD == 'HTML_Page2_GetBodyContent_Test::main') {
    HTML_Page2_GetBodyContent_Test::main();
}
?>
