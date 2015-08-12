<?php

/**
 * Tests for Well View Helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\Well;

class WellTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Well();
    }

    private function getExpected($content, $class = '')
    {
        return '<div class="well'.$class.'">'.$content.'</div>';
    }

    public function testLarge()
    {
        $this->assertEquals($this->getExpected('foo', ' well-lg'), $this->helper->large('foo'));
    }
    public function testSmall()
    {
        $this->assertEquals($this->getExpected('foo', ' well-sm'), $this->helper->small('foo'));
    }

    public function testRender()
    {
        $this->assertEquals($this->getExpected('foo'), $this->helper->render('foo'));
    }

    public function testInvoke()
    {
        $this->assertEquals($this->getExpected('foo'), $this->helper->__invoke('foo'));
    }
}
