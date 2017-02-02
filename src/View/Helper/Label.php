<?php

/**
 * Label view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#labels
 */
namespace LosUi\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Label view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#labels
 */
class Label extends AbstractHelper
{
    protected $format = '<span class="label %s">%s</span>';

    public function info($label)
    {
        return $this->render($label, 'label-info');
    }

    public function success($label)
    {
        return $this->render($label, 'label-success');
    }

    public function warning($label)
    {
        return $this->render($label, 'label-warning');
    }

    public function primary($label)
    {
        return $this->render($label, 'label-primary');
    }

    public function danger($label)
    {
        return $this->render($label, 'label-danger');
    }

    public function error($label)
    {
        return $this->danger($label);
    }

    public function render($label, $class = ' label-default')
    {
        $class = trim($class);

        return sprintf($this->format, $class, $label);
    }

    public function __invoke($label = null, $class = ' label-default')
    {
        if ($label) {
            return $this->render($label, $class);
        }

        return $this;
    }
}
