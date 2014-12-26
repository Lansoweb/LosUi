<?php
/**
 * Tests for Button View Helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @subpackage Tests
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\Button;

class ButtonTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Button();
    }

    private function getExpected($type, $asInput = Button::TYPE_BUTTON, $class = '', $attr = '')
    {
        if ($asInput == Button::TYPE_ANCHOR) {
            return '<a href="#" role="button" class="btn btn-'.$type.'">foo</a>';
        } elseif ($asInput == Button::TYPE_INPUT) {
            return '<input type="button" value="foo" class="btn btn-'.$type.'">';
        } else {
            return '<button type="button" class="btn btn-'.$type.$class.'"'.$attr.'>foo</button>';
        }
    }

    public function testDefault()
    {
        $this->assertEquals($this->getExpected('default'), $this->helper->useDefault('foo'));
    }

    public function testInfo()
    {
        $this->assertEquals($this->getExpected('info'), $this->helper->info('foo'));
    }

    public function testDanger()
    {
        $this->assertEquals($this->getExpected('danger'), $this->helper->danger('foo'));
    }

    public function testWarning()
    {
        $this->assertEquals($this->getExpected('warning'), $this->helper->warning('foo'));
    }

    public function testSuccess()
    {
        $this->assertEquals($this->getExpected('success'), $this->helper->success('foo'));
    }

    public function testLink()
    {
        $this->assertEquals($this->getExpected('link'), $this->helper->link('foo'));
    }

    public function testAnchorSuccess()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_ANCHOR), $this->helper->asAnchor()->success('foo'));
    }

    public function testInputSuccess()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_INPUT), $this->helper->asInput()->success('foo'));
    }

    public function testLarge()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, ' btn-lg'), $this->helper->setLarge()->success('foo'));
    }

    public function testSmall()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, ' btn-sm'), $this->helper->setSmall()->success('foo'));
    }

    public function testExtraSmall()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, ' btn-xs'), $this->helper->setExtraSmall()->success('foo'));
    }

    public function testBlock()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, ' btn-block'), $this->helper->isBlock()->success('foo'));
    }

    public function testActive()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, ' active'), $this->helper->isActive()->success('foo'));
    }

    public function testDisabled()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, '', ' disabled="disabled"'), $this->helper->isDisabled()->success('foo'));
    }

    public function testId()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, '', ' id="bar"'), $this->helper->setId('bar')->success('foo'));
    }

    public function testName()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, '', ' name="bar"'), $this->helper->setName('bar')->success('foo'));
    }

    public function testAll()
    {
        $this->assertEquals($this->getExpected('success', Button::TYPE_BUTTON, ' active btn-block btn-lg', ' disabled="disabled" id="bar" name="bar"'), $this->helper->setName('bar')->setId('bar')->setLarge()->isDisabled()->isActive()->isBlock()->isDisabled()->success('foo'));
    }

    public function testRender()
    {
        $this->assertEquals($this->getExpected('default'), $this->helper->render('foo'));
    }

    public function testInvoke()
    {
        $this->assertEquals($this->getExpected('default'), $this->helper->__invoke('foo'));
    }
}
