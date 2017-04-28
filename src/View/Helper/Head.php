<?php

/**
 * Head view helper, adding the necessary cdns.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
namespace LosUi\View\Helper;

/**
 * Head view helper, adding the necessary links for cdns.
 *
 * @author Leandro Silva <leandro@leandrosilva.info>
 *
 * @category LosUi
 *
 * @license https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link http://github.com/LansoWeb/LosUi
 */
class Head
{
    const VERSION_JQUERY = '2.2.0';
    const VERSION_BOOTSTRAP = '3.3.7';
    const VERSION_FONTAWESOME = '4.7.0';

    //---- Jquery
    public function getJquery($useMinified = true, $version = self::VERSION_JQUERY) : string
    {
        return sprintf('<script src="%s">', $this->getJqueryLink($useMinified, $version));
    }

    public function getJqueryLink($useMinified = true, $version = self::VERSION_BOOTSTRAP) : string
    {
        return sprintf(
            'https://code.jquery.com/jquery-%s.%sjs',
            $version,
            $useMinified ? 'min.' : ''
        );
    }

    //---- Bootstrap
    public function getBootstrap($useMinified = true, $version = self::VERSION_BOOTSTRAP) : string
    {
        return $this->getBootstrapJs($useMinified, $version) . '<br>' . $this->getBootstrapCss($useMinified, $version);
    }

    public function getBootstrapCss($useMinified = true, $version = self::VERSION_BOOTSTRAP) : string
    {
        return sprintf('<link rel="stylesheet" href="%s">', $this->getBootstrapCssLink($useMinified, $version));
    }

    public function getBootstrapJs($useMinified = true, $version = self::VERSION_BOOTSTRAP) : string
    {
        return sprintf('<script src="%s">', $this->getBootstrapJsLink($useMinified, $version));
    }

    public function getBootstrapCssLink($useMinified = true, $version = self::VERSION_BOOTSTRAP) : string
    {
        return sprintf(
            'https://maxcdn.bootstrapcdn.com/bootstrap/%s/css/bootstrap.%scss',
            $version,
            $useMinified ? 'min.' : ''
        );
    }

    public function getBootstrapJsLink($useMinified = true, $version = self::VERSION_BOOTSTRAP) : string
    {
        return sprintf(
            'https://maxcdn.bootstrapcdn.com/bootstrap/%s/js/bootstrap.%sjs',
            $version,
            $useMinified ? 'min.' : ''
        );
    }

    //---- Fontawesome
    public function getFontAwesome($useMinified = true, $version = self::VERSION_FONTAWESOME) : string
    {
        return sprintf('<link rel="stylesheet" href="%s">', $this->getFontAwesomeCssLink($useMinified, $version));
    }

    public function getFontAwesomeCssLink($useMinified = true, $version = self::VERSION_FONTAWESOME) : string
    {
        return sprintf(
            'https://maxcdn.bootstrapcdn.com/font-awesome/%s/css/font-awesome.%scss',
            $version,
            $useMinified ? 'min.' : ''
        );
    }
}
