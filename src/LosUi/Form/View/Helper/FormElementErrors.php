<?php
namespace LosUi\Form\View\Helper;

use Zend\Form\View\Helper\FormElementErrors as ZendFormElementErrors;

class FormElementErrors extends ZendFormElementErrors
{

    protected $messageCloseString = '</p></div>';

    protected $messageOpenFormat = '<div%s><p>';

    protected $messageSeparatorString = '</p><p>';
}

