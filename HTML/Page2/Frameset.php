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
 * @author   Klaus Guenther <klaus@capitalfocus.org>
 */


/**
 * Include HTML_Common class
 */
require_once 'HTML/Common.php';

/**
 * Include the class for individual frames
 */
require_once 'HTML/Page2/Frameset/Frame.php';

class HTML_Page2_Frameset extends HTML_Common
{
    protected $_master = false;
    protected $_rows = array();
    protected $_cols = array();
    protected $_type = '';
    protected $xhtml = false;
    
    public function HTML_Page2_Frameset($options = array())
    {
        if (isset($options['master'])) {
            $this->_master = $options['master'];
        }
        if (isset($options['xhtml'])) {
            $this->xhtml = $options['xhtml'];
        }
    } // end constructor
    
    public function addRows($rows = array())
    {
        
        if (isset($this->_cols)) {
            $this->_cols = array();
        }
        
        $this->_rows = $rows;
    } // end func addRows
    
    public function addColumns($cols = array())
    {
        
        if (isset($this->_rows)) {
            $this->_rows = array();
        }
        
        $this->_cols = $cols;
    } // end func addColumns
    
    public function addFrame($name, $source, $target = '_self')
    {
        $this->$name = new HTML_Page2_Frameset_Frame(array('name'   => $name, 
                                                           'src'    => $source,
                                                           'target' => $target
                                                           ));
    } // end func addFrame
    
    public function addFrameset($name)
    {
        $this->$name = new HTML_Page2_Frameset();
    } // end func addFrame
    
    public function toHTML()
    {
        // get line endings
        $lnEnd  = $this->_getLineEnd();
        $tab    = $this->_getTab();
        $tabs   = $this->_getTabs();
        $offset = $this->getTabOffset();
        
        if ($this->xhtml === true) {
            $tagEnd = ' />';
        } else {
            $tagEnd = '>';
        }
        
        if (count($this->_rows) > 0) {
            $type = 'rows';
            $sizesStr = implode(', ', $this->_rows);
        } else {
            $type = 'cols';
            $sizesStr = implode(', ', $this->_cols);
        }
        
        $strHtml  = $tabs . '<frameset ' . $type . '="' . $sizesStr . '">' . $lnEnd;
        
        $type = '_' . $type;
        foreach (array_keys($this->$type) as $name) {
            if(strtolower(get_class($this->$name)) == 'html_page2_frameset') {
                $this->$name->setTabOffset($offset + 1);
                $this->$name->setTab($tab);
                $this->$name->setLineEnd($lnEnd);
                $this->$name->xhtml = $this->xhtml;

                // fetch the
                $strHtml .= $this->$name->toHtml();
            } else {
                $this->$name->xhtml = $this->xhtml;
                $strHtml .= $tabs . $tab . $this->$name->toHtml() . $lnEnd;
            }
        }
        if (!$this->_master) {
            $strHtml .= $tabs . '</frameset>' . $lnEnd;
        }
        
        return $strHtml;
        
    } // end func toHtml
}
?>
