<?php

/**
 * Navigation view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
namespace LosUi\View\Helper;

use LosUi\View\Helper\Navigation\Breadcrumbs;
use LosUi\View\Helper\Navigation\Menu;
use Laminas\View\Helper\Navigation as ZendNavigation;

/**
 * Navigation view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
class Navigation extends ZendNavigation
{
    protected $defaultProxy = 'menu';

    protected $defaultHelpers = [
        'breadcrumbs' => Breadcrumbs::class,
        'menu' => Menu::class,
    ];

    public function getPluginManager()
    {
        $pm = parent::getPluginManager();
        foreach ($this->defaultHelpers as $name => $invokableClass) {
            $pm->setInvokableClass($name, $invokableClass);
        }

        return $pm;
    }
}
