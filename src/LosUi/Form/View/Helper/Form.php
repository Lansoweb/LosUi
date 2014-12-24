<?php
/**
 * Form View Helper
 *
 * This view helper overrides the default ZF2 helper to use the LosFormRow
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/css/#forms
 */
namespace LosUi\Form\View\Helper;

use Zend\Form\FormInterface;
use Zend\Form\FieldsetInterface;
use Zend\Form\View\Helper\Form as ZfFormHelper;

/**
 *
 * Form View Helper
 *
 * This view helper overrides the default ZF2 helper to use the LosFormRow
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/css/#forms
 */
class Form extends ZfFormHelper
{

    protected $isHorizontal = false;

    protected $labelColumns = 2;

    /**
     * (non-PHPdoc)
     * @see \Zend\Form\View\Helper\Form::render()
     */
    public function render(FormInterface $form, $isHorizontal = false, $labelColumns = 2)
    {
        $this->isHorizontal = (bool) $isHorizontal;
        $this->labelColumns = (int) $labelColumns;

        $this->setHorizontal($form, $isHorizontal);

        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '';

        foreach ($form as $element) {
            if ($element instanceof FieldsetInterface) {
                $formContent .= $this->getView()->formCollection($element);
            } else {
                $formContent .= $this->view->plugin('los_form_row')->render($element, $this->isHorizontal, $this->labelColumns);
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }

    public function __invoke(FormInterface $form = null, $isHorizontal = false, $labelColumns = 2)
    {
        $this->isHorizontal = (bool) $isHorizontal;
        $this->labelColumns = (int) $labelColumns;

        if (! $form) {
            return $this;
        }

        return $this->render($form);
    }

    private function setHorizontal($form, $isHorizontal)
    {
        if ($this->isHorizontal) {
            if ($form->hasAttribute('class')) {
                $form->setAttribute('class', 'form-horizontal ' . $form->getAttribute('class'));
            } else {
                $form->setAttribute('class', 'form-horizontal');
            }
        }
    }

    public function openTag(FormInterface $form = null, $isHorizontal = false)
    {
        $this->isHorizontal = (bool) $isHorizontal;

        $this->setHorizontal($form, $isHorizontal);

        return parent::openTag($form);
    }
}
