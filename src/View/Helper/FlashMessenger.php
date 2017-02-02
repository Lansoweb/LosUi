<?php

/**
 * FlashMessenger view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
namespace LosUi\View\Helper;

use Zend\Mvc\Controller\Plugin\FlashMessenger as PluginFlashMessenger;
use Zend\View\Helper\FlashMessenger as ZfFlashMessenger;

/**
 * FlashMessenger view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
class FlashMessenger extends ZfFlashMessenger
{
    protected $classMessages = [
        PluginFlashMessenger::NAMESPACE_INFO => 'alert alert-dismissable alert-info',
        PluginFlashMessenger::NAMESPACE_ERROR => 'alert alert-dismissable alert-danger',
        PluginFlashMessenger::NAMESPACE_SUCCESS => 'alert alert-dismissable alert-success',
        PluginFlashMessenger::NAMESPACE_DEFAULT => 'alert alert-dismissable alert-default',
        PluginFlashMessenger::NAMESPACE_WARNING => 'alert alert-dismissable alert-warning',
    ];

    protected $messageCloseString = '</li></ul></div>';

    protected $messageOpenFormat = '<div%s>
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         &times;
     </button>
     <ul><li>';

    protected $messageSeparatorString = '</li><li>';

    public function renderAll($order = ['error', 'success', 'info', 'warning', 'default'])
    {
        $html = '';
        foreach ($order as $namespace) {
            $html .= $this->renderCurrent($namespace);
        }

        return $html;
    }
}
