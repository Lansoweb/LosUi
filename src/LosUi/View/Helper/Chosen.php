<?php
namespace LosUi\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

class Chosen extends AbstractHelper
{

    protected $format = '$("%s").chosen(%s);';

    public function __invoke($element = 'select', $options = [], $includeLibs = true)
    {
        if ($element) {
            if (is_bool($element)) {
                $includeLibs = $element;
                $element = 'select';
            }
            elseif (is_array($element)) {
                if (is_bool($options)) {
                    $includeLibs = $options;
                }
                else {
                    $includeLibs = true;
                }
                $options = $element;
                $element = 'select';
            }
            return $this->render($element, $options, $includeLibs);
        }

        return $this;
    }

    public function render($element, $options = [], $includeLibs = true)
    {
        if ($includeLibs) {
            $headLink = $this->view->plugin('losHeadLink');
            $headLink->appendChosen();
            $headScript = $this->view->plugin('losHeadScript');
            $headScript->appendChosen();
        }

        $chosenOptions = '';
        if (count($options) > 0) {
            $chosenOptions = '{';
            $first = true;
            foreach ($options as $key => $value) {
                if (!$first) {
                    $chosenOptions .= ', ';
                }
                $chosenOptions .= "$key: $value";
                if ($first) {
                    $first = false;
                }
            }
            $chosenOptions .= '}';
        }

        return sprintf($this->format, $element, $chosenOptions);
    }
}
