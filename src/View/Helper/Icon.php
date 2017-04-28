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
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://fontawesome.io
 * @link       http://getbootstrap.com/components/#glyphicons
 */
namespace LosUi\View\Helper;

/**
 * Icon view helper.
 *
 * Can be used for Gltphicon and FontAwesome
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://fontawesome.io
 * @link       http://getbootstrap.com/components/#glyphicons
 */
class Icon
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

    public function render($icon, $style = null)
    {
        if (substr($icon, 0, 3) == 'fa-') {
            $class = trim('fa '.$icon);
            $format = $this->formatI;
        } else {
            $class = trim('glyphicon '.$icon);
            $format = $this->format;
        }

        if (!empty($style)) {
            $style = ' style="'.$style.'"';
        }

        return sprintf($format, $class, $style);
    }
}
