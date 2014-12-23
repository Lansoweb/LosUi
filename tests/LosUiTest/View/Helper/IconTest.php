<?php
/**
 * Tests for Icon View Helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @subpackage Tests
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\Icon;

class IconTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Icon();
    }

    private function getExpected($icon, $glyphicon = true, $style = '')
    {
        if ($glyphicon) {
            return '<span class="glyphicon glyphicon-'.$icon.'"'.$style.'></span>';
        } else {
            return '<span class="fa fa-'.$icon.'"></span>';
        }
    }

    public function testRenderGlyphicon()
    {
        $this->assertEquals($this->getExpected('user'), $this->helper->render('glyphicon-user'));
    }
    public function testRenderGlyphiconWithStyle()
    {
        $this->assertEquals($this->getExpected('user', true, ' style="width:100px;"'), $this->helper->render('glyphicon-user', 'width:100px;'));
    }

    public function testRenderFontAwesome()
    {
        $this->assertEquals($this->getExpected('user', false), $this->helper->render('fa-user'));
    }

    public function testInvoke()
    {
        $this->assertEquals($this->getExpected('user'), $this->helper->__invoke('glyphicon-user'));
    }

    public function testGlyphiconCall()
    {
        $this->assertEquals($this->getExpected('user'), $this->helper->GlyphiconUser());
    }

    public function testFontAwesomeCall()
    {
        $this->assertEquals($this->getExpected('user',false), $this->helper->FaUser());
    }
}
