<?php
/**
 * Form Element Errors styled for Bootstrap 3
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/css/#forms
 */
namespace LosUi\Form\View\Helper;

use Zend\Form\View\Helper\FormElementErrors as ZendFormElementErrors;

/**
 *
 * Form Element Errors styled for Bootstrap 3
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/css/#forms
 */
class FormElementErrors extends ZendFormElementErrors
{

    protected $messageCloseString = '</p></div>';

    protected $messageOpenFormat = '<div%s><p>';

    protected $messageSeparatorString = '</p><p>';
}
