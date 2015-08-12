<?php

/**
 * Chosen view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://harvesthq.github.io/chosen/
 */
namespace LosUi\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Chosen view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://harvesthq.github.io/chosen/
 */
class Chosen extends AbstractHelper
{
    protected $format = '$("%s").chosen(%s);';

    /**
     * @param string $element
     * @param array  $options
     * @param bool   $includeLibs
     *
     * @return string|\LosUi\View\Helper\Chosen
     */
    public function __invoke($element = 'select', $options = [], $includeLibs = true, $formatForBootstrap = false)
    {
        if ($element) {
            if (is_bool($element)) {
                $includeLibs = $element;
                $element = 'select';
            } elseif (is_array($element)) {
                if (is_bool($options)) {
                    $includeLibs = $options;
                } else {
                    $includeLibs = true;
                }
                $options = $element;
                $element = 'select';
            }

            return $this->render($element, $options, $includeLibs, $formatForBootstrap);
        }

        return $this;
    }

    /**
     * @param string $element
     * @param array  $options
     * @param bool   $includeLibs
     *
     * @return string
     */
    public function render($element, $options = [], $includeLibs = true, $formatForBootstrap = false)
    {
        if ($includeLibs) {
            $headLink = $this->view->plugin('losHeadLink');
            $headLink->appendChosen();
            if ($formatForBootstrap === true) {
                $headLink->appendChosenBootstrap();
            }
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
                if (is_numeric($value)) {
                    $chosenOptions .= "$key: $value";
                } else {
                    $chosenOptions .= "$key: '$value'";
                }
                if ($first) {
                    $first = false;
                }
            }
            $chosenOptions .= '}';
        }

        return sprintf($this->format, $element, $chosenOptions);
    }
}
