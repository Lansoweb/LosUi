<?php

namespace LosUi\View\Helper;

use Zend\View\Helper\Navigation as ZendNavigation;

class Navigation extends ZendNavigation
{
    protected $defaultProxy = 'menu';

    protected $defaultHelpers = array(
        'breadcrumbs' => 'LosUi\View\Helper\Navigation\Breadcrumbs',
        'menu'        => 'LosUi\View\Helper\Navigation\Menu',
    );

    public function getPluginManager()
    {
        $pm = parent::getPluginManager();
        foreach ($this->defaultHelpers as $name => $invokableClass) {
            $pm->setInvokableClass($name, $invokableClass);
        }
        return $pm;
    }
}