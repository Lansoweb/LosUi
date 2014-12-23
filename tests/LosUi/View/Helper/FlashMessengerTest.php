<?php
/**
 * Tests for FlashMessenger View Helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @subpackage Tests
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\FlashMessenger;

class FlashMessengerTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new FlashMessenger();
    }
    
    private function getExpected($content,$two = false)
    {
        if (!$two) {
        return '<div class="alert alert-dismissable alert-success">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         &times;
     </button>
     <ul><li>'.$content.'</li></ul></div>';
        } else {
            return '<div class="alert alert-dismissable alert-danger">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                     &times;
                 </button>
                 <ul><li>bar</li></ul></div><div class="alert alert-dismissable alert-success">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
           &times;
           </button>
           <ul><li>foo</li></ul></div>';
        }
    }

    public function testRender()
    {
        $this->helper->getPluginFlashMessenger()->addSuccessMessage('foo');
        $this->assertEquals($this->getExpected('foo'), $this->helper->renderAll());
    }

    public function testRenderTwoMessages()
    {
        $this->helper->getPluginFlashMessenger()->addSuccessMessage('foo');
        $this->helper->getPluginFlashMessenger()->addErrorMessage('bar');
        $actual_out = $this->helper->renderAll();
        $actual_out = str_replace(["\n",'\t','  '], '',$actual_out);
        $expected = $this->getExpected('foo',true);
        $expected = str_replace(["\n",'\t','  '], '',$expected);
        $this->assertEquals($expected, $actual_out);
    }
}