<?php
namespace LosUi\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

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
