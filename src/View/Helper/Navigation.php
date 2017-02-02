<?php

/**
 * Navigation view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
namespace LosUi\View\Helper;

use Zend\View\Helper\Navigation as ZendNavigation;

/**
 * Navigation view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
class Navigation extends ZendNavigation
{
    protected $defaultProxy = 'menu';

    protected $defaultHelpers = [
        'breadcrumbs' => 'LosUi\View\Helper\Navigation\Breadcrumbs',
        'menu' => 'LosUi\View\Helper\Navigation\Menu',
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
