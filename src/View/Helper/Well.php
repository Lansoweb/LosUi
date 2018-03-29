<?php

/**
 * Well view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#wells
 */
namespace LosUi\View\Helper;

/**
 * Well view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#wells
 */
class Well
{
    protected $format = '<div class="well%s">%s</div>';

    public function __invoke($content = '', $class = '')
    {
        if ($content) {
            return $this->render($content, $class);
        }

        return $this;
    }

    public function large($content)
    {
        return $this->render($content, 'well-lg');
    }

    public function small($content)
    {
        return $this->render($content, 'well-sm');
    }

    public function render($content, $class = '')
    {
        if (! empty($class)) {
            $class = ' '.trim($class);
        }

        return sprintf($this->format, $class, $content);
    }
}
