<?php

/**
 * Form View Helper.
 *
 * This view helper overrides the default ZF2 helper to use the LosFormRow
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/css/#forms
 */
namespace LosUi\Form\View\Helper;

use Zend\Form\FormInterface;
use Zend\Form\FieldsetInterface;
use Zend\Form\View\Helper\Form as ZfFormHelper;
use Zend\Form\Element\Button;
use Zend\Form\Element\Submit;

/**
 * Form View Helper.
 *
 * This view helper overrides the default ZF2 helper to use the LosFormRow
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/css/#forms
 */
class Form extends ZfFormHelper
{
    protected $isHorizontal = false;

    protected $labelColumns = 2;

    /**
     * (non-PHPdoc).
     *
     * @see \Zend\Form\View\Helper\Form::render()
     */
    public function render(FormInterface $form, $isHorizontal = false, $labelColumns = 2)
    {
        $this->isHorizontal = (bool) $isHorizontal;
        $this->labelColumns = (int) $labelColumns;

        $this->setHorizontal($form, $this->isHorizontal);

        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '';

        $buttons = [];

        foreach ($form as $element) {
            if ($element instanceof Button || $element instanceof Submit) {
                $buttons[] = $element;
                continue;
            } elseif ($element instanceof FieldsetInterface) {
                $formContent .= $this->view->plugin('los_form_collection')->render($element);
            } else {
                $formContent .= $this->view->plugin('los_form_row')->render($element, $this->isHorizontal, $this->labelColumns);
            }
        }

        if (count($buttons) > 0) {
            $formContent .= $this->view->plugin('los_form_row')->renderButtons($buttons, $this->isHorizontal, $this->labelColumns);
        }

        return $this->openTag($form).$formContent.$this->closeTag();
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Zend\Form\View\Helper\Form::__invoke()
     */
    public function __invoke(FormInterface $form = null, $isHorizontal = false, $labelColumns = 2)
    {
        $this->isHorizontal = (bool) $isHorizontal;
        $this->labelColumns = (int) $labelColumns;

        if (!$form) {
            return $this;
        }

        return $this->render($form, $this->isHorizontal, $this->labelColumns);
    }

    /**
     * @param FormInterface|null $form
     */
    private function setHorizontal($form, $isHorizontal = false)
    {
        $this->isHorizontal = (bool) $isHorizontal;

        if ($this->isHorizontal && $form !== null) {
            if ($form->hasAttribute('class')) {
                $form->setAttribute('class', 'form-horizontal '.$form->getAttribute('class'));
            } else {
                $form->setAttribute('class', 'form-horizontal');
            }
        }
    }

    public function openTag(FormInterface $form = null, $isHorizontal = false)
    {
        $this->setHorizontal($form, $isHorizontal);

        return parent::openTag($form);
    }
}
