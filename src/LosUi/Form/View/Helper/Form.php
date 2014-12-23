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

    /**
     * (non-PHPdoc)
     * @see \Zend\Form\View\Helper\Form::render()
     */
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
