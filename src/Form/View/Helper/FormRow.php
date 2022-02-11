<?php

/**
 * Form row styled for Bootstrap 3.
 *
 * Long description for file (if any)...
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

use Laminas\Form\View\Helper\FormElementErrors;
use Laminas\Form\View\Helper\FormRow as ZfFormRow;
use Laminas\Form\ElementInterface;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\MonthSelect;
use Laminas\Form\LabelAwareInterface;
use Laminas\Form\Element\DateSelect;

/**
 * Form row styled for Bootstrap 3.
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
class FormRow extends ZfFormRow
{
    private int $labelColumns = 2;
    private bool $isHorizontal = false;

    protected $rowWrapper = '<div class="form-group%s">%s%s</div>';

    protected $horizontalRowWrapper = '<div class="form-group%s">%s<div class="col-sm-%d%s">%s</div>%s</div>';

    protected static $helpBlockFormat = '<p class="help-block">%s</p>';

    /**
     * @return FormElementErrors|\Laminas\Form\View\Helper\FormElementErrors
     */
    protected function getElementErrorsHelper(): FormElementErrors
    {
        if ($this->elementErrorsHelper) {
            return $this->elementErrorsHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementErrorsHelper = $this->view->plugin('losFormElementErrors');
        }

        if (! $this->elementErrorsHelper instanceof FormElementErrors) {
            $this->elementErrorsHelper = new FormElementErrors();
        }

        return $this->elementErrorsHelper;
    }

    public function renderButtons(array $elements)
    {
        $elementHelper = $this->getElementHelper();

        $elementString = '';

        foreach ($elements as $button) {
            $elementString .= $elementHelper->render($button).' ';
        }

        if ($this->isHorizontal && $this->labelPosition == self::LABEL_PREPEND) {
            $markup = sprintf(
                $this->horizontalRowWrapper,
                '',
                '',
                12 - $this->labelColumns,
                ' col-xs-offset-'.$this->labelColumns,
                $elementString,
                ''
            );
        } else {
            $markup = sprintf($this->rowWrapper, '', $elementString, '');
        }

        return $markup;
    }

    /**
     * @param $addon
     * @return string
     */
    private function addAddon($addon)
    {
        if ($addon !== null) {
            if (substr($addon, 0, 3) === 'fa-') {
                $addon = '<i class="fa '.$addon.'"></i>';
            } elseif (substr($addon, 0, 5) === 'glyph') {
                $addon = '<span class="glyphicon '.$addon.'"></span>';
            }

            return '<div class="input-group-addon">'.$addon.'</div>';
        }

        return '';
    }

    public function render(ElementInterface $element, ?string $labelPosition = null): string
    {
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $labelHelper = $this->getLabelHelper();
        $elementHelper = $this->getElementHelper();
        $elementErrorsHelper = $this->getElementErrorsHelper();

        $label = $element->getLabel();
        $inputErrorClass = $this->getInputErrorClass();

        if (isset($label) && '' !== $label) {
            // Translate the label
            if (null !== ($translator = $this->getTranslator())) {
                $label = $translator->translate($label, $this->getTranslatorTextDomain());
            }
        }

        $type = $element->getAttribute('type');

        if ($element instanceof DateSelect) {
            $attrs = $element->getDayAttributes();
            $classAttributes = (in_array('class', $attrs) ? $attrs['class'].' ' : '');
            $classAttributes = $classAttributes.'form-control';
            $attrs['class'] = $classAttributes;
            $element->setDayAttributes($attrs);

            $attrs = $element->getMonthAttributes();
            $classAttributes = (in_array('class', $attrs) ? $attrs['class'].' ' : '');
            $classAttributes = $classAttributes.'form-control';
            $attrs['class'] = $classAttributes;
            $element->setMonthAttributes($attrs);

            $attrs = $element->getYearAttributes();
            $classAttributes = (in_array('class', $attrs) ? $attrs['class'].' ' : '');
            $classAttributes = $classAttributes.'form-control';
            $attrs['class'] = $classAttributes;
            $element->setYearAttributes($attrs);
        } elseif ($type != 'checkbox' && $type != 'submit' && $type != 'button' && $type != 'radio' &&
            $type != 'file' && $type != 'multi_checkbox'
        ) {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute('class').' ' : '');
            $classAttributes = $classAttributes.'form-control';
            $element->setAttribute('class', $classAttributes);
        } elseif ($type == 'button' || $type == 'submit') {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute('class').' ' : '');
            $classAttributes = $classAttributes.'btn';
            $element->setAttribute('class', $classAttributes);
        }

        // Does this element have errors ?
        if (count($element->getMessages()) > 0 && ! empty($inputErrorClass)) {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute('class').' ' : '');
            $classAttributes = $classAttributes.$inputErrorClass;

            $element->setAttribute('class', $classAttributes);
        }

        if ($this->partial) {
            $vars = [
                'element' => $element,
                'label' => $label,
                'labelAttributes' => $this->labelAttributes,
                'labelPosition' => $this->labelPosition,
                'renderErrors' => $this->renderErrors,
            ];

            return $this->view->render($this->partial, $vars);
        }

        $elementErrors = '';
        if ($this->renderErrors) {
            $elementErrors = $elementErrorsHelper->render($element, [
                'class' => 'text-danger',
            ]);
        }

        $elementString = $elementHelper->render($element);
        $addonAppend = $element->getOption('addon-append');
        $addonPrepend = $element->getOption('addon-prepend');
        if ($addonAppend !== null || $addonPrepend !== null) {
            $addonString = '<div class="input-group">';
            $addonString .= $this->addAddon($addonPrepend);
            $addonString .= $elementString;
            $addonString .= $this->addAddon($addonAppend);
            $addonString .= '</div>';

            $elementString = $addonString;
        }

        $elementString .= $this->getHelpBlock($element);

        // hidden elements do not need a <label> -https://github.com/zendframework/zf2/issues/5607
        if (isset($label) && '' !== $label && $type !== 'hidden') {
            $labelAttributes = [];

            if ($element instanceof LabelAwareInterface) {
                $labelAttributes = $element->getLabelAttributes();
            }

            if (! $element instanceof LabelAwareInterface || ! $element->getLabelOption('disable_html_escape')) {
                $label = $escapeHtmlHelper($label);
            }

            if (empty($labelAttributes)) {
                $labelAttributes = $this->labelAttributes;
            }

            if (! $element->getAttribute('id') && $element->getName()) {
                $element->setAttribute('id', $element->getName());
            }
            if ($element->getAttribute('id')) {
                $labelAttributes['for'] = $element->getAttribute('id');
            }
            if ($this->isHorizontal) {
                $labelAttributes['class'] = ' control-label col-sm-'.$this->labelColumns;
                if ($element instanceof LabelAwareInterface) {
                    $element->setLabelAttributes([
                        'class' => 'control-label col-sm-'.$this->labelColumns,
                    ]);
                }
            } else {
                $labelAttributes['class'] = ' control-label';
                if ($element instanceof LabelAwareInterface) {
                    $element->setLabelAttributes([
                        'class' => 'control-label',
                    ]);
                }
            }

            // Multicheckbox elements have to be handled differently as the HTML standard does not allow nested
            // labels. The semantic way is to group them inside a fieldset
            if (! $this->isHorizontal && ($type === 'multi_checkbox' || $type === 'radio' ||
                    ($element instanceof MonthSelect && ! $element instanceof DateSelect))) {
                $markup = sprintf(
                    '<fieldset class="radio"><legend>%s</legend>%s</fieldset>',
                    $label,
                    $elementString
                );
            } elseif ($type == 'checkbox') {
                // Checkboxes need special treatment too
                if ($this->isHorizontal) {
                    $markup = '<div class="form-group"><div class="checkbox col-xs-'.(12 - $this->labelColumns) .
                        ' col-xs-offset-'.$this->labelColumns.'"><label>'.$elementString.$label.'</label></div></div>';
                } else {
                    $markup = '<div class="checkbox"><label>'.$elementString.$label.'</label></div>';
                }
            } else {
                // Ensure element and label will be separated if element has an `id`-attribute.
                // If element has label option `always_wrap` it will be nested in any case.
                if ($element->hasAttribute('id') &&
                    ($element instanceof LabelAwareInterface && ! $element->getLabelOption('always_wrap'))
                ) {
                    $labelOpen = '';
                    $labelClose = '';
                    $label = $labelHelper($element);
                } else {
                    $labelOpen = $labelHelper->openTag($labelAttributes);
                    $labelClose = $labelHelper->closeTag();
                }

                if ($label !== '' && (! $element->hasAttribute('id')) ||
                    ($element instanceof LabelAwareInterface && $element->getLabelOption('always_wrap'))
                ) {
                    $label = '<span>'.$label.'</span>';
                }

                $addDivClass = '';
                // Button element is a special case, because label is always rendered inside it
                if ($element instanceof Button) {
                    $labelOpen = $labelClose = $label = '';
                    $addDivClass = ' col-xs-offset-'.$this->labelColumns;
                } elseif ($element instanceof DateSelect) {
                    $elementString = '<div class="form-inline">'.$elementString.'</div>';
                }
                if ($type == 'radio') {
                    $addDivClass = ' radio';
                }

                switch ($this->labelPosition) {
                    case self::LABEL_PREPEND:
                        if ($this->isHorizontal) {
                            $markup = sprintf(
                                $this->horizontalRowWrapper,
                                ! empty($elementErrors) ? ' has-error' : '',
                                $labelOpen . $label . $labelClose,
                                12 - $this->labelColumns,
                                $addDivClass,
                                $elementString . ($this->renderErrors ? $elementErrors : ''),
                                ''
                            );
                        } else {
                            $markup = sprintf(
                                $this->rowWrapper,
                                ! empty($elementErrors) ? ' has-error' : '',
                                $labelOpen . $label . $labelClose,
                                $elementString
                            );
                        }
                        break;
                    case self::LABEL_APPEND:
                    default:
                        if ($this->isHorizontal) {
                            $markup = sprintf(
                                $this->horizontalRowWrapper,
                                ! empty($elementErrors) ? ' has-error' : '',
                                '',
                                12 - $this->labelColumns,
                                $addDivClass,
                                $elementString . ($this->renderErrors ? $elementErrors : ''),
                                $labelOpen . $label . $labelClose
                            );
                        } else {
                            $markup = sprintf(
                                $this->rowWrapper,
                                ! empty($elementErrors) ? ' has-error' : '',
                                $elementString,
                                $labelOpen . $label . $labelClose
                            );
                        }
                        break;
                }
            }

            if (! $this->isHorizontal && $this->renderErrors) {
                $markup .= $elementErrors;
            }
        } else {
            if ($this->isHorizontal && $this->labelPosition == self::LABEL_PREPEND && $type !== 'hidden') {
                $markup = sprintf(
                    $this->horizontalRowWrapper,
                    ! empty($elementErrors) ? ' has-error' : '',
                    '',
                    12 - $this->labelColumns,
                    ' col-xs-offset-'.$this->labelColumns,
                    $elementString.($this->renderErrors ? $elementErrors : ''),
                    ''
                );
            } else {
                if ($this->renderErrors) {
                    $markup = $elementString.$elementErrors;
                } else {
                    $markup = $elementString;
                }
            }
        }

        return $markup;
    }

    protected function getHelpBlock(ElementInterface $element)
    {
        return ($helpBlock = $element->getOption('help-block')) ? sprintf(
            self::$helpBlockFormat,
            $this->getEscapeHtmlHelper()->__invoke(
                ($translator = $this->getTranslator()) ?
                    $translator->translate($helpBlock, $this->getTranslatorTextDomain()) :
                    $helpBlock
            )
        ) : '';
    }

    public function setIsHorizontal(bool $isHorizontal): FormRow
    {
        $this->isHorizontal = $isHorizontal;

        return $this;
    }

    public function setLabelColumns(int $labelColumns): FormRow
    {
        $this->labelColumns = $labelColumns;
        return $this;
    }
}
