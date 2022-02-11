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
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/css/#forms
 */
namespace LosUi\Form\View\Helper;

use Laminas\Form\FormInterface;
use Laminas\Form\FieldsetInterface;
use Laminas\Form\View\Helper\Form as ZfFormHelper;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Submit;

/**
 * Form View Helper.
 *
 * This view helper overrides the default ZF2 helper to use the LosFormRow
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/css/#forms
 */
class Form extends ZfFormHelper
{
    protected bool $isHorizontal = false;

    protected int $labelColumns = 2;

    /**
     * (non-PHPdoc).
     *
     * @see \Laminas\Form\View\Helper\Form::render()
     */
    public function render(FormInterface $form): string
    {
        $this->setHorizontal($form);

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
                $formContent .= $this->view->plugin('losFormCollection')->render($element);
            } else {
                $formContent .= $this->view->plugin('losFormRow')
                    ->setIsHorizontal($this->isHorizontal)
                    ->setLabelColumns($this->labelColumns)
                    ->render($element);
            }
        }

        if (count($buttons) > 0) {
            $formContent .= $this->view->plugin('losFormRow')
                ->setIsHorizontal($this->isHorizontal)
                ->setLabelColumns($this->labelColumns)
                ->renderButtons($buttons);
        }

        return $this->openTag($form).$formContent.$this->closeTag();
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Laminas\Form\View\Helper\Form::__invoke()
     */
    public function __invoke(FormInterface $form = null)
    {
        if (! $form) {
            return $this;
        }

        return $this->render($form);
    }

    /**
     * @param FormInterface|null $form
     */
    private function setHorizontal($form)
    {
        if ($this->isHorizontal && $form !== null) {
            if ($form->hasAttribute('class')) {
                $form->setAttribute('class', 'form-horizontal '.$form->getAttribute('class'));
            } else {
                $form->setAttribute('class', 'form-horizontal');
            }
        }
    }

    public function openTag(?FormInterface $form = null): string
    {
        $this->setHorizontal($form);

        return parent::openTag($form);
    }

    public function setIsHorizontal(bool $isHorizontal): Form
    {
        $this->isHorizontal = $isHorizontal;

        return $this;
    }

    public function setLabelColumns(int $labelColumns): Form
    {
        $this->labelColumns = $labelColumns;
        return $this;
    }
}
