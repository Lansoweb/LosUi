<?php

/**
 * Alert view helper styled for Bootstrap 3.
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
namespace LosUi\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Alert view helper styled for Bootstrap 3.
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
class Alert extends AbstractHelper
{
    protected $format = '<div class="alert %s" role="alert">%s</div>';

    protected $formatDismissible = '<div class="alert alert-dismissible %s" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>%s</div>';

    protected $isDismissible = false;

    public function info($alert)
    {
        return $this->render($alert, 'alert-info');
    }

    public function danger($alert)
    {
        return $this->render($alert, 'alert-danger');
    }

    public function error($alert)
    {
        return $this->danger($alert);
    }

    public function success($alert)
    {
        return $this->render($alert, 'alert-success');
    }

    public function warning($alert)
    {
        return $this->render($alert, 'alert-warning');
    }

    public function render($alert, $class = 'alert-warning')
    {
        $class = trim($class);

        if ($this->isDismissible) {
            return sprintf($this->formatDismissible, $class, $alert);
        } else {
            return sprintf($this->format, $class, $alert);
        }
    }

    public function setDismissible($dismissible)
    {
        if (!is_bool($dismissible)) {
            throw new \InvalidArgumentException('Argument must be a bool value.');
        }

        $this->isDismissible = $dismissible;

        return $this;
    }

    public function __invoke($alert = null, $class = 'alert-warning')
    {
        if ($alert) {
            return $this->render($alert, $class);
        }

        return $this;
    }
}
