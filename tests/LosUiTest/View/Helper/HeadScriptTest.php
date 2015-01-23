<?php
/**
 * Tests for HeadScript View Helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @subpackage Tests
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\HeadScript;

class HeadScriptTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new HeadScript();
    }

    public function tearDown()
    {
        unset($this->helper);
    }

    private function getExpected($content)
    {
        return '<span class="badge">'.$content.'</span>';
    }

    public function testBootstrap()
    {
        $this->assertEquals('<script type="text/javascript" src="/bootstrap/dist/js/bootstrap.min.js"></script>',
            $this->helper->appendBootstrap()->toString());
    }
    public function testBootstrapCdn()
    {
        $this->assertEquals('<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/'.HeadScript::VERSION_BOOTSTRAP.'/js/bootstrap.min.js"></script>',
            $this->helper->appendBootstrap(true)->toString());
    }
    public function testBootstrapUnminified()
    {
        $this->assertEquals('<script type="text/javascript" src="/bootstrap/dist/js/bootstrap.js"></script>',
            $this->helper->appendBootstrap(false, false)->toString());
    }
    public function testBootstrapUnminifiedCdn()
    {
        $this->assertEquals('<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/'.HeadScript::VERSION_BOOTSTRAP.'/js/bootstrap.js"></script>',
            $this->helper->appendBootstrap(true, false)->toString());
    }
    public function testBootstrapVersioned()
    {
        $this->assertEquals('<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.js"></script>',
            $this->helper->appendBootstrap(true, false, '3.3.0')->toString());
    }

    public function testJquery()
    {
        $this->assertEquals('<script type="text/javascript" src="/jquery/dist/jquery.min.js"></script>',
            $this->helper->appendJquery()->toString());
    }
    public function testJqueryCdn()
    {
        $this->assertEquals('<script type="text/javascript" src="//code.jquery.com/jquery-'.HeadScript::VERSION_JQUERY.'.min.js"></script>',
            $this->helper->appendJquery(true)->toString());
    }
    public function testJqueryUnminified()
    {
        $this->assertEquals('<script type="text/javascript" src="/jquery/dist/jquery.js"></script>',
            $this->helper->appendJquery(false, false)->toString());
    }
    public function testJqueryUnminifiedCdn()
    {
        $this->assertEquals('<script type="text/javascript" src="//code.jquery.com/jquery-'.HeadScript::VERSION_JQUERY.'.js"></script>',
            $this->helper->appendJquery(true, false)->toString());
    }
    public function testJqueryVersioned()
    {
        $this->assertEquals('<script type="text/javascript" src="//code.jquery.com/jquery-3.3.0.js"></script>',
            $this->helper->appendJquery(true, false, '3.3.0')->toString());
    }

    public function testChosen()
    {
        $this->assertEquals('<script type="text/javascript" src="/chosen/chosen.jquery.min.js"></script>',
            $this->helper->appendChosen()->toString());
    }
    public function testChosenUnminified()
    {
        $this->assertEquals('<script type="text/javascript" src="/chosen/chosen.jquery.js"></script>',
            $this->helper->appendChosen(false, false)->toString());
    }
}
