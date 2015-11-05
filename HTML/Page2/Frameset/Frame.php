<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | HTML_Page2                                                           |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997 - 2004 The PHP Group                              |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author: Klaus Guenther <klaus@capitalfocus.org>                      |
// +----------------------------------------------------------------------+
//
// $Id$

/**
 * The PEAR::HTML_Page2 package provides a simple interface for generating an XHTML compliant page
 * 
 * @category HTML
 * @package  HTML_Page2
 * @version  @package_version@
 * @version  $Id$
 * @license  http://www.php.net/license/3_0.txt PHP License 3.0
 * @author   Adam Daniel <adaniel1@eesus.jnj.com>
 * @author   Klaus Guenther <klaus@capitalfocus.org>
 * @since    PHP 4.0.3pl1
 */

/**
 * Include HTML_Common class
 */
require_once 'HTML/Common.php';

class HTML_Page2_Frameset_Frame extends HTML_Common
{
    var $xhtml;

    /**
     * Constructor.
     *
     * Takes options array as a parameter.
     *
     * @param array $options Associative array of options.
     *
     * @return HTML_Page2_Frameset_Frame
     */
    public function __construct($options = [])
    {
        if (isset($options['name'])) {
            $this->setAttributes(['name' => $options['name']]);
        }
        if (isset($options['src'])) {
            $this->setSource($options['src']);
        }
        if (isset($options['target'])) {
            $this->setTarget($options['target']);
        }
    } // end func constructor

    /**
     * Set scrolling attribute
     *
     * @param string $string Defaults to empty string, to remove attribute.
     *
     * @return void
     */
    public function setScrolling($string = '')
    {
        if ($string !== '') {
            $this->updateAttributes(array('scrolling' => $string));
        } else {
            $this->removeAttribute('scrolling');
        }
    } // end func setScrolling

    /**
     * Set logdesc attribute
     *
     * @param string $location Location value
     *
     * @return void
     */
    public function setLongDescription($location = '')
    {
        if ($location !== '') {
            $this->updateAttributes(array('longdesc' => $location));
        } else {
            $this->removeAttribute('longdesc');
        }
    } // end func setSource

    /**
     * Set src attribute
     *
     * @param string $location Location value
     *
     * @return void
     */
    public function setSource($location)
    {
        $this->updateAttributes(array('src' => $location));
    } // end func setSource

    /**
     * Set target attribute.
     *
     * @param string $name Defaults to _self
     *
     * @return void
     */
    public function setTarget($name = '_self')
    {
        $this->updateAttributes(array('target' => $name));
    } // end func setTarget

    /**
     * Get HTML for frame tag.
     *
     * @return string
     */
    public function toHtml()
    {
        if ($this->xhtml === true) {
            $tagEnd = ' />';
        } else {
            $tagEnd = '>';
        }
        $strHtml = '<frame ' . $this->getAttributes(true) . $tagEnd;

        return $strHtml;
    } // end func toHtml
}
?>
