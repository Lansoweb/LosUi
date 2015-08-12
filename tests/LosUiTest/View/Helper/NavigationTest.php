<?php

/**
 * Tests for Navigation View Helper.
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

use LosUi\View\Helper\Navigation;

class NavigationTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Navigation();
    }

    public function testHelpersWereAdded()
    {
        $pm = $this->helper->getPluginManager();
        $this->assertTrue($pm->has('menu'));
        $this->assertInstanceOf('LosUi\View\Helper\Navigation\Menu', $pm->get('menu'));
        $this->assertInstanceOf('LosUi\View\Helper\Navigation\Breadcrumbs', $pm->get('breadcrumbs'));
    }
}
