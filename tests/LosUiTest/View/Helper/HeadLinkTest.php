<?php
/**
 * Tests for HeadLink View Helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @subpackage Tests
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\HeadLink;

class HeadLinkTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new HeadLink();
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
        $this->assertEquals('<link href="/bootstrap/dist/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendBootstrap()->toString());
    }
    public function testBootstrapCdn()
    {
        $this->assertEquals('<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendBootstrap(true)->toString());
    }
    public function testBootstrapUnminified()
    {
        $this->assertEquals('<link href="/bootstrap/dist/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendBootstrap(false, false)->toString());
    }
    public function testBootstrapUnminifiedCdn()
    {
        $this->assertEquals('<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendBootstrap(true, false)->toString());
    }
    public function testBootstrapVersioned()
    {
        $this->assertEquals('<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendBootstrap(true, false, '3.3.0')->toString());
    }

    public function testFontAwesome()
    {
        $this->assertEquals('<link href="/fontawesome/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendFontAwesome()->toString());
    }
    public function testFontAwesomeCdn()
    {
        $this->assertEquals('<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendFontAwesome(true)->toString());
    }
    public function testFontAwesomeUnminified()
    {
        $this->assertEquals('<link href="/fontawesome/css/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendFontAwesome(false, false)->toString());
    }
    public function testFontAwesomeUnminifiedCdn()
    {
        $this->assertEquals('<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendFontAwesome(true, false)->toString());
    }
    public function testFontAwesomeVersioned()
    {
        $this->assertEquals('<link href="//maxcdn.bootstrapcdn.com/font-awesome/3.3.0/css/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendFontAwesome(true, false, '3.3.0')->toString());
    }

    public function testChosen()
    {
        $this->assertEquals('<link href="/chosen/chosen.min.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendChosen()->toString());
    }
    public function testChosenUnminified()
    {
        $this->assertEquals('<link href="/chosen/chosen.css" media="screen" rel="stylesheet" type="text/css" />',
            $this->helper->appendChosen(false, false)->toString());
    }
}
