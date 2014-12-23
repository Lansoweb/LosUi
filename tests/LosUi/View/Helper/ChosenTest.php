<?php
/**
 * Tests for Chosen View Helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @subpackage Tests
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\Chosen;

class ChosenTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Chosen();
    }
    
    private function getExpected($content, $options = '')
    {
        return '$("'.$content.'").chosen('.$options.');';
    }

    public function testRender()
    {
        $this->assertEquals($this->getExpected('foo'), $this->helper->render('foo',[],false));
    }
    
    public function testRenderWithOptions()
    {
        $this->assertEquals($this->getExpected('foo',"{width: '100px', height: '30px'}"), $this->helper->render('foo',['width'=>'100px','height'=>'30px'],false));
    }
    
    public function testInvoke()
    {
        $this->assertEquals($this->getExpected('foo'), $this->helper->__invoke('foo',[],false));
    }
    
    public function testInvokeWithOptions()
    {
        $this->assertEquals($this->getExpected('foo',"{width: '100px', height: '30px'}"), $this->helper->__invoke('foo',['width'=>'100px','height'=>'30px'],false));
    }
    
    
}