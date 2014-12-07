<?php
namespace LosUi\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Filter\FilterChain;
use Zend\Filter\Word\CamelCaseToDash;
use Zend\Filter\StringToLower;

class Icon extends AbstractHelper
{

    protected $format = '<span class="%s"%s></span>';

    public function __invoke($icon = null, $style = '')
    {
        if ($icon) {
            return $this->render($icon, $style);
        }

        return $this;
    }

    public function __call($method, $args)
    {
        $filterChain = new FilterChain();

        $filterChain->attach(new CamelCaseToDash())->attach(new StringToLower());

        $icon = $filterChain->filter($method);

        return $this->render($icon, isset($args[0]) ? $args[0] : '');
    }

    public function render($icon, $style = '')
    {
        if (substr($icon, 0, 3) == 'fa-') {
            $class = trim('fa ' . $icon);
        } else {
            $class = trim('glyphicon ' . $icon);
        }

        if ($style != '') {
            $style = ' style="' . $style . '"';
        }

        return sprintf($this->format, $class, $style);
    }
}
