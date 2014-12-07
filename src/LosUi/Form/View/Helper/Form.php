<?php
namespace LosUi\Form\View\Helper;

use Zend\Form\FormInterface;
use Zend\Form\FieldsetInterface;
use Zend\Form\View\Helper\Form as ZfFormHelper;

class Form extends ZfFormHelper
{

    public function render(FormInterface $form)
    {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '';

        foreach ($form as $element) {
            if ($element instanceof FieldsetInterface) {
                $formContent .= $this->getView()->formCollection($element);
            } else {
                $formContent .= $this->view->plugin('los_form_row')->render($element);
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }
}
