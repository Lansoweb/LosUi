<?php

/**
 * Form Collection View Helper.
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

use Zend\Form\View\Helper\FormCollection as ZfFormCollection;

/**
 * Form Collection View Helper.
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
class FormCollection extends ZfFormCollection
{
    protected $defaultElementHelper = 'losformrow';
}
