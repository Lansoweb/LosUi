<?php

/**
 * "Fake" Navigation Page to add a divider in the Menu.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
namespace LosUi\Navigation\Page;

use Zend\Navigation\Page\AbstractPage;

/**
 * "Fake" Navigation Page to add a divider in the Menu.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
class Divider extends AbstractPage
{
    /**
     * (non-PHPdoc).
     *
     * @see \Zend\Navigation\Page\AbstractPage::getHref()
     */
    public function getHref()
    {
        return '';
    }
}
