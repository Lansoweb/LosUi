<?php
/**
 * Tests for Icon View Helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @subpackage Tests
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#alerts
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

    private function getExpected($icon, $glyphicon = true, $style = '', $tag = 'span')
    {
        if ($glyphicon) {
            return "<$tag class=\"glyphicon glyphicon-$icon\"$style></$tag>";
        } else {
            return "<$tag class=\"fa fa-$icon\"></$tag>";
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
    public function testRenderGlyphiconWithI()
    {
        $this->assertEquals($this->getExpected('user', true, '', 'i'), $this->helper->render('glyphicon-user', null, true));
    }
    public function testRenderFontAwesome()
    {
        $this->assertEquals($this->getExpected('user', false), $this->helper->render('fa-user'));
    }
    public function testRenderFontAwesomeWithI()
    {
        $this->assertEquals($this->getExpected('user', false, '', 'i'), $this->helper->render('fa-user', null, true));
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
        $this->assertEquals($this->getExpected('user', false), $this->helper->FaUser());
    }
}
