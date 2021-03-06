<?php

/**
 * Image view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/css/#images
 */
namespace LosUi\View\Helper;

/**
 * Image view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/css/#images
 */
class Image
{
    protected $format = '<img src="%s"%s>';

    protected $isResponsive = true;

    public function rounded($src)
    {
        return $this->render($src, 'img-rounded');
    }

    public function circle($src)
    {
        return $this->render($src, 'img-circle');
    }

    public function thumbnail($src)
    {
        return $this->render($src, 'img-thumbnail');
    }

    public function render($src, $class = '')
    {
        $class = trim($class);

        if ($this->isResponsive) {
            if (! empty($class)) {
                $class .= ' ';
            }
            $class .= 'img-responsive';
        }

        return sprintf($this->format, $src, ! empty($class) ? " class=\"$class\"" : '');
    }

    public function setResponsive($responsive)
    {
        if (! is_bool($responsive)) {
            throw new \InvalidArgumentException('Argument must be a bool value.');
        }

        $this->isResponsive = $responsive;

        return $this;
    }

    public function __invoke($src = '', $class = '')
    {
        if ($src) {
            return $this->render($src, $class);
        }

        return $this;
    }
}
