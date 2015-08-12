<?php

/**
 * Tests for Badge View Helper.
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

use LosUi\View\Helper\Badge;

class BadgeTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Badge();
    }

    private function getExpected($content)
    {
        return '<span class="badge">'.$content.'</span>';
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
