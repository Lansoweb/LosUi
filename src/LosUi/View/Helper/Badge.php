<?php
namespace LosUi\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

class Badge extends AbstractHelper
{

    protected $format = '<span class="badge">%s</span>';

    public function render($badge)
    {
        return sprintf($this->format, $badge);
    }

    public function __invoke($badge = null)
    {
        if ($badge) {
            return $this->render($badge);
        }

        return $this;
    }
}
