<?php

/**
 * Icon view helper.
 *
 * Can be used for Gltphicon and FontAwesome
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://fontawesome.io
 * @link       http://getbootstrap.com/components/#glyphicons
 */
namespace LosUi\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Filter\FilterChain;
use Zend\Filter\Word\CamelCaseToDash;
use Zend\Filter\StringToLower;

/**
 * Icon view helper.
 *
 * Can be used for Gltphicon and FontAwesome
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://fontawesome.io
 * @link       http://getbootstrap.com/components/#glyphicons
 */
class Icon extends AbstractHelper
{
    protected $format = '<span class="%s"%s></span>';
    protected $formatI = '<i class="%s"%s></i>';

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

        return $this->render($icon, isset($args[0]) ? $args[0] : '', isset($args[1]) ? $args[1] : false);
    }

    public function render($icon, $style = null, $useTagI = false)
    {
        if (substr($icon, 0, 3) == 'fa-') {
            $class = trim('fa '.$icon);
        } else {
            $class = trim('glyphicon '.$icon);
        }

        if (!empty($style)) {
            $style = ' style="'.$style.'"';
        }

        if ($useTagI) {
            return sprintf($this->formatI, $class, $style);
        } else {
            return sprintf($this->format, $class, $style);
        }
    }
}
