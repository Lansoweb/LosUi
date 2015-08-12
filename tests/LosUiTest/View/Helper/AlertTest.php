<?php

/**
 * Tests for Alert View Helper.
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

use LosUi\View\Helper\Alert;

class AlertTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Alert();
    }

    private function getExpected($type, $dismissible = false)
    {
        if ($dismissible) {
            return '<div class="alert alert-dismissible alert-'.$type.'" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>foo</div>';
        } else {
            return '<div class="alert alert-'.$type.'" role="alert">foo</div>';
        }
    }

    public function testInfo()
    {
        $this->assertEquals($this->getExpected('info'), $this->helper->info('foo'));
    }

    public function testDismissibleInfo()
    {
        $this->assertEquals($this->getExpected('info', true), $this->helper->setDismissible(true)->info('foo'));
    }

    public function testError()
    {
        $this->assertEquals($this->getExpected('danger'), $this->helper->error('foo'));
    }

    public function testDismissibleError()
    {
        $this->assertEquals($this->getExpected('danger', true), $this->helper->setDismissible(true)->error('foo'));
    }

    public function testDanger()
    {
        $this->assertEquals($this->getExpected('danger'), $this->helper->danger('foo'));
    }

    public function testDismissibleDanger()
    {
        $this->assertEquals($this->getExpected('danger', true), $this->helper->setDismissible(true)->danger('foo'));
    }

    public function testWarning()
    {
        $this->assertEquals($this->getExpected('warning'), $this->helper->warning('foo'));
    }

    public function testDismissibleWarning()
    {
        $this->assertEquals($this->getExpected('warning', true), $this->helper->setDismissible(true)->warning('foo'));
    }

    public function testSuccess()
    {
        $this->assertEquals($this->getExpected('success'), $this->helper->success('foo'));
    }

    public function testDismissibleSuccess()
    {
        $this->assertEquals($this->getExpected('success', true), $this->helper->setDismissible(true)->success('foo'));
    }

    public function testRender()
    {
        $this->assertEquals($this->getExpected('warning'), $this->helper->render('foo'));
    }

    public function testDismissibleRender()
    {
        $this->assertEquals($this->getExpected('warning', true), $this->helper->setDismissible(true)->render('foo'));
    }

    public function testInvoke()
    {
        $this->assertEquals($this->getExpected('warning'), $this->helper->__invoke('foo'));
    }

    public function testDismissibleInvoke()
    {
        $this->assertEquals($this->getExpected('warning', true), $this->helper->setDismissible(true)->__invoke('foo'));
    }
}
