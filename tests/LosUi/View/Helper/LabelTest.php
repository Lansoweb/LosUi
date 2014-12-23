<?php
/**
 * Tests for Label View Helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @subpackage Tests
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\Label;

class LabelTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Label();
    }
    
    private function getExpected($type)
    {
        return '<span class="label label-'.$type.'">foo</span>';
    }

    public function testInfo()
    {
        $this->assertEquals($this->getExpected('info'), $this->helper->info('foo'));
    }
    
    public function testError()
    {
        $this->assertEquals($this->getExpected('danger'), $this->helper->error('foo'));
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
    
    public function testRender()
    {
        $this->assertEquals($this->getExpected('default'), $this->helper->render('foo'));
    }

    public function testInvoke()
    {
        $this->assertEquals($this->getExpected('default'), $this->helper->__invoke('foo'));
    }
    
}