<?php

/**
 * Form Element Errors styled for Bootstrap 3.
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

use Laminas\Form\View\Helper\FormElementErrors as LaminasFormElementErrors;

/**
 * Form Element Errors styled for Bootstrap 3.
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
class FormElementErrors extends LaminasFormElementErrors
{
    protected $messageCloseString = '</p></div>';

    protected $messageOpenFormat = '<div%s><p>';

    protected $messageSeparatorString = '</p><p>';
}
